<?php
// Inicia a sessão para acessar os dados do usuário logado
session_start();

// Define o cabeçalho para que a resposta seja JSON
header('Content-Type: application/json');

// Verifica se o usuário está logado
if (!isset($_SESSION['logado'])) {
    echo json_encode(['success' => false, 'message' => 'Você precisa estar logado para alterar a senha.']);
    exit;
}

$cduser = $_SESSION['logado'];

// Conecta ao banco de dados
// Certifique-se de que as credenciais do banco (usuário, senha, nome do banco) estão corretas
$mysqli = new mysqli("localhost", "root", "", "forcegym");

// Verifica se houve erro na conexão
if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Erro de conexão com o banco de dados. Por favor, tente novamente mais tarde.']);
    exit;
}

// Pega os dados enviados via POST (do formulário JavaScript)
$senhaAtual = $_POST['senhaAtual'] ?? '';
$novaSenha = $_POST['novaSenha'] ?? '';
$confirmarSenha = $_POST['confirmarSenha'] ?? '';

// Validação básica dos campos
if (empty($senhaAtual) || empty($novaSenha) || empty($confirmarSenha)) {
    echo json_encode(['success' => false, 'message' => 'Por favor, preencha todos os campos de senha.']);
    $mysqli->close();
    exit;
}

if ($novaSenha !== $confirmarSenha) {
    echo json_encode(['success' => false, 'message' => 'A nova senha e a confirmação não coincidem.']);
    $mysqli->close();
    exit;
}

// Opcional: Validação de comprimento mínimo para a nova senha
if (strlen($novaSenha) < 6) { // Ajuste o valor conforme sua política de segurança
    echo json_encode(['success' => false, 'message' => 'A nova senha deve ter no mínimo 6 caracteres.']);
    $mysqli->close();
    exit;
}

// 1. Busca a senha (hash) atual do usuário no banco de dados
$stmt = $mysqli->prepare("SELECT senha FROM user WHERE cduser = ?");
$stmt->bind_param("i", $cduser); // 'i' indica que $cduser é um inteiro
$stmt->execute();
$stmt->bind_result($hashedPasswordFromDb);
$stmt->fetch();
$stmt->close();

// Verifica se encontrou o usuário e sua senha
if (!$hashedPasswordFromDb) {
    echo json_encode(['success' => false, 'message' => 'Erro: Usuário não encontrado.']);
    $mysqli->close();
    exit;
}

// 2. Verifica se a senha atual fornecida pelo usuário corresponde ao hash no banco de dados
// Usa password_verify para comparar a senha em texto claro com o hash
if (!password_verify($senhaAtual, $hashedPasswordFromDb)) {
    echo json_encode(['success' => false, 'message' => 'A senha atual está incorreta.']);
    $mysqli->close();
    exit;
}

// 3. Se a senha atual estiver correta, gera o hash da nova senha
$novaSenhaHashed = password_hash($novaSenha, PASSWORD_DEFAULT); // PASSWORD_DEFAULT usa o algoritmo mais forte disponível

// 4. Atualiza a senha no banco de dados
$stmt = $mysqli->prepare("UPDATE user SET senha = ? WHERE cduser = ?");
$stmt->bind_param("si", $novaSenhaHashed, $cduser); // 's' para string (senha), 'i' para inteiro (cduser)

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Senha alterada com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao tentar alterar a senha: ' . $stmt->error]);
}

// Fecha a declaração e a conexão com o banco de dados
$stmt->close();
$mysqli->close();
?>