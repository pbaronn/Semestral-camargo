<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login/index.php');
    exit;
}

// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "forcegym");
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

// Buscar usuários do banco
$result = $mysqli->query("SELECT cd_userform, nome FROM user_form ORDER BY nome ASC");
$usuarios = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
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
                Seja bem vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>
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
                <input type="text" id="buscaNome" class="form-input" onkeyup="filtrarUsuarios()">
            </div>
        </div>
        <div class="user-list">
            <table id="tabelaUsuarios">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['cd_userform']) ?></td>
                            <td><?= htmlspecialchars($usuario['nome']) ?></td>
                            <td>
                                <a href="../mensalidade2/mensalidade2.php?cd_userform=<?= $usuario['cd_userform'] ?>">Ver Mensalidade</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
