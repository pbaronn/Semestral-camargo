<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
    <link rel="stylesheet" href="configuracoes.css">
</head>
<body>
    <header class="header">
        <div class="logo-container">
        <div class="user-info">
            Seja bem vindo,  <?php echo htmlspecialchars($_SESSION['usuario']); ?>
        </div>
        <nav class="main-nav">
            <a href="../menu/menu.php" class="nav-item" id="inicio"><img src="img/casa.png" alt="Início"> Início</a>
            <a href="../configuracoes/configuracoes.php" class="nav-item" id="config"><img src="img/eng.png" alt="Configurações"> Configurações</a>
            <a href="../login/logout.php" class="nav-item" id="sair"><img src="img/sair.png" alt="Sair"> Sair</a>
        </nav>
    </header>

    <div class="config-container">
        <h1>Configurações</h1>
        
        <div class="config-form">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" class="form-input">
            </div>
            
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-input">
            </div>
            
            <div class="form-group">
                <label for="usuario">Nome de usuário:</label>
                <input type="text" id="usuario" class="form-input" value="@Camargo" disabled>
            </div>

            <div class="senha-section">
                <button class="btn-mudar-senha" id="btnMudarSenha">Mudar senha</button>
                
                <div class="campos-senha" id="camposSenha" style="display: none;">
                    <div class="form-group">
                        <label for="senhaAtual">Senha atual:</label>
                        <input type="password" id="senhaAtual" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label for="novaSenha">Nova senha:</label>
                        <input type="password" id="novaSenha" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmarSenha">Confirmação de nova senha:</label>
                        <input type="password" id="confirmarSenha" class="form-input">
                    </div>

                    <div class="button-group">
                        <button class="btn-salvar" id="btnSalvar">Salvar</button>
                        <button class="btn-cancelar" id="btnCancelar">Cancelar</button>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <button class="btn-voltar" id="btnVoltar">Voltar</button>
            </div>
        </div>
    </div>

    <script src="configuracoes.js"></script>
</body>
</html>