// Dados dos usuários (simulado)
const usuarios = {
    1: {
        id: 1,
        matricula: '001',
        nome: 'João da Silva',
        email: 'joaosilva@gmail.com',
        telefone: '(21)98687-4321',
        funcao: 'Escalador',
        nivel: 'I',
        cpf: '123.456.789-00',
        dataNascimento: '1990-05-15',
        admissao: '2020-01-10',
        demissional: '-',
        cep: '20000-000',
        cidade: 'Rio de Janeiro',
        logradouro: 'Av. Rio Branco, 123',
        foto: 'img/foto.png'
    },
    2: {
        id: 2,
        matricula: '002',
        nome: 'Ana Silva',
        email: 'anasilva@gmail.com',
        telefone: '(21)98765-4321',
        funcao: 'Artífice',
        nivel: 'II',
        cpf: '987.654.321-00',
        dataNascimento: '1985-08-20',
        admissao: '2019-03-15',
        demissional: '-',
        cep: '20000-001',
        cidade: 'Rio de Janeiro',
        logradouro: 'Rua das Flores, 456',
        foto: 'img/foto2.png'
    }
};

/**
 * Atualiza a tabela com os dados do objeto 'usuarios'
 * Esta função é chamada automaticamente quando há alterações
 */
function atualizarTabelaUsuarios() {
    const tableBody = document.getElementById('usuariosTableBody');
    if (!tableBody) return;

    // Limpa a tabela
    tableBody.innerHTML = '';

    // Itera sobre todos os usuários e cria as linhas
    for (const id in usuarios) {
        if (usuarios.hasOwnProperty(id)) {
            const usuario = usuarios[id];
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="usuario-id text-primary" style="cursor:pointer" data-usuario="${usuario.id}">${usuario.id}</td>
                <td>${usuario.nome}</td>
                <td>${usuario.email}</td>
                <td>${usuario.telefone}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type='button' class='btn btn-info btnVisualizar d-flex' data-usuario='${usuario.id}' title="Visualizar usuário">
                            <i class='bi bi-eye'></i> Visualizar
                        </button>
                        <button type='button' class='btn btn-warning btnEditar' data-usuario='${usuario.id}' title="Editar usuário">
                            <i class='bi bi-pencil'></i> Editar
                        </button>
                        <button type='button' class='btn btn-danger btnDeletar' data-usuario='${usuario.id}' title="Deletar usuário">
                            <i class='bi bi-trash'></i> Deletar
                        </button>
                    </div>
                </td>
            `;
            tableBody.appendChild(row);
        }
    }

    // Reattach event listeners
    anexarEventListeners();
}

/**
 * Anexa event listeners aos botões de visualizar, editar e deletar
 */
function anexarEventListeners() {
    // Botão Visualizar
    const botoesVisualizar = document.querySelectorAll('.btnVisualizar');
    botoesVisualizar.forEach(btn => {
        btn.addEventListener('click', function () {
            const usuarioId = this.getAttribute('data-usuario');
            if (usuarioId) {
                window.location.href = 'visualizar.html?id=' + encodeURIComponent(usuarioId);
            }
        });
    });

    // Botão Editar
    const botoesEditar = document.querySelectorAll('.btnEditar');
    botoesEditar.forEach(btn => {
        btn.addEventListener('click', function () {
            const usuarioId = this.getAttribute('data-usuario');
            if (usuarioId) {
                editarUsuario(usuarioId);
            }
        });
    });

    // Botão Deletar
    const botoesDeletar = document.querySelectorAll('.btnDeletar');
    botoesDeletar.forEach(btn => {
        btn.addEventListener('click', function () {
            const usuarioId = this.getAttribute('data-usuario');
            if (usuarioId) {
                confirmarDelecao(usuarioId);
            }
        });
    });

    // ID clicável
    const ids = document.querySelectorAll('.usuario-id');
    ids.forEach(cell => {
        cell.addEventListener('click', function () {
            const usuarioId = this.getAttribute('data-usuario');
            if (usuarioId) {
                window.location.href = 'visualizar.html?id=' + encodeURIComponent(usuarioId);
            }
        });
    });
}

/**
 * Função para editar usuário
 */
function editarUsuario(usuarioId) {
    const usuario = usuarios[usuarioId];
    if (!usuario) {
        alert('Usuário não encontrado!');
        return;
    }

    // Preenche o formulário com os dados do usuário
    document.getElementById('matricula').value = usuario.matricula;
    document.getElementById('email').value = usuario.nome; // Nome está no campo email
    document.getElementById('funcoes').value = usuario.funcao.toLowerCase().replace(' ', '');
    document.getElementById('nivel').value = usuario.nivel;
    document.getElementById('cpf').value = usuario.cpf;
    document.getElementById('data').value = usuario.dataNascimento;
    document.getElementById('admissao').value = usuario.admissao;
    document.getElementById('cep').value = usuario.cep;
    document.getElementById('cidade').value = usuario.cidade;
    document.getElementById('logradouro').value = usuario.logradouro;

    // Altera o título do modal e o botão
    document.getElementById('modalTitulo').innerText = 'Editar Usuário';
    const btnAvancar = document.getElementById('btnAvancar');
    btnAvancar.onclick = function() {
        salvarEdicaoUsuario(usuarioId);
    };
    btnAvancar.innerText = 'Salvar Alterações';

    // Abre o modal
    const modal = new bootstrap.Modal(document.getElementById('modalUsuario'));
    modal.show();
}

/**
 * Função para salvar edição do usuário
 */
function salvarEdicaoUsuario(usuarioId) {
    const usuario = usuarios[usuarioId];
    
    // Atualiza os dados
    usuario.matricula = document.getElementById('matricula').value;
    usuario.nome = document.getElementById('email').value;
    usuario.funcao = document.getElementById('funcoes').value;
    usuario.nivel = document.getElementById('nivel').value;
    usuario.cpf = document.getElementById('cpf').value;
    usuario.dataNascimento = document.getElementById('data').value;
    usuario.admissao = document.getElementById('admissao').value;
    usuario.cep = document.getElementById('cep').value;
    usuario.cidade = document.getElementById('cidade').value;
    usuario.logradouro = document.getElementById('logradouro').value;

    // Atualiza a tabela
    atualizarTabelaUsuarios();

    // Fecha o modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('modalUsuario'));
    modal.hide();

    alert('Usuário atualizado com sucesso!');
}

/**
 * Função para confirmar deleção
 */
function confirmarDelecao(usuarioId) {
    const usuario = usuarios[usuarioId];
    if (!usuario) {
        alert('Usuário não encontrado!');
        return;
    }

    // Abre um dialog de confirmação
    const confirmar = confirm(`Tem certeza que deseja excluir o usuário "${usuario.nome}"?\n\nEsta ação não poderá ser desfeita!`);
    
    if (confirmar) {
        // Deleta o usuário
        delete usuarios[usuarioId];
        
        // Atualiza a tabela
        atualizarTabelaUsuarios();
        
        alert('Usuário deletado com sucesso!');
    }
}

/**
 * Observa mudanças no objeto 'usuarios' e atualiza a tabela automaticamente
 */
const usuariosProxy = new Proxy(usuarios, {
    set: function(target, property, value) {
        target[property] = value;
        atualizarTabelaUsuarios();
        return true;
    },
    deleteProperty: function(target, property) {
        delete target[property];
        atualizarTabelaUsuarios();
        return true;
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Carrega os usuários na tabela ao iniciar
    atualizarTabelaUsuarios();
});