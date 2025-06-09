document.addEventListener('DOMContentLoaded', () => {
    // Elementos do DOM
    const btnMudarSenha = document.getElementById('btnMudarSenha');
    const camposSenha = document.getElementById('camposSenha');
    const btnSalvar = document.getElementById('btnSalvar');
    const btnCancelar = document.getElementById('btnCancelar');
    const btnVoltar = document.getElementById('btnVoltar');

    // Dados de exemplo do usuário
    const dadosUsuario = {
        nome: 'João Silva',
        email: 'joao.silva@email.com',
        usuario: '@Fulanrr23'
    };

    // Preenche os campos com os dados do usuário
    document.getElementById('nome').value = dadosUsuario.nome;
    document.getElementById('email').value = dadosUsuario.email;
    document.getElementById('usuario').value = dadosUsuario.usuario;

    // Função para mostrar campos de senha
    btnMudarSenha.addEventListener('click', () => {
        camposSenha.style.display = 'block';
        btnMudarSenha.style.display = 'none';
    });

    // Função para esconder campos de senha
    function esconderCamposSenha() {
        camposSenha.style.display = 'none';
        btnMudarSenha.style.display = 'block';
        // Limpa os campos
        document.getElementById('senhaAtual').value = '';
        document.getElementById('novaSenha').value = '';
        document.getElementById('confirmarSenha').value = '';
    }

    // Handler do botão Salvar
    btnSalvar.addEventListener('click', () => {
        const senhaAtual = document.getElementById('senhaAtual').value;
        const novaSenha = document.getElementById('novaSenha').value;
        const confirmarSenha = document.getElementById('confirmarSenha').value;

        if (!senhaAtual || !novaSenha || !confirmarSenha) {
            alert('Por favor, preencha todos os campos de senha');
            return;
        }

        if (novaSenha !== confirmarSenha) {
            alert('A nova senha e a confirmação não coincidem');
            return;
        }

        // Aqui você adicionaria a lógica para salvar no backend
        alert('Senha alterada com sucesso!');
        esconderCamposSenha();
    });

    // Handler do botão Cancelar
    btnCancelar.addEventListener('click', esconderCamposSenha);

    // Handler do botão Voltar
    btnVoltar.addEventListener('click', () => {
        window.location.href = '../menu/menu.php';
    });


    inicio.addEventListener('click', () => {
        window.location.href = '../menu/menu.php';
    });

    config.addEventListener('click', () => {
        window.location.href = '../configuracoes/configuracoes.php';
    });

    sair.addEventListener('click', () => {
        window.location.href = '../login/login.php';
    });
});