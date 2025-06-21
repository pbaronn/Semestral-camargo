<?php
session_start();
if (!isset($_SESSION['logado'])) {
    // Redireciona para o login se não estiver logado
    header('Location: ../login/index.php');
    exit;
}

// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "forcegym");
if ($mysqli->connect_error) {
    // Se houver erro de conexão, redireciona com mensagem de erro
    header('Location: mensalidade.php?status=error&msg=Erro de conexão com o banco de dados.');
    exit;
}

// Pegar cd_userform da URL (será passado via hidden input ou GET na action do form)
$cd_userform = isset($_POST['cd_userform']) ? (int)$_POST['cd_userform'] : null;

// Se o cd_userform não for válido, redireciona
if (!$cd_userform) {
    header('Location: mensalidade.php?status=error&msg=Usuário não especificado para o cadastro.');
    exit;
}

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'salvar_mensalidade') {
    $data_competencia = $_POST['data'] ?? '';
    // Substitui vírgula por ponto para garantir que o valor seja tratado como float corretamente
    $valor_mensalidade = str_replace(',', '.', $_POST['valor'] ?? '');

    $mensagem_erro = "";

    // Validação básica dos dados
    if (empty($data_competencia) || empty($valor_mensalidade)) {
        $mensagem_erro = "Por favor, preencha a data e o valor da mensalidade.";
    } elseif (!is_numeric($valor_mensalidade) || $valor_mensalidade <= 0) {
        $mensagem_erro = "O valor da mensalidade deve ser um número positivo válido.";
    }

    if (!empty($mensagem_erro)) {
        // Redireciona de volta com a mensagem de erro
        header("Location: mensalidade.php?cd_userform=" . $cd_userform . "&status=error&msg=" . urlencode($mensagem_erro));
        exit();
    } else {
        // Para uma nova mensalidade, 'sn_paga' é 0 (pendente) por padrão
        $sn_paga = 0; // 0 para pendente, 1 para paga

        // Prepara a consulta SQL para inserção
        $stmt = $mysqli->prepare("INSERT INTO user_mensalidade (cd_userform, dt_competencia, vl_mensalidade, sn_paga) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("isdi", $cd_userform, $data_competencia, $valor_mensalidade, $sn_paga);
            if ($stmt->execute()) {
                // Redireciona para a página principal com um parâmetro de sucesso
                header("Location: mensalidade.php");
                exit();
            } else {
                // Erro ao executar a inserção
                header("Location: mensalidade.php?cd_userform=" . $cd_userform . "&status=error&msg=" . urlencode("Erro ao cadastrar mensalidade: " . $stmt->error));
                exit();
            }
            $stmt->close();
        } else {
            // Erro na preparação da consulta SQL
            header("Location: mensalidade.php?cd_userform=" . $cd_userform . "&status=error&msg=" . urlencode("Erro na preparação da consulta SQL: " . $mysqli->error));
            exit();
        }
    }
} else {
    // Se não foi um POST válido, redireciona de volta sem processar
    header('Location: mensalidade.php?cd_userform=' . $cd_userform);
    exit;
}

$mysqli->close();
?>