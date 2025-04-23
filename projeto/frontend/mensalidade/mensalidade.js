// Dados de exemplo
const dadosTabela = [
    { id: 1, nome: 'João Silva', status: 'Ativo' },
    { id: 2, nome: 'Maria Santos', status: 'Inativo' },
    { id: 3, nome: 'Pedro Oliveira', status: 'Ativo' }
];

// Função para renderizar a tabela
function renderizarTabela(dados) {
    const tbody = document.querySelector('.data-table tbody');
    tbody.innerHTML = '';

    dados.forEach(item => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <button class="btn-editar" onclick="editarItem(${item.id})">
                    <img src="img/lapis.png" alt="Editar">
                </button>
            </td>
            <td>${item.nome}</td>
            <td>${item.status}</td>
        `;
        tbody.appendChild(tr);
    });
}

// Função de busca
function buscar(termo) {
    const resultados = dadosTabela.filter(item => 
        item.nome.toLowerCase().includes(termo.toLowerCase()) ||
        item.status.toLowerCase().includes(termo.toLowerCase())
    );
    renderizarTabela(resultados);
}

inicio.addEventListener('click', () => {
    window.location.href = '../menu/menu.html';
});


// Event listeners
document.addEventListener('DOMContentLoaded', () => {
    // Renderiza a tabela inicial
    renderizarTabela(dadosTabela);

    // Configura o campo de busca
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', (e) => {
        buscar(e.target.value);
    });

    config.addEventListener('click', () => {
        window.location.href = '../configuracoes/configuracoes.html';
    });

    sair.addEventListener('click', () => {
        window.location.href = '../login/login.html';
    });
    
});

// Função para editar item
function editarItem(id) {
    alert(`Editar item ${id}`);
} 