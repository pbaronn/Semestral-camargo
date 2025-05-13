<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Force Gym</title>
    <link rel="stylesheet" href="login.css">
    <style>
        .error-message {
            color: #ff4444;
            background-color: #ffe6e6;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <img src="img/logo.png" class="logo">
        </div>
        <div class="right">
            <form class="login-box" method="POST" action="login.php">
                <h2 class="login-title">Login</h2>
                <input type="text" name="usuario" placeholder="Usuário" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button type="submit" class="btn-entrar">
                    <img src="img/sair.png" alt="Ícone de login" class="icon"> Entrar
                </button>
                <a href="../novasenha/senha.php" id="senhaa">Esqueci minha senha</a>
                <?php 
                if(isset($_GET['erro'])) {
                    $erro = $_GET['erro'];
                    $mensagem = '';
                    
                    switch($erro) {
                        case '1':
                            $mensagem = 'Usuário ou senha incorretos!';
                            break;
                        case '2':
                            $mensagem = 'Por favor, preencha todos os campos!';
                            break;
                        case '3':
                            $mensagem = 'Erro no sistema. Por favor, tente novamente mais tarde.';
                            break;
                        default:
                            $mensagem = 'Ocorreu um erro. Por favor, tente novamente.';
                    }
                    
                    echo '<div class="error-message">' . htmlspecialchars($mensagem) . '</div>';
                }
                ?>
            </form>
        </div>
    </div>
</body>
</html>