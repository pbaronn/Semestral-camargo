document.addEventListener('DOMContentLoaded', function() {
    const btnMudarSenha = document.getElementById('btnMudarSenha');
    const camposSenha = document.getElementById('camposSenha');
    const btnSalvar = document.getElementById('btnSalvar');
    const btnCancelar = document.getElementById('btnCancelar');
    const btnVoltar = document.getElementById('btnVoltar');

    const senhaAtualInput = document.getElementById('senhaAtual');
    const novaSenhaInput = document.getElementById('novaSenha');
    const confirmarSenhaInput = document.getElementById('confirmarSenha');

    // Cria um elemento para exibir mensagens (se ainda não existir no HTML)
    let messageDiv = document.getElementById('passwordMessage');
    if (!messageDiv) {
        messageDiv = document.createElement('div');
        messageDiv.id = 'passwordMessage';
        messageDiv.style.marginTop = '15px';
        messageDiv.style.padding = '10px';
        messageDiv.style.borderRadius = '5px';
        messageDiv.style.textAlign = 'center';
        messageDiv.style.display = 'none'; // Inicialmente oculto
        // Insere a div de mensagem após a seção de senha
        const senhaSection = document.querySelector('.senha-section');
        if (senhaSection) {
            senhaSection.parentNode.insertBefore(messageDiv, senhaSection.nextSibling);
        }
    }


    // Event listener para o botão "Mudar senha"
    btnMudarSenha.addEventListener('click', function() {
        camposSenha.style.display = 'block'; // Mostra os campos de senha
        btnMudarSenha.style.display = 'none'; // Esconde o botão "Mudar senha"
        messageDiv.style.display = 'none'; // Esconde qualquer mensagem anterior
        messageDiv.textContent = ''; // Limpa o texto da mensagem
    });

    // Event listener para o botão "Cancelar"
    btnCancelar.addEventListener('click', function() {
        camposSenha.style.display = 'none'; // Esconde os campos de senha
        btnMudarSenha.style.display = 'block'; // Mostra o botão "Mudar senha" novamente
        clearPasswordFields(); // Limpa os campos
        messageDiv.style.display = 'none'; // Esconde qualquer mensagem anterior
        messageDiv.textContent = '';
    });

    // Event listener para o botão "Salvar"
    btnSalvar.addEventListener('click', function() {
        const senhaAtual = senhaAtualInput.value;
        const novaSenha = novaSenhaInput.value;
        const confirmarSenha = confirmarSenhaInput.value;

        // Validação client-side (básica, a validação principal é no servidor)
        if (novaSenha !== confirmarSenha) {
            displayMessage('A nova senha e a confirmação não coincidem.', false);
            return;
        }
        if (novaSenha.length < 6) { // Deve ser consistente com a validação do PHP
            displayMessage('A nova senha deve ter no mínimo 6 caracteres.', false);
            return;
        }

        // Envia os dados para o script PHP usando Fetch API
        fetch('processa_senha.php', {
            method: 'POST', // Método HTTP POST
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded', // Tipo de conteúdo para dados de formulário
            },
            // Converte os dados do formulário para o formato URL-encoded
            body: new URLSearchParams({
                senhaAtual: senhaAtual,
                novaSenha: novaSenha,
                confirmarSenha: confirmarSenha
            }).toString()
        })
        .then(response => response.json()) // Converte a resposta para JSON
        .then(data => {
            if (data.success) {
                displayMessage(data.message, true); // Exibe mensagem de sucesso
                camposSenha.style.display = 'none'; // Esconde os campos após sucesso
                btnMudarSenha.style.display = 'block'; // Mostra o botão "Mudar senha" novamente
                clearPasswordFields(); // Limpa os campos
            } else {
                displayMessage(data.message, false); // Exibe mensagem de erro
            }
        })
        .catch(error => {
            console.error('Erro na requisição:', error); // Loga erros no console
            displayMessage('Ocorreu um erro ao tentar alterar a senha. Tente novamente.', false);
        });
    });

    // Event listener para o botão "Voltar"
    btnVoltar.addEventListener('click', function() {
        window.history.back(); // Volta para a página anterior no histórico do navegador
    });

    // Função para limpar os campos de senha
    function clearPasswordFields() {
        senhaAtualInput.value = '';
        novaSenhaInput.value = '';
        confirmarSenhaInput.value = '';
    }

    // Função para exibir mensagens ao usuário
    function displayMessage(message, isSuccess) {
        messageDiv.textContent = message;
        messageDiv.style.display = 'block'; // Mostra a div de mensagem
        if (isSuccess) {
            // Estilos para mensagem de sucesso
            messageDiv.style.backgroundColor = '#d4edda'; // Verde claro
            messageDiv.style.color = '#155724'; // Texto verde escuro
            messageDiv.style.borderColor = '#c3e6cb'; // Borda verde
        } else {
            // Estilos para mensagem de erro
            messageDiv.style.backgroundColor = '#f8d7da'; // Vermelho claro
            messageDiv.style.color = '#721c24'; // Texto vermelho escuro
            messageDiv.style.borderColor = '#f5c6cb'; // Borda vermelha
        }
    }
});