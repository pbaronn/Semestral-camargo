<?php
session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    // Validação básica
    if (empty($username) || empty($senha)) {
        header('Location: index.php?erro=2');
        exit;
    }

    // Prepara a consulta SQL com os nomes corretos da tabela e campos
    $sql = "SELECT * FROM user WHERE username = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        error_log("Erro na preparação da query: " . $conn->error);
        header('Location: index.php?erro=3');
        exit;
    }

    $stmt->bind_param("ss", $username, $senha);
    
    if (!$stmt->execute()) {
        error_log("Erro na execução da query: " . $stmt->error);
        header('Location: index.php?erro=3');
        exit;
    }

    $result = $stmt->get_result();

    // Verifica se encontrou algum usuário
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $usuario['username'];
        $_SESSION['id'] = $usuario['cduser'];
        $_SESSION['ultimo_acesso'] = time();
        
        // Registra o login no log
        error_log("Login bem-sucedido para o usuário: " . $username);
        
        header('Location: ../menu/menu.php');
        exit;
    } else {
        error_log("Tentativa de login falhou para o usuário: " . $username);
        header('Location: index.php?erro=1');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>