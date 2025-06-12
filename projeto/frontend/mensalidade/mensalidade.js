document.addEventListener('DOMContentLoaded', () => {

    // Configura o select de vencimento
    const selectVencimento = document.getElementById('diaVencimento');

    // Configuração do botão de alterar vencimento
    const btnAlterarVencimento = document.querySelector('.btn-alterar-vencimento');
    btnAlterarVencimento.addEventListener('click', () => {
        const novoVencimento = selectVencimento.value;
        if (!novoVencimento) {
            alert('Por favor, selecione um dia de vencimento');
            return;
        }
        
        alert(`Dia de vencimento alterado para dia ${novoVencimento}`);
    });

    // Configuração dos botões
    const btnSalvar = document.querySelector('.btn-salvar');
    const btnCancelar = document.querySelector('.btn-cancelar');
    const inputData = document.getElementById('data');
    const inputValor = document.getElementById('valor');

    btnSalvar.addEventListener('click', () => {
        const data = inputData.value;
        const valor = inputValor.value;

        if (!data || !valor) {
            alert('Por favor, preencha todos os campos');
            return;
        }

        // Adiciona novo item ao histórico
        const historicoList = document.querySelector('.historico-list');
        const novoItem = document.createElement('div');
        novoItem.className = 'historico-item';
        novoItem.innerHTML = `
            <span class="data">${data}</span>
            <span class="valor">${valor}</span>
        `;
        historicoList.insertBefore(novoItem, historicoList.firstChild);

        // Limpa os campos
        inputData.value = '';
        inputValor.value = '';
    });

    btnCancelar.addEventListener('click', () => {
        inputData.value = '';
        inputValor.value = '';
    });

    // Formatação do campo de valor
    inputValor.addEventListener('input', (e) => {
        let valor = e.target.value.replace(/\D/g, '');
        if (valor) {
            valor = (parseFloat(valor) / 100).toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
            e.target.value = valor;
        }
    });

    // Formatação do campo de data
    inputData.addEventListener('input', (e) => {
        let data = e.target.value.replace(/\D/g, '');
        if (data.length >= 2) data = data.substring(0,2) + '/' + data.substring(2);
        if (data.length >= 5) data = data.substring(0,5) + '/' + data.substring(5,9);
        e.target.value = data;
    });


    inicio.addEventListener('click', () => {
        window.location.href = '../menu/menu.html';
    });

    config.addEventListener('click', () => {
        window.location.href = '../configuracoes/configuracoes.html';
    });

    sair.addEventListener('click', () => {
        window.location.href = '../login/login.html';
    });
}); 