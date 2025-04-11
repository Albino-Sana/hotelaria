<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quarto;

class Reserva extends Model
{
    protected $fillable = [
        'cliente_nome',
        'cliente_documento',
        'cliente_email',
        'cliente_telefone',
        'quarto_id',
        'data_entrada',
        'data_saida',
        'numero_noites',
        'valor_total',
        'status',
        'observacoes',
    ];

    public function quarto()
    {
        return $this->belongsTo(Quarto::class);
    }
}
