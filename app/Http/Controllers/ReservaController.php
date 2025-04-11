<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Quarto;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with('quarto')->orderBy('data_entrada', 'desc')->get();
        $quartos = Quarto::where('status', 'disponivel')->get();
        return view('reservas.index', compact('reservas', 'quartos'));
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'cliente_nome' => 'required',
            'cliente_documento' => 'required',
            'cliente_email' => 'nullable|email',
            'cliente_telefone' => 'nullable',
            'quarto_id' => 'required|exists:quartos,id',
            'data_entrada' => 'required|date',
            'data_saida' => 'required|date|after:data_entrada', // A data de saída deve ser após a de entrada
        ]);
    
        try {
            // Recupera os dados do quarto selecionado
            $quarto = Quarto::findOrFail($request->quarto_id);
    
            // Calcula o número de noites
            $data_entrada = \Carbon\Carbon::parse($request->data_entrada);
            $data_saida = \Carbon\Carbon::parse($request->data_saida);
            $numero_noites = $data_entrada->diffInDays($data_saida); // Diferença em dias entre as duas datas
    
            // Calcula o valor total da reserva
            $valor_total = $numero_noites * $quarto->preco_noite; // Número de noites * preço do quarto
    
            // Criação da reserva
            $reserva = new Reserva();
            $reserva->cliente_nome = $request->cliente_nome;
            $reserva->cliente_documento = $request->cliente_documento;
            $reserva->cliente_email = $request->cliente_email;
            $reserva->cliente_telefone = $request->cliente_telefone;
            $reserva->quarto_id = $request->quarto_id;
            $reserva->data_entrada = $data_entrada;
            $reserva->data_saida = $data_saida;
            $reserva->numero_noites = $numero_noites;
            $reserva->valor_total = $valor_total;
            $reserva->status = 'Reservado'; // Status inicial
            $reserva->save();
    
            // Atualiza o status do quarto para 'Reservado'
            $quarto->status = 'Reservado';
            $quarto->save();
    
            return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao criar reserva: ' . $e->getMessage());
            
        }
    }
    
    

    public function edit(Reserva $reserva)
    {
        $quartos = Quarto::all();
        return view('reservas.edit', compact('reserva', 'quartos'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        // Validação dos dados (tornando 'quarto_id' opcional na edição)
        $request->validate([
            'cliente_nome' => 'required|string|max:255',
           'cliente_documento' => 'required|max:100|in:bi,passaporte,carta_conducao', // Alteração aqui
            'cliente_email' => 'nullable|email|max:255',
            'cliente_telefone' => 'nullable|string|max:50',
            'quarto_id' => 'nullable|exists:quartos,id', // Tornar 'quarto_id' opcional
            'data_entrada' => 'required|date|after_or_equal:today',
            'data_saida' => 'required|date|after:data_entrada',
            'observacoes' => 'nullable|string'
        ]);
    
        try {
            // Se o quarto não for alterado, mantenha o valor atual
            if ($request->quarto_id) {
                $quarto = Quarto::find($request->quarto_id);
            } else {
                $quarto = $reserva->quarto; // Manter o quarto atual se não for alterado
            }
    
            // Cálculo da quantidade de noites
            $entrada = Carbon::parse($request->data_entrada);
            $saida = Carbon::parse($request->data_saida);
            $numero_noites = $entrada->diffInDays($saida);
    
            // Calcular o valor total
            $valor_total = $quarto->preco_noite * $numero_noites;
    
            // Atualizar os dados da reserva
            $reserva->update([
                'cliente_nome' => $request->cliente_nome,
                'cliente_documento' => $request->cliente_documento,
                'cliente_email' => $request->cliente_email,
                'cliente_telefone' => $request->cliente_telefone,
                'quarto_id' => $request->quarto_id ?: $reserva->quarto_id, // Se não mudar, mantém o quarto anterior
                'data_entrada' => $request->data_entrada,
                'data_saida' => $request->data_saida,
                'numero_noites' => $numero_noites,
                'valor_total' => $valor_total,
                'observacoes' => $request->observacoes
            ]);
    
            // Redirecionar com mensagem de sucesso
            return redirect()->route('reservas.index')->with('success', 'Reserva atualizada com sucesso!');
        } catch (\Exception $e) {
            // Retornar erro caso ocorra algum problema
            return back()->withErrors('Erro ao atualizar reserva: ' . $e->getMessage());
        }
    }
    
    
    public function checkin($id)
    {
        try {
            // Encontra a reserva
            $reserva = Reserva::findOrFail($id);
    
            // Verifica se a reserva está "Reservada"
            if ($reserva->status == 'Reservado') {
                // Atualiza o status da reserva para "Ocupado"
                $reserva->status = 'Ocupado';
                $reserva->save();
    
                // Atualiza o status do quarto para "Ocupado"
                $quarto = Quarto::findOrFail($reserva->quarto_id);
                $quarto->status = 'Ocupado';
                $quarto->save();
    
                return redirect()->route('reservas.index')->with('success', 'Check-in realizado com sucesso!');
            }
    
            return redirect()->route('reservas.index')->with('error', 'A reserva não pode ser feita. Status inválido!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao realizar o check-in: ' . $e->getMessage());
        }
    }
    


    public function finalizar($id)
{
    try {
        $reserva = Reserva::findOrFail($id);

        // Altera o status do quarto para "Disponível"
        $quarto = $reserva->quarto;
        $quarto->status = 'Disponível';
        $quarto->save();

        // Atualiza o status da reserva para "finalizado"
        $reserva->status = 'finalizado';
        $reserva->save();

        return redirect()->route('reservas.index')->with('success', 'Reserva finalizada e quarto disponível novamente.');
    } catch (\Exception $e) {
        return back()->withErrors('Erro ao finalizar reserva: ' . $e->getMessage());
    }
}


    public function destroy($id)
    {
        try {
            $reserva = Reserva::findOrFail($id);
    
            // Altera o status do quarto para "Disponível"
            $quarto = $reserva->quarto;
            $quarto->status = 'Disponível';
            $quarto->save();
    
            // Deleta a reserva
            $reserva->delete();
    
            return redirect()->route('reservas.index')->with('success', 'Reserva cancelada e quarto disponível novamente.');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao cancelar reserva: ' . $e->getMessage());
        }
    }
    
}
