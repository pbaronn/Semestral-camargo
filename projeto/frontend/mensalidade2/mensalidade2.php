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

// --- Tratamento das mensagens de status (sucesso/erro) vindas do processa_mensalidade.php ---
$mensagem_sucesso = "";
$mensagem_erro = "";

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
        $mensagem_sucesso = "Mensalidade cadastrada com sucesso! 🎉";
    } elseif ($_GET['status'] == 'error' && isset($_GET['msg'])) {
        $mensagem_erro = htmlspecialchars(urldecode($_GET['msg'])); // Decodifica e protege a mensagem
    }
}

// --- Lógica para buscar e exibir dados ---

// Buscar nome do usuário na tabela user_form
$usuarioNome = "Desconhecido";
$stmt = $mysqli->prepare("SELECT nome FROM user_form WHERE cd_userform = ? LIMIT 1");
$stmt->bind_param("i", $cd_userform);
$stmt->execute();
$stmt->bind_result($usuarioNome);
$stmt->fetch();
$stmt->close();

// Variáveis para os status
$mensalidadeStatus = "não matriculado / sem registro";
$matriculaStatus = "não matriculado";

$mesAtual = date('m');
$anoAtual = date('Y');

// Lógica para determinar o Status da Matrícula (há registro para o mês atual?)
$stmt = $mysqli->prepare("
    SELECT COUNT(*)
    FROM user_mensalidade
    WHERE cd_userform = ?
    AND MONTH(dt_competencia) = ?
    AND YEAR(dt_competencia) = ?
");
$stmt->bind_param("iii", $cd_userform, $mesAtual, $anoAtual);
$stmt->execute();
$stmt->bind_result($quantidade_matricula_mes_atual);
$stmt->fetch();
if ($quantidade_matricula_mes_atual > 0) {
    $matriculaStatus = "matriculado";
}
$stmt->close();

// Lógica para determinar o Status da Mensalidade (situação do pagamento)
// Prioriza o status do mês atual, depois verifica atrasos
$stmt_mensalidade_atual = $mysqli->prepare("
    SELECT sn_paga
    FROM user_mensalidade
    WHERE cd_userform = ?
    AND MONTH(dt_competencia) = ?
    AND YEAR(dt_competencia) = ?
    LIMIT 1
");
$stmt_mensalidade_atual->bind_param("iii", $cd_userform, $mesAtual, $anoAtual);
$stmt_mensalidade_atual->execute();
$stmt_mensalidade_atual->bind_result($sn_paga_mes_atual);
if ($stmt_mensalidade_atual->fetch()) {
    if ($sn_paga_mes_atual == 1) {
        $mensalidadeStatus = "ativa";
    } else {
        $mensalidadeStatus = "pendente (mês atual)";
    }
} else {
    // Se não há mensalidade para o mês atual, verifica se há mensalidades atrasadas
    $stmt_atrasadas = $mysqli->prepare("
        SELECT COUNT(*)
        FROM user_mensalidade
        WHERE cd_userform = ?
        AND dt_competencia < CURDATE()
        AND sn_paga = 0
    ");
    $stmt_atrasadas->bind_param("i", $cd_userform);
    $stmt_atrasadas->execute();
    $stmt_atrasadas->bind_result($count_atrasadas);
    $stmt_atrasadas->fetch();
    $stmt_atrasadas->close();

    if ($count_atrasadas > 0) {
        $mensalidadeStatus = "atrasada";
    } else {
        $mensalidadeStatus = "sem mensalidade para o mês atual";
    }
}
$stmt_mensalidade_atual->close();

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

// Fechar conexão com o banco de dados
$mysqli->close();
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
    <?php // Abertura do bloco PHP para o loop
    foreach ([1, 5, 10, 15, 20, 25, 30] as $dia) {
        // ALTERNATIVA: usando aspas simples e concatenação
        echo '<option value="' . $dia . '">' . $dia . '</option>';
    }
    ?>
</select>
                    <button class="btn-alterar-vencimento">Salvar</button>
                </div>
            </div>

            <div class="content-section">
                <div class="mensalidade-section">
                    <h2>Nova Mensalidade</h2>
                    <!-- Mensagens de sucesso ou erro -->
                    <?php if (!empty($mensagem_sucesso)): ?>
                        <div style="color: green; margin-bottom: 10px; font-weight: bold;"><?php echo $mensagem_sucesso; ?></div>
                    <?php endif; ?>
                    <?php if (!empty($mensagem_erro)): ?>
                        <div style="color: red; margin-bottom: 10px; font-weight: bold;"><?php echo $mensagem_erro; ?></div>
                    <?php endif; ?>

                    <!-- Formulário para o cadastro de nova mensalidade -->
                    <form action="processa_mensalidade.php" method="POST">
                        <input type="hidden" name="acao" value="salvar_mensalidade">
                        <input type="hidden" name="cd_userform" value="<?php echo htmlspecialchars($cd_userform); ?>">

                        <div class="form-group">
                            <label for="data">Data</label>
                            <input type="date" id="data" name="data" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <input type="text" id="valor" name="valor" class="form-input" placeholder="Ex: 100,50" required pattern="^\d+([\.,]\d{1,2})?$">
                        </div>
                        <div class="button-group">
                            <button type="submit" class="btn-salvar">Salvar</button>
                            <button type="button" class="btn-cancelar" onclick="window.location.href='../mensalidade/mensalidade.php'">Cancelar</button>
                        </div>
                    </form>
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

    <!-- Mantenha o seu JS comentado se foi ele que resolveu o problema do input de data,
         ou se ele tiver outras funcionalidades que você deseja manter mas que não afetam o input de data. -->
    <!-- <script src="mensalidade2.js"></script> -->
</body>
</html>