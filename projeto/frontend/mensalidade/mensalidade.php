<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login/index.php');
    exit;
}
?>
<<<<<<< HEAD

=======
>>>>>>> ef75c40ebfecf8f6c14a2c090dff1485f9997f30
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Busca de Nomes</title>
=======
    <title>Mensalidade</title>
>>>>>>> ef75c40ebfecf8f6c14a2c090dff1485f9997f30
    <link rel="stylesheet" href="mensalidade.css">
</head>
<body>
    <header class="header">
        <div class="logo-container">
<<<<<<< HEAD
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
=======
            <img src="img/logo.png" alt="Logo" class="logo">
            <div class="user-info">
                Seja bem-vindo, <?php echo isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : 'Visitante';?>
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
                    $stmt = $pdo->query("SELECT cduser, nome, 0 as status FROM user_form");

                    // Listando os usuários
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['nome']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                        echo '</tr>';
                    }

                } catch (PDOException $e) {
                    echo "<tr><td colspan='3'>Erro na conexão: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
>>>>>>> ef75c40ebfecf8f6c14a2c090dff1485f9997f30
    </div>

    <script src="mensalidade.js"></script>
</body>
<<<<<<< HEAD
</html> 
=======
</html>
>>>>>>> ef75c40ebfecf8f6c14a2c090dff1485f9997f30
