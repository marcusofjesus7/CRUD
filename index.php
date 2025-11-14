<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Gerenciamento de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.ico" type="image/x-icon">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark sticky-top">
        <div class="container-fluid">
            <span class="navbar-brand">
                <i class="bi bi-person-circle"></i> CRUD Usuários
            </span>
        </div>
    </nav>

    <!-- Container Principal -->
    <div class="container container-main">
        <h1 class="title-main"><i class="bi bi-people"></i> Gerenciador de Usuários</h1>
        <p class="subtitle">Crie, edite, visualize e delete usuários de forma simples e intuitiva</p>

        <!-- Barra de Ação -->
        <div class="row mb-4">
            <div class="col-md-6 search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" class="form-control" placeholder="Pesquisar por nome..."
                    onkeyup="filtrarUsuarios()">
            </div>
            <div class="col-md-6 text-end">
                <a class="btn btn-novo text-white" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><i class="bi bi-person-plus"></i>
                    Novo usuário
                </a>
            </div>
        </div>

        <!-- Tabela de Usuários -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="usuariosTableBody">
                    <!-- Dados carregados dinamicamente do dados.js -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Novo/Editar Usuário -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Dados Pessoais</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="matricula" class="form-label">Matrícula</label>
                            <input type="text" class="form-control" id="matricula" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <select name="funcao" id="funcao" class="form-select">
                                <option value="" disabled selected>Função</option>
                                <option value="escalador">Escalador</option>
                                <option value="artifice">Artifice</option>
                                <option value="ajudante">Ajudante</option>
                                <option value="tst">Técnico de Segurança do Trabalho</option>
                                <option value="vigia">Vigia</option>
                                <option value="especialista">Especialista</option>
                                <option value="encarregado">Encarregado</option>
                                <option value="motorista">Motorista</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <select name="nivel" id="nivel" class="form-select">
                                <option value="" disabled selected>Nível</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" name="cpf" id="cpf">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                            <input type="file" class="form-control" id="foto_perfil" accept="image/*">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="admissao" class="form-label">Admissão</label>
                            <input type="date" class="form-control" id="admissao" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="demissional" class="form-label">Demissional</label>
                            <input type="date" class="form-control" id="demissional">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" class="form-control" id="numero" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="logradouro">Logradouro</label>
                        <input type="text" class="form-control" id="logradouro" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="bairro" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidade" required>
                        </div>
                    </div>
                    <hr class="hr hr-blurry">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <select name="status" id="status" class="form-select">
                                <option value="" disabled selected>Status</option>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                                <option value="ferias">Férias</option>
                                <option value="licenca">Licença</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="docmento_identificacao" class="form-label">Documento de Identificação</label>
                            <input type="file" class="form-control" id="documento_identificacao"
                                accept="image/*,application/pdf">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ordem_servico" class="form-label">Ordem de Serviço</label>
                            <input type="file" class="form-control" id="ordem_servico" accept="image/*,application/pdf">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ficha_registro" class="form-label">Ficha de Registro</label>
                            <input type="file" class="form-control" id="ficha_registro"
                                accept="image/*,application/pdf">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="atestados_licencas" class="form-label">Atestados e Licenças</label>
                            <input type="text" class="form-control" id="atestados_licencas"
                                accept="image/*,application/pdf">
                            <input type="file" class="form-control" id="atestados_licencas"
                                accept="image/*,application/pdf">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal">
                        Fechar
                    </button>
                    <button class="btn btn-outline-dark" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                        data-bs-dismiss="modal">Avançar</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--Modal Saude e Segurança-->
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Saúde e Segurança do Trabalho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="usuarioForm">

                        <!-- ASO (fixo) -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Data do ASO:</label>
                                <input type="date" class="form-control" id="dataASO" name="dataASO" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Arquivo do ASO:</label>
                                <input type="file" class="form-control" id="ASO" name="ASO" accept=".pdf" required>
                                <small class="text-muted">Apenas PDF, máx. 5MB</small>
                            </div>
                        </div>

                        <hr class="divider">

                        <?php include 'php/lista_doc.php'; ?>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-outline-success" onclick="salvar()">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Visualizar Usuário -->
    <!-- Modal Confirmar Exclusão -->
    <div class="modal fade" id="modalConfirmar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirmar Exclusão</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir este usuário?</p>
                    <p class="fw-bold" id="nomeExcluir"></p>
                    <p class="text-danger"><small>Esta ação não poderá ser desfeita!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="confirmarExclusao()">
                        <i class="bi bi-trash"></i> Excluir
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/filtro.js"></script>
    <script src="js/modal_usuario.js"></script>
    <script src="js/cep.js"></script>
    <script src="js/modalSaude.js"></script>
    <script src="js/dados.js"></script>
</body>

</html>