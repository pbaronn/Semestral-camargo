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
    <title>Menu - Force Gym</title>
    <link rel="stylesheet" href="menu.css">
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <div class="user-info">
                Seja bem vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>
            </div>
            <nav class="main-nav">
                <a href="menu.php" class="nav-item"><img src="img/casa.png" alt="Início"> Início</a>
                <a href="../configuracoes/configuracoes.php" class="nav-item"><img src="img/eng.png" alt="Configurações"> Configurações</a>
                <a href="../login/logout.php" class="nav-item"><img src="img/sair.png" alt="Sair"> Sair</a>
            </nav>
        </div>
    </header>

    <div class="menu-container">
        <h1>Menu</h1>
        
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar">
            <button type="button" class="search-button">
                <img src="img/lupa.png" alt="Buscar">
            </button>
        </div>

        <div class="action-buttons">
            <a href="../novo/novo.php" class="btn-novo" id="novo">
                <img src="img/pe.png" alt="Novo" class="icon">
                Novo
            </a>
            <a href="../mensalidade/mensalidade.php" class="btn-mensalidade" id="mensalidade">
                <img src="img/dindin.png" alt="Mensalidade" class="icon">
                Mensalidade
            </a>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Editar</th>
                    <th>Código</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../login/conexao.php';
                
                $sql = "SELECT cd_userform, nome, sobrenome FROM user_form ORDER BY nome";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><a href='../editar/editar.php?id=" . $row['cd_userform'] . "'><img src='img/editar.png' alt='Editar'></a></td>";
                        echo "<td>" . htmlspecialchars($row['cd_userform']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nome'] . ' ' . $row['sobrenome']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum aluno cadastrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="menu.js"></script>
</body>
</html> 