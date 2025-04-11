<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        DAT Hotelaria
    </title>

    @include('components.css')

</head>

<body class="g-sidenav-show   bg-gray-100">

    @include('layouts.sidebar')

    <main class="main-content position-relative border-radius-lg ">
        @php
        $titulo = 'Quartos';
        @endphp
        @include('layouts.navbar', ['titulo' => $titulo])


        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                            <h6 class="text-capitalize ps-3">Quartos</h6>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#novoQuartoModal">
                                Novo Quarto
                            </button>
                        </div>

                        <!-- Tabela -->
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Número</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Andar</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipo</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Preço por Noite</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Criado Em</th>
                                            <th class="text-center text-secondary opacity-7">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($quartos as $quarto)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $quarto->id }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $quarto->numero }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $quarto->andar }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $quarto->tipo->nome }}</h6>
                                            </td>

                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm 
                                                        {{ 
                                                            $quarto->status == 'Disponível' ? 'bg-success text-dark' : 
                                                            ($quarto->status == 'Reservado' ? 'bg-primary text-white' : 
                                                            ($quarto->status == 'Ocupado' ? 'bg-danger text-white' : 'bg-secondary text-white')) 
                                                        }}">
                                                    {{ $quarto->status }}
                                                </span>
                                            </td>

                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $quarto->preco_noite }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $quarto->created_at->format('d/m/Y') }}</span>
                                            </td>

                                            <td class="align-middle text-center">
                                                <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editarTipoModal{{ $quarto->id }}">
                                                    Editar
                                                </a>

                                                <form action="{{ route('quartos.destroy', $quarto) }}" method="POST" style="display:inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent" onclick="return confirm('Tem certeza?')" title="Excluir quarto">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>


                                        <div class="modal fade" id="editarTipoModal{{ $quarto->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="text-white modal-title" id="editarQuartoModalLabel">Editar Quarto</h5>
                                                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                    </div>
                                                    <form action="{{ route('quartos.update', $quarto->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="numero" class="form-label">Número do Quarto</label>
                                                                <input type="text" name="numero" class="form-control" value="{{ $quarto->numero }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="andar" class="form-label">Andar</label>
                                                                <input type="text" name="andar" class="form-control" value="{{ $quarto->andar }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="tipo_quarto_id" class="form-label">Tipo de Quarto</label>
                                                                <select class="form-control" name="tipo_quarto_id" required>
                                                                    @foreach($tipos as $tipo)
                                                                    <option value="{{ $tipo->id }}" {{ $quarto->tipo_quarto_id == $tipo->id ? 'selected' : '' }}>
                                                                        {{ $tipo->nome }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-control" name="status" required>
                                                                    <option value="Disponível" {{ $quarto->status == 'Disponível' ? 'selected' : '' }}>Disponível</option>
                                                                    <option value="Indisponível" {{ $quarto->status == 'Indisponível' ? 'selected' : '' }}>Indisponível</option>
                                                                    <option value="Reservado" {{ $quarto->status == 'Reservado' ? 'selected' : '' }}>Reservado</option>
                                                                    <option value="Manutenção" {{ $quarto->status == 'Manutenção' ? 'selected' : '' }}>Manutenção</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="preco_noite" class="form-label">Preço por Noite</label>
                                                                <input type="number" class="form-control" name="preco_noite" value="{{ $quarto->preco_noite }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button class="btn btn-success" type="submit">Salvar Alterações</button>
                                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal de Novo Quarto -->
            <div class="modal fade" id="novoQuartoModal" tabindex="-1" aria-labelledby="novoQuartoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Cabeçalho com cor -->
                        <div class="modal-header bg-gradient-primary text-white">
                            <h5 class="text-white modal-title" id="novoQuartoModalLabel">Adicionar Novo Quarto</h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>

                        <!-- Corpo com scroll e altura máxima -->
                        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                            <form action="{{ route('quartos.store') }}" method="POST">
                                @csrf

                                <!-- Número do Quarto -->
                                <div class="mb-3">
                                    <label for="numero" class="form-label">Número do Quarto</label>
                                    <input type="text" name="numero" class="form-control" required>
                                </div>

                                <!-- Andar -->
                                <div class="mb-3">
                                    <label for="andar" class="form-label">Andar</label>
                                    <input type="text" name="andar" class="form-control" required>
                                </div>

                                <!-- Tipo de Quarto -->
                                <div class="mb-3">
                                    <label for="tipo_quarto_id" class="form-label">Tipo de Quarto</label>
                                    <select class="form-control" name="tipo_quarto_id" required>
                                        <option value="" disabled selected>Selecione o tipo</option>
                                        @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="Disponível">Disponível</option>
                                        <option value="Ocupado">Ocupado</option>
                                        <option value="Manutenção">Manutenção</option>
                                    </select>
                                </div>

                                <!-- Preço por Noite -->
                                <div class="mb-3">
                                    <label for="preco_noite" class="form-label">Preço por Noite</label>
                                    <input type="number" name="preco_noite" class="form-control" step="0.01" required>
                                </div>

                                <!-- Descrição -->
                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Descrição (opcional)</label>
                                    <textarea name="descricao" class="form-control" rows="3" placeholder="Ex: Quarto com vista para o mar..."></textarea>
                                </div>

                                <!-- Rodapé com botões -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    @include('layouts.customise')
    <!--   Core JS Files   -->
    @include('components.js')

</body>

</html>