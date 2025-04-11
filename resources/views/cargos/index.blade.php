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
        $titulo = 'Cargos';
        @endphp
        @include('layouts.navbar', ['titulo' => $titulo])


        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">

                        <div class="shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                            <h6 class="text-capitalize">Lista de Cargos</h6>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovoCargo">Novo Cargo</button>
                        </div>

                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Descrição</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Criado em</th>
                                            <th class="text-secondary opacity-7">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cargos as $cargo)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm ms-3">{{ $cargo->id }}</h6>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $cargo->nome }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $cargo->descricao }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-xs text-secondary font-weight-bold">{{ $cargo->created_at->format('d/m/Y') }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <button class="btn btn-link text-secondary text-xs mb-0" data-bs-toggle="modal" data-bs-target="#modalEditarCargo{{ $cargo->id }}">Editar</button>
                                                <form action="{{ route('cargos.destroy', $cargo) }}" method="POST" style="display:inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger text-xs mb-0 border-0 bg-transparent" onclick="return confirm('Deseja excluir este cargo?')">Excluir</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal Editar Cargo -->
                                        <div class="modal fade" id="modalEditarCargo{{ $cargo->id }}" tabindex="-1" aria-labelledby="modalEditarCargoLabel{{ $cargo->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('cargos.update', $cargo) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header bg-gradient-primary text-white">
                                                            <h5 class="text-white modal-title" id="modalEditarCargoLabel{{ $cargo->id }}">Editar Cargo</h5>
                                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                        </div>
                                                        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                                            <div class="form-group">
                                                                <label for="nome" class="form-label">Nome do Cargo</label>
                                                                <input type="text" name="nome" value="{{ $cargo->nome }}" class="form-control" required>
                                                            </div>

                                                            <!-- Campo Descrição -->
                                                            <div class="form-group mt-3">
                                                                <label for="descricao" class="form-label">Descrição</label>
                                                                <textarea name="descricao" class="form-control" rows="3" placeholder="Descreva o cargo...">{{ $cargo->descricao }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-success">Salvar</button>
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
        </div>

        <!-- Modal Novo Cargo -->

        <div class="modal fade" id="modalNovoCargo" tabindex="-1" aria-labelledby="modalNovoCargoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('cargos.store') }}" method="POST">
                        @csrf
                        <!-- Cabeçalho com cor -->
                        <div class="modal-header bg-gradient-primary text-white">
                            <h5 class="text-white modal-title" id="modalNovoCargoLabel">Novo Cargo</h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>

                        <!-- Corpo com scroll e altura máxima -->
                        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                            <div class="form-group">
                                <label for="nome" class="form-label">Nome do Cargo</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>

                            <!-- Campo de Descrição -->
                            <div class="form-group">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea name="descricao" class="form-control" rows="3" placeholder="Descreva o cargo..."></textarea>
                            </div>
                        </div>

                        <!-- Rodapé com botões -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>
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