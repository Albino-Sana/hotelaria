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
        $titulo = 'Funcionários';
        @endphp
        @include('layouts.navbar', ['titulo' => $titulo])


        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                            <h6 class="text-capitalize ps-3">Lista de Funcionários</h6>
                            <!-- Botão para abrir o modal de adicionar novo funcionário -->
                            <button class="btn btn-sm btn-light ms-3" data-bs-toggle="modal" data-bs-target="#addFuncionarioModal">Novo Funcionário</button>
                        </div>

                        <!-- Modal de adicionar novo funcionário -->
                        <div class="modal fade" id="addFuncionarioModal" tabindex="-1" aria-labelledby="addFuncionarioModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Cabeçalho com cor -->
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title text-white" id="novoFuncionarioLabel">Novo Funcionário</h5>
                                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>

                                    <!-- Corpo com scroll e altura máxima -->
                                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                        <form action="{{ route('funcionarios.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div>
                                                <div class="mb-3">
                                                    <label for="nome" class="form-label">Nome</label>
                                                    <input type="text" name="nome" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">E-mail</label>
                                                    <input type="email" name="email" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="cargo_id" class="form-label">Cargo</label>
                                                    <select class="form-control" name="cargo_id" required>
                                                        <option value="">Selecione um Cargo</option>
                                                        @foreach($cargos as $cargo)
                                                        <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="telefone" class="form-label">Telefone</label>
                                                    <input type="text" name="telefone" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="sexo" class="form-label">Sexo</label>
                                                    <select name="sexo" class="form-control" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Masculino">Masculino</option>
                                                        <option value="Feminino">Feminino</option>
                                                        <option value="Outro">Outro</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="morada" class="form-label">Morada</label>
                                                    <input type="text" name="morada" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="nacionalidade" class="form-label">Nacionalidade</label>
                                                    <input type="text" name="nacionalidade" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="naturalidade" class="form-label">Naturalidade</label>
                                                    <select name="naturalidade" class="form-control" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Luanda">Luanda</option>
                                                        <option value="Benguela">Benguela</option>
                                                        <option value="Huíla">Huíla</option>
                                                        <!-- Adicione mais conforme necessário -->
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="estado_civil" class="form-label">Estado Civil</label>
                                                    <select name="estado_civil" class="form-control" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Solteiro(a)">Solteiro(a)</option>
                                                        <option value="Casado(a)">Casado(a)</option>
                                                        <option value="Divorciado(a)">Divorciado(a)</option>
                                                        <option value="Viúvo(a)">Viúvo(a)</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="salario" class="form-label">Salário</label>
                                                    <input type="number" name="salario" class="form-control" step="0.01" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="turno" class="form-label">Turno de Trabalho</label>
                                                    <select name="turno" class="form-control" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Manhã">Manhã</option>
                                                        <option value="Tarde">Tarde</option>
                                                        <option value="Noite">Noite</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select name="status" class="form-control" required>
                                                        <option value="Ativo">Ativo</option>
                                                        <option value="Inativo">Inativo</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                                                    <select name="tipo_documento" class="form-control" required>
                                                        <option value="">Selecione</option>
                                                        <option value="BI">BI</option>
                                                        <option value="Passaporte">Passaporte</option>
                                                        <option value="Cartão de Residência">Cartão de Residência</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="numero_documento" class="form-label">Número do Documento</label>
                                                    <input type="text" name="numero_documento" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                                    <input type="date" name="data_nascimento" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="foto" class="form-label">Foto</label>
                                                    <input type="file" name="foto" class="form-control">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">E-mail</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cargo</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telefone</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nacionalidade</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Morada</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Criado Em</th>
                                            <th class="text-center text-secondary opacity-7">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($funcionarios as $funcionario)

                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm" style="margin-left: 20px;">{{ $funcionario->id }}</h6>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            @if($funcionario->foto)
                                                            <img src="{{ asset('storage/' . $funcionario->foto) }}" alt="Foto do funcionário"
                                                                class="avatar avatar-sm rounded-circle me-3">
                                                            @else
                                                            <span class="avatar avatar-sm rounded-circle bg-gradient-primary me-3 d-flex align-items-center justify-content-center">
                                                                <i class="fas fa-user text-white"></i>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $funcionario->nome }}</h6>
                                                        </div>
                                                    </div>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0">{{ $funcionario->email }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-info">
                                                    {{ $funcionario->cargo->nome ?? 'Sem cargo' }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-xs">{{ $funcionario->telefone ?? '-' }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-xs">{{ $funcionario->nacionalidade ?? '-' }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-xs">{{ $funcionario->morada ?? '-' }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $funcionario->created_at->format('d/m/Y') }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editarFuncionarioModal{{ $funcionario->id }}">
                                                    Editar
                                                </a>

                                                <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#verFuncionarioModal{{ $funcionario->id }}">
                                                    Ver
                                                </a>

                                                <form action="{{ route('funcionarios.destroy', $funcionario) }}" method="POST" style="display:inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent" onclick="return confirm('Tem certeza?')" data-toggle="tooltip" title="Excluir funcionário">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal de Edição -->
                                        <div class="modal fade" id="editarFuncionarioModal{{ $funcionario->id }}" tabindex="-1" aria-labelledby="editarFuncionarioLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 50%; margin-left: 30%;">
                                                <div class="modal-content">

                                                    <!-- Cabeçalho com degradê -->
                                                    <div class="modal-header text-white" style="background: linear-gradient(90deg, #5e72e4, #825ee4);">
                                                        <h5 class="modal-title text-white" id="editarFuncionarioLabel">Editar Funcionário</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                    </div>

                                                    <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Corpo com scroll -->
                                                        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                                            <div class="row g-3">
                                                                <!-- Campos do formulário -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Nome</label>
                                                                    <input type="text" name="nome" class="form-control" value="{{ $funcionario->nome }}" required maxlength="255">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">E-mail</label>
                                                                    <input type="email" name="email" class="form-control" value="{{ $funcionario->email }}" required maxlength="255">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Cargo</label>
                                                                    <select class="form-control" name="cargo_id" required>
                                                                        @foreach($cargos as $cargo)
                                                                        <option value="{{ $cargo->id }}" {{ $funcionario->cargo_id == $cargo->id ? 'selected' : '' }}>
                                                                            {{ $cargo->nome }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Telefone</label>
                                                                    <input type="text" name="telefone" class="form-control" value="{{ $funcionario->telefone }}" maxlength="20">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Sexo</label>
                                                                    <select name="sexo" class="form-control">
                                                                        <option value="Masculino" {{ $funcionario->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                                                        <option value="Feminino" {{ $funcionario->sexo == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                                                        <option value="Outro" {{ $funcionario->sexo == 'Outro' ? 'selected' : '' }}>Outro</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Nacionalidade</label>
                                                                    <input type="text" name="nacionalidade" class="form-control" value="{{ $funcionario->nacionalidade }}" maxlength="50">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Naturalidade</label>
                                                                    <select name="naturalidade" class="form-control">
                                                                        <option value="">Selecione</option>
                                                                        <option value="Luanda" {{ $funcionario->naturalidade == 'Luanda' ? 'selected' : '' }}>Luanda</option>
                                                                        <option value="Benguela" {{ $funcionario->naturalidade == 'Benguela' ? 'selected' : '' }}>Benguela</option>
                                                                        <option value="Huíla" {{ $funcionario->naturalidade == 'Huíla' ? 'selected' : '' }}>Huíla</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Estado Civil</label>
                                                                    <select name="estado_civil" class="form-control">
                                                                        <option value="">Selecione</option>
                                                                        <option value="Solteiro(a)" {{ $funcionario->estado_civil == 'Solteiro(a)' ? 'selected' : '' }}>Solteiro(a)</option>
                                                                        <option value="Casado(a)" {{ $funcionario->estado_civil == 'Casado(a)' ? 'selected' : '' }}>Casado(a)</option>
                                                                        <option value="Divorciado(a)" {{ $funcionario->estado_civil == 'Divorciado(a)' ? 'selected' : '' }}>Divorciado(a)</option>
                                                                        <option value="Viúvo(a)" {{ $funcionario->estado_civil == 'Viúvo(a)' ? 'selected' : '' }}>Viúvo(a)</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Morada</label>
                                                                    <input type="text" name="morada" class="form-control" value="{{ $funcionario->morada }}" required maxlength="255">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Salário</label>
                                                                    <input type="number" name="salario" class="form-control" value="{{ $funcionario->salario }}" step="0.01">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Turno de Trabalho</label>
                                                                    <select name="turno" class="form-control">
                                                                        <option value="">Selecione</option>
                                                                        <option value="Manhã" {{ $funcionario->turno == 'Manhã' ? 'selected' : '' }}>Manhã</option>
                                                                        <option value="Tarde" {{ $funcionario->turno == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                                                                        <option value="Noite" {{ $funcionario->turno == 'Noite' ? 'selected' : '' }}>Noite</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Tipo de Documento</label>
                                                                    <select name="tipo_documento" class="form-control">
                                                                        <option value="">Selecione</option>
                                                                        <option value="BI" {{ $funcionario->tipo_documento == 'BI' ? 'selected' : '' }}>BI</option>
                                                                        <option value="Passaporte" {{ $funcionario->tipo_documento == 'Passaporte' ? 'selected' : '' }}>Passaporte</option>
                                                                        <option value="Cartão de Residência" {{ $funcionario->tipo_documento == 'Cartão de Residência' ? 'selected' : '' }}>Cartão de Residência</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Número do Documento</label>
                                                                    <input type="text" name="numero_documento" class="form-control" value="{{ $funcionario->numero_documento }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Data de Nascimento</label>
                                                                    <input type="date" name="data_nascimento" class="form-control" value="{{ $funcionario->data_nascimento }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Status</label>
                                                                    <select name="status" class="form-control">
                                                                        <option value="Ativo" {{ $funcionario->status == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                                                        <option value="Inativo" {{ $funcionario->status == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Foto</label>
                                                                    <input type="file" name="foto" class="form-control">
                                                                    @if($funcionario->foto)
                                                                    <img src="{{ asset('storage/' . $funcionario->foto) }}" alt="Foto" class="img-thumbnail mt-2" width="80">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal de Visualização -->
                                        <div class="modal fade" id="verFuncionarioModal{{ $funcionario->id }}" tabindex="-1" aria-labelledby="verFuncionarioLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 50%; margin-left: 30%;">
                                                <div class="modal-content">
                                                    <div class="modal-header text-white" style="background: linear-gradient(90deg, #5e72e4, #825ee4);">
                                                        <h5 class="modal-title text-white" id="verFuncionarioLabel">Detalhes do Funcionário</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            <div class="col-md-6"><strong>Nome:</strong> {{ $funcionario->nome }}</div>
                                                            <div class="col-md-6"><strong>Sexo:</strong> {{ $funcionario->sexo }}</div>
                                                            <div class="col-md-6"><strong>Data Nascimento:</strong> {{ $funcionario->data_nascimento }}</div>
                                                            <div class="col-md-6"><strong>Idade:</strong> {{ $funcionario->idade }}</div>
                                                            <div class="col-md-6"><strong>Telefone:</strong> {{ $funcionario->telefone }}</div>
                                                            <div class="col-md-6"><strong>Email:</strong> {{ $funcionario->email }}</div>
                                                            <div class="col-md-6"><strong>Naturalidade:</strong> {{ $funcionario->naturalidade }}</div>
                                                            <div class="col-md-6"><strong>Nacionalidade:</strong> {{ $funcionario->nacionalidade }}</div>
                                                            <div class="col-md-6"><strong>Morada:</strong> {{ $funcionario->morada }}</div>
                                                            <div class="col-md-6"><strong>Turno:</strong> {{ $funcionario->turno }}</div>
                                                            <div class="col-md-6"><strong>Estado Civil:</strong> {{ $funcionario->estado_civil }}</div>
                                                            <div class="col-md-6"><strong>Salário:</strong> {{ $funcionario->salario }}</div>
                                                            <div class="col-md-6"><strong>Tipo Documento:</strong> {{ $funcionario->tipo_documento }}</div>
                                                            <div class="col-md-6"><strong>Nº Documento:</strong> {{ $funcionario->numero_documento }}</div>
                                                            <div class="col-md-6"><strong>Status:</strong> {{ $funcionario->status == 'Ativo' ? 'Ativo' : 'Inativo' }}</div>
                                                            <div class="col-md-12 mt-3">
                                                                @if($funcionario->foto)
                                                                <strong>Foto:</strong><br>
                                                                <img src="{{ asset('storage/' . $funcionario->foto) }}" alt="Foto" class="img-thumbnail" width="150">
                                                                @else
                                                                <strong>Foto:</strong> Não disponível
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
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


        </div>
    </main>
   @include('layouts.customise')
    <!--   Core JS Files   -->
    @include('components.js')

</body>

</html>