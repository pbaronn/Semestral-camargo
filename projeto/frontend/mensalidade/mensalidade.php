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
    <title>Mensalidade</title>
    <link rel="stylesheet" href="mensalidade.css">
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <img src="img/logo.png" alt="Logo" class="logo">
            <div class="user-info">
                Seja bem-vindo, <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Visitante';?>
            </div>
        </div>
        <nav class="main-nav">
            <a href="#" class="nav-item" id="inicio"><img src="img/casa.png" alt="Início"> Início</a>
            <a href="#" class="nav-item" id="config"><img src="img/eng.png" alt="Configurações"> Configurações</a>
            <a href="#" class="nav-item" id="sair"><img src="img/sair.png" alt="Sair"> Sair</a>
        </nav>
    </header>

    <div class="menu-container">
        <h1>Mensalidade</h1>
        <div class="search-container">
            <form method="GET" action="mensalidade.php">
                <input type="text" name="search" id="searchInput" placeholder="Buscar">
                <button type="submit" class="search-button">
                    <img src="img/lupa.png" alt="Buscar">
                </button>
            </form>
            </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Editar</th>
                    <th>Nome</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../../backend/conecta.php';
                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Consulta para obter os usuários
                    $stmt = $pdo->query("SELECT cduser, username, 0 as status FROM user");

                    // Listando os usuários
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td><a href="../editar/editar.php?id=' . $row['cduser'] . '"><img src="../visualizar/img/lapis.png" alt="Editar" style="width: px; height: px;"></a></td>';
                        echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                        echo '</tr>';
                    }

                } catch (PDOException $e) {
                    echo "<tr><td colspan='3'>Erro na conexão: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="mensalidade.js"></script>
</body>
</html>
