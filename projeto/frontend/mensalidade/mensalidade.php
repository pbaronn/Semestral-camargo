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
    <title>Busca de Nomes</title>
    <link rel="stylesheet" href="mensalidade.css">
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <div class="user-info">
                Seja bem vindo,<?php echo htmlspecialchars($_SESSION['usuario']); ?>
            </div>
        
        <nav class="main-nav">
            <a href="../menu/menu.php" class="nav-item" id="inicio"><img src="img/casa.png" alt="Início"> Início</a>
            <a href="../configuracoes/configuracoes.php" class="nav-item" id="config"><img src="img/eng.png" alt="Configurações"> Configurações</a>
            <a href="../login/logout.php" class="nav-item" id="sair"><img src="img/sair.png" alt="Sair"> Sair</a>
        </nav>
        </div>
    </header>

    <div class="mensalidade-container">
        <h1>Buscar Mensalidade</h1>
        <div class="form-container">
            <div class="form-group">
                <label for="buscaNome">Buscar Nome</label>
                <input type="text" id="buscaNome" class="form-input">
            </div>
            <div class="button-group">
                <button class="btn-buscar">Buscar</button>
            </div>
        </div>
    </div>

    <script src="mensalidade.js"></script>
</body>
</html> 