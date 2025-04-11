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
        $titulo = 'Reservas';
        @endphp
        @include('layouts.navbar', ['titulo' => $titulo])

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                            <h6 class="text-capitalize">Lista de Reservas</h6>
                            <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#criarReservaModal">Nova Reserva</button>
                        </div>

                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cliente</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quarto</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Preço</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Entrada</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saída</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-secondary opacity-7">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reservas as $reserva)
                                        <tr>
                                            <td class="ps-3">{{ $reserva->id }}</td>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $reserva->cliente_nome }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $reserva->cliente_email ?? '---' }}</p>
                                            </td>
                                            <td>{{ $reserva->quarto->numero }}</td>
                                            <td class="align-middle text-center">
                                                <h6 class="mb-0 text-sm">{{ number_format($reserva->valor_total, 2, ',', '.') }}</h6>
                                            </td>

                                            <td>{{ \Carbon\Carbon::parse($reserva->data_entrada)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($reserva->data_saida)->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge bg-gradient-{{
                                                        $reserva->status === 'reservado' ? 'info' :
                                                        ($reserva->status === 'finalizado' ? 'success' : 'secondary')
                                                    }}">{{ ucfirst($reserva->status) }}</span>
                                            </td>
                                            <td>
                                                <a href="#" class="text-secondary font-weight-bold text-xs me-2" data-bs-toggle="modal" data-bs-target="#editarModal{{ $reserva->id }}">
                                                    Editar
                                                </a>

                                                <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" style="display:inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent" onclick="return confirm('Tem certeza?')">
                                                        Cancelar
                                                    </button>
                                                </form>

                                                <!-- Exibir botão Check-in apenas se a reserva estiver "Reservado" -->
                                                @if($reserva->status == 'reservado')
                                                <a href="{{ route('reservas.checkin', $reserva->id) }}" class=" text-success font-weight-bold text-xs border-0 bg-transparent" data-toggle="tooltip" title="Check-in">
                                                    <i class="fas fa-check-circle"></i> Check-in
                                                </a>
                                                @endif

                                                <!-- Link para ver detalhes -->
                                                <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#verModal{{ $reserva->id }}">
                                                    Ver
                                                </a>
                                            </td>

                                        </tr>

                                        <!-- Modal de Editar Reserva -->
                                        <div class="modal fade" id="editarModal{{ $reserva->id }}" tabindex="-1" aria-labelledby="editarModalLabel{{ $reserva->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editarModalLabel{{ $reserva->id }}">Editar Reserva</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                    </div>
                                                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <!-- Nome do Cliente -->
                                                            <div class="mb-3">
                                                                <label for="cliente_nome" class="form-label">Nome do Cliente</label>
                                                                <input type="text" class="form-control" id="cliente_nome" name="cliente_nome" value="{{ $reserva->cliente_nome }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="cliente_documento" class="form-label">Documento do Cliente</label>
                                                                <select class="form-select" id="cliente_documento" name="cliente_documento">
                                                                    <option value="bi" {{ $reserva->cliente_documento == 'bi' ? 'selected' : '' }}>BI</option>
                                                                    <option value="passaporte" {{ $reserva->cliente_documento == 'passaporte' ? 'selected' : '' }}>Passaporte</option>
                                                                    <option value="carta_conducao" {{ $reserva->cliente_documento == 'carta_conducao' ? 'selected' : '' }}>Carta de Condução</option>
                                                                </select>
                                                            </div>
                                                            <!-- Email do Cliente -->
                                                            <div class="mb-3">
                                                                <label for="cliente_email" class="form-label">E-mail do Cliente</label>
                                                                <input type="email" class="form-control" id="cliente_email" name="cliente_email" value="{{ $reserva->cliente_email }}">
                                                            </div>

                                                            <!-- Telefone do Cliente -->
                                                            <div class="mb-3">
                                                                <label for="cliente_telefone" class="form-label">Telefone do Cliente</label>
                                                                <input type="text" class="form-control" id="cliente_telefone" name="cliente_telefone" value="{{ $reserva->cliente_telefone }}">
                                                            </div>

                                                            <!-- Quarto -->
                                                            <div class="mb-3">
                                                                <label for="quarto_id" class="form-label">Quarto</label>
                                                                <select class="form-select" id="quarto_id" name="quarto_id">
                                                                    <option value="{{ $reserva->quarto_id }}" selected>
                                                                        {{ $reserva->quarto->numero }} - {{ $reserva->quarto->status }}
                                                                    </option>
                                                                    @foreach($quartos as $quarto)
                                                                    <option value="{{ $quarto->id }}">
                                                                        {{ $quarto->numero }} - {{ $quarto->status }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <!-- Data de Entrada -->
                                                            <div class="mb-3">
                                                                <label for="data_entrada" class="form-label">Data de Entrada</label>
                                                                <input type="date" class="form-control" id="data_entrada" name="data_entrada" value="{{ $reserva->data_entrada }}" required>
                                                            </div>

                                                            <!-- Data de Saída -->
                                                            <div class="mb-3">
                                                                <label for="data_saida" class="form-label">Data de Saída</label>
                                                                <input type="date" class="form-control" id="data_saida" name="data_saida" value="{{ $reserva->data_saida }}" required>
                                                            </div>

                                                            <!-- Observações -->
                                                            <div class="mb-3">
                                                                <label for="observacoes" class="form-label">Observações</label>
                                                                <textarea class="form-control" id="observacoes" name="observacoes">{{ $reserva->observacoes }}</textarea>
                                                            </div>
                                                        </div>

                                                        <!-- Botões do Modal -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                            <button type="submit" class="btn btn-primary">Salvar alterações</button>
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

            <!-- Modal Criar Reserva -->
            <div class="modal fade" id="criarReservaModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-lg para mais espaço -->
                    <div class="modal-content">
                        <form action="{{ route('reservas.store') }}" method="POST">
                            @csrf

                            <div class="modal-header bg-gradient-primary text-white">
                                <h5 class="modal-title text-white">Nova Reserva</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <!-- Nome -->
                                    <div class="col-md-6 mb-3">
                                        <label>Nome do Cliente</label>
                                        <input type="text" name="cliente_nome" class="form-control" required>
                                    </div>

                                    <!-- Documento -->
                                    <div class="col-md-6 mb-3">
                                        <label for="cliente_documento">Tipo de Documento</label>
                                        <select name="cliente_documento" id="cliente_documento" class="form-control" required>
                                            <option value="">Selecione...</option>
                                            <option value="BI" {{ old('cliente_documento', $reserva->cliente_documento ?? '') == 'BI' ? 'selected' : '' }}>BI</option>
                                            <option value="Passaporte" {{ old('cliente_documento', $reserva->cliente_documento ?? '') == 'Passaporte' ? 'selected' : '' }}>Passaporte</option>
                                            <option value="Carta de Condução" {{ old('cliente_documento', $reserva->cliente_documento ?? '') == 'Carta de Condução' ? 'selected' : '' }}>Carta de Condução</option>
                                        </select>
                                    </div>


                                    <!-- Email -->
                                    <div class="col-md-6 mb-3">
                                        <label>Email</label>
                                        <input type="email" name="cliente_email" class="form-control">
                                    </div>

                                    <!-- Telefone -->
                                    <div class="col-md-6 mb-3">
                                        <label>Telefone</label>
                                        <input type="text" name="cliente_telefone" class="form-control">
                                    </div>

                                    <!-- Quarto -->
                                    <div class="col-md-6 mb-3">
                                        <label>Quarto</label>
                                        <select name="quarto_id" class="form-control" required>
                                            <option value="">Selecione</option>
                                            @foreach($quartos as $quarto)
                                            <option value="{{ $quarto->id }}">Quarto {{ $quarto->numero }} - {{ $quarto->tipo->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Data de Entrada -->
                                    <div class="col-md-3 mb-3">
                                        <label>Data de Entrada</label>
                                        <input type="date" name="data_entrada" class="form-control" required>
                                    </div>

                                    <!-- Data de Saída -->
                                    <div class="col-md-3 mb-3">
                                        <label>Data de Saída</label>
                                        <input type="date" name="data_saida" class="form-control" required>
                                    </div>

                                    <!-- Observações -->
                                    <div class="col-12 mb-3">
                                        <label>Observações</label>
                                        <textarea name="observacoes" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit">Salvar</button>
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal de Ver Reserva -->
            <div class="modal fade" id="verModal{{ $reserva->id }}" tabindex="-1" aria-labelledby="verModalLabel{{ $reserva->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verModalLabel{{ $reserva->id }}">Detalhes da Reserva</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Detalhes da Reserva -->
                            <p><strong>Nome do Cliente:</strong> {{ $reserva->cliente_nome }}</p>
                            <p><strong>Documento:</strong> {{ $reserva->cliente_documento }}</p>
                            <p><strong>Telefone:</strong> {{ $reserva->cliente_telefone ?? 'N/A' }}</p>
                            <p><strong>E-mail:</strong> {{ $reserva->cliente_email ?? 'N/A' }}</p>
                            <p><strong>Quarto:</strong> {{ $reserva->quarto->numero }} - {{ $reserva->quarto->status }}</p>
                            <p><strong>Data de Entrada:</strong> {{ $reserva->data_entrada }}</p>
                            <p><strong>Data de Saída:</strong> {{ $reserva->data_saida }}</p>
                            <p><strong>Status:</strong> {{ $reserva->status }}</p>
                            <p><strong>Valor Total:</strong> R$ {{ number_format($reserva->valor_total, 2, ',', '.') }}</p>
                            <p><strong>Observações:</strong> {{ $reserva->observacoes ?? 'Nenhuma' }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
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