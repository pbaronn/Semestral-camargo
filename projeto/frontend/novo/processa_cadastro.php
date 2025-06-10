<?php
// Receber dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$dt_nascimento = $_POST['dt_nascimento'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$telefone2 = $_POST['telefone2'];
$endereco = $_POST['endereco'];
$email = $_POST['email'];

// Verificando os campos do formulário
$obs = isset($_POST['obs']) ? $_POST['obs'] : null;
$SN_saude_preexistente = isset($_POST['SN_saude_preexistente']) ? $_POST['SN_saude_preexistente'] : null;
$SN_lesao_cirurgia = isset($_POST['SN_lesao_cirurgia']) ? $_POST['SN_lesao_cirurgia'] : null;
$SN_restricao_medica = isset($_POST['SN_restricao_medica']) ? $_POST['SN_restricao_medica'] : null;
$SN_uso_medicacao = isset($_POST['SN_uso_medicacao']) ? $_POST['SN_uso_medicacao'] : null;
$SN_alergia_medicamento = isset($_POST['SN_alergia_medicamento']) ? $_POST['SN_alergia_medicamento'] : null;
$SN_episodios_exercicios = isset($_POST['SN_episodios_exercicios']) ? $_POST['SN_episodios_exercicios'] : null;
$SN_autorizacao_medica_fisica = isset($_POST['SN_autorizacao_medica_fisica']) ? $_POST['SN_autorizacao_medica_fisica'] : null;
$DS_saude_preexistente = isset($_POST['DS_saude_preexistente']) ? $_POST['DS_saude_preexistente'] : null;
$DS_lesao_cirurgia = isset($_POST['DS_lesao_cirurgia']) ? $_POST['DS_lesao_cirurgia'] : null;
$DS_restricao_medica = isset($_POST['DS_restricao_medica']) ? $_POST['DS_restricao_medica'] : null;
$DS_uso_medicacao = isset($_POST['DS_uso_medicacao']) ? $_POST['DS_uso_medicacao'] : null;
$DS_alergia_medicamento = isset($_POST['DS_alergia_medicamento']) ? $_POST['DS_alergia_medicamento'] : null;
$DS_episodios_exercicios = isset($_POST['DS_episodios_exercicios']) ? $_POST['DS_episodios_exercicios'] : null;
$DS_autorizacao_medica_fisica = isset($_POST['DS_autorizacao_medica_fisica']) ? $_POST['DS_autorizacao_medica_fisica'] : null;

// Estabelecendo conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forcegym";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Definindo um valor fixo para 'cduser' (ajustar conforme necessário)
// $cduser = 1; // Ajuste aqui conforme o sistema real de login

// Preparando o SQL para inserir os dados
$sql = "INSERT INTO user_form (obs,SN_saude_preexistente, SN_lesao_cirurgia, SN_restricao_medica, SN_uso_medicacao, SN_alergia_medicamento, SN_episodios_exercicios, SN_autorizacao_medica_fisica, DS_saude_preexistente, DS_lesao_cirurgia, DS_restricao_medica, DS_uso_medicacao, DS_alergia_medicamento, DS_episodios_exercicios, DS_autorizacao_medica_fisica, nome, sobrenome, dt_nascimento, cpf, telefone, telefone2, endereco, email)
VALUES ('$obs','$SN_saude_preexistente', '$SN_lesao_cirurgia', '$SN_restricao_medica', '$SN_uso_medicacao', '$SN_alergia_medicamento', '$SN_episodios_exercicios', '$SN_autorizacao_medica_fisica', '$DS_saude_preexistente', '$DS_lesao_cirurgia', '$DS_restricao_medica', '$DS_uso_medicacao', '$DS_alergia_medicamento', '$DS_episodios_exercicios', '$DS_autorizacao_medica_fisica', '$nome', '$sobrenome', '$dt_nascimento', '$cpf', '$telefone', '$telefone2', '$endereco', '$email')";

// Executando a consulta
if ($conn->query($sql) === TRUE) {
    echo "Novo cadastro realizado com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

// Fechando a conexão
$conn->close();
?>
