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
                            <h6 class="text-capitalize">Lista de Tipos de Quartos</h6>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovoTipo">Novo Tipo de Quarto</button>
                        </div>

                        <div class="card-body px-0 pb-2">
                            <!-- Tabela -->
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Criado Em</th>
                                            <th class="text-center text-secondary opacity-7">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tipos as $tipo)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $tipo->id }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $tipo->nome }}</h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $tipo->created_at->format('d/m/Y') }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editarTipoModal{{ $tipo->id }}">
                                                    Editar
                                                </a>
                                                <form action="{{ route('tipos-quartos.destroy', $tipo) }}" method="POST" style="display:inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent" onclick="return confirm('Tem certeza?')" title="Excluir tipo de quarto">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editarTipoModal{{ $tipo->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('tipos-quartos.update', $tipo->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="modal-header bg-warning text-white">
                                                            <h5 class="modal-title">Editar Tipo de Quarto</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label>Nome</label>
                                                                <input type="text" name="nome" class="form-control" value="{{ $tipo->nome }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Descrição</label>
                                                                <textarea name="descricao" class="form-control">{{ $tipo->descricao }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button class="btn btn-success" type="submit">Salvar</button>
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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

            <!-- Modal Criar -->
            <div class="modal fade" id="modalNovoTipo" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('tipos-quartos.store') }}" method="POST">
                            @csrf

                            <div class="modal-header bg-primary text-white">
                                <h5 class="text-white modal-title">Novo Tipo de Quarto</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nome</label>
                                    <input type="text" name="nome" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Descrição</label>
                                    <textarea name="descricao" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit">Salvar</button>
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
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