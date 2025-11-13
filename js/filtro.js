/**
 * Função para filtrar usuários por nome
 * Filtra em tempo real conforme o usuário digita no campo de pesquisa
 */
function filtrarUsuarios() {
    // Obtém o valor digitado no campo de pesquisa
    const searchInput = document.getElementById('searchInput');
    const filtro = searchInput.value.toLowerCase();
    
    // Obtém todas as linhas da tabela
    const tabela = document.getElementById('usuariosTableBody');
    const linhas = tabela.getElementsByTagName('tr');
    
    // Itera sobre cada linha da tabela
    for (let i = 0; i < linhas.length; i++) {
        const linha = linhas[i];
        
        // Obtém o texto da coluna de nome (segunda coluna, índice 1)
        const nomeCell = linha.getElementsByTagName('td')[1];
        
        if (nomeCell) {
            const textoDaLinha = nomeCell.textContent || nomeCell.innerText;
            
            // Verifica se o nome contém o texto digitado
            if (textoDaLinha.toLowerCase().includes(filtro)) {
                linha.style.display = ''; // Mostra a linha
            } else {
                linha.style.display = 'none'; // Esconde a linha
            }
        }
    }
}

/**
 * Função para limpar o filtro e mostrar todos os usuários
 */
function limparFiltro() {
    const searchInput = document.getElementById('searchInput');
    searchInput.value = '';
    filtrarUsuarios();
}

// Event listener para limpar o filtro ao pressionar Escape
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    
    if (searchInput) {
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                limparFiltro();
            }
        });
    }
});
