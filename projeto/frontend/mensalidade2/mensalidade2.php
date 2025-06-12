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

// Pegar cd_userform da URL
$cd_userform = isset($_GET['cd_userform']) ? (int)$_GET['cd_userform'] : null;
if (!$cd_userform) {
    die("Usuário não especificado, guerreiro!");
}

// Buscar nome do usuário na tabela user_form
$usuarioNome = "Desconhecido";
$stmt = $mysqli->prepare("SELECT nome FROM user_form WHERE cd_userform = ? LIMIT 1");
$stmt->bind_param("i", $cd_userform);
$stmt->execute();
$stmt->bind_result($usuarioNome);
$stmt->fetch();
$stmt->close();

// Status da mensalidade e matrícula
$mensalidadeStatus = "não matriculado";
$matriculaStatus = "não matriculado";

// Buscar status da mensalidade
$stmt = $mysqli->prepare("
    SELECT dt_competencia, sn_paga 
    FROM user_mensalidade 
    WHERE cd_userform = ? 
    ORDER BY dt_competencia DESC 
    LIMIT 1
");
$stmt->bind_param("i", $cd_userform);
$stmt->execute();
$stmt->bind_result($dt_competencia, $sn_paga);
if ($stmt->fetch()) {
    if ($dt_competencia < date('Y-m-d')) {
        $mensalidadeStatus = $sn_paga ? "ativa" : "atrasada";
    } else {
        $mensalidadeStatus = "ativa";
    }
}
$stmt->close();

// Verificar matrícula no mês atual
$mesAtual = date('m');
$anoAtual = date('Y');
$stmt = $mysqli->prepare("
    SELECT COUNT(*) 
    FROM user_mensalidade 
    WHERE cd_userform = ? 
    AND MONTH(dt_competencia) = ? 
    AND YEAR(dt_competencia) = ?
");
$stmt->bind_param("iii", $cd_userform, $mesAtual, $anoAtual);
$stmt->execute();
$stmt->bind_result($quantidade);
$stmt->fetch();
if ($quantidade > 0) {
    $matriculaStatus = "matriculado";
}
$stmt->close();

// Buscar histórico de mensalidades
$stmt = $mysqli->prepare("
    SELECT dt_competencia, vl_mensalidade, sn_paga 
    FROM user_mensalidade 
    WHERE cd_userform = ? 
    ORDER BY dt_competencia DESC
");
$stmt->bind_param("i", $cd_userform);
$stmt->execute();
$resultado = $stmt->get_result();
$historico = $resultado->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensalidade</title>
    <link rel="stylesheet" href="mensalidade2.css">
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
        <h1>Mensalidade</h1>
        <div class="form-container">
            <div class="info-section">
                <div class="form-group">
                    <label>Nome: <?php echo htmlspecialchars($usuarioNome); ?></label>
                </div>
                <div class="form-group">
                    <label>Status da mensalidade:</label>
                    <span class="info-text"><?php echo htmlspecialchars($mensalidadeStatus); ?></span>
                </div>
                <div class="form-group">
                    <label>Status da matrícula:</label>
                    <span class="info-text"><?php echo htmlspecialchars($matriculaStatus); ?></span>
                </div>
            </div>

            <div class="vencimento-section">
                <div class="vencimento-title">Melhor Dia de Vencimento</div>
                <div class="vencimento-content">
                    <select id="diaVencimento" class="select-vencimento">
                        <option value="">Selecione o dia</option>
                        <?php
                        foreach ([1, 5, 10, 15, 20, 25, 30] as $dia) {
                            echo "<option value=\"$dia\">$dia</option>";
                        }
                        ?>
                    </select>
                    <button class="btn-alterar-vencimento">Salvar</button>
                </div>
            </div>

            <div class="content-section">
                <div class="mensalidade-section">
                    <h2>Nova Mensalidade</h2>
                    <div class="form-group">
                        <label for="data">Data</label>
                        <input type="date" id="data" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input type="text" id="valor" class="form-input">
                    </div>
                    <div class="button-group">
                        <button class="btn-salvar">Salvar</button>
                        <button class="btn-cancelar">Cancelar</button>
                    </div>
                </div>

                <div class="historico-section">
                    <h2>Histórico</h2>
                    <div class="historico-list">
                        <?php if (!empty($historico)): ?>
                            <table class="historico-table">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Valor</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($historico as $linha): ?>
                                        <tr>
                                            <td><?= date("d/m/Y", strtotime($linha['dt_competencia'])) ?></td>
                                            <td>R$ <?= number_format($linha['vl_mensalidade'], 2, ',', '.') ?></td>
                                            <td><?= $linha['sn_paga'] ? 'Paga' : 'Pendente' ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Nenhuma mensalidade registrada ainda.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="mensalidade2.js"></script>
</body>
</html>
