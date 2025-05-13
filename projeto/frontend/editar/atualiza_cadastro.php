<?php

// Conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'Forcegym';
$cduser = 1;
$conn = new mysqli($host,$user,$password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die('Falha na conexão: ' . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $dt_nascimento = $_POST['dt_nascimento'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $telefone2 = $_POST['telefone2'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $OBS = $_POST['OBS'];
    $SN_saude_preexistente = $_POST['SN_saude_preexistente'];
    $DS_saude_preexistente = $_POST['DS_saude_preexistente'];
    $SN_lesao_cirurgia = $_POST['SN_lesao_cirurgia'];
    $DS_lesao_cirurgia = $_POST['DS_lesao_cirurgia'];
    $SN_restricao_medica = $_POST['SN_restricao_medica'];
    $DS_restricao_medica = $_POST['DS_restricao_medica'];
    $SN_uso_medicacao = $_POST['SN_uso_medicacao'];
    $DS_uso_medicacao = $_POST['DS_uso_medicacao'];
    $SN_alergia_medicamento = $_POST['SN_alergia_medicamento'];
    $DS_alergia_medicamento = $_POST['DS_alergia_medicamento'];
    $SN_episodios_exercicios = $_POST['SN_episodios_exercicios'];
    $DS_episodios_exercicios = $_POST['DS_episodios_exercicios'];
    $SN_autorizacao_medica_fisica = $_POST['SN_autorizacao_medica_fisica'];
    $DS_autorizacao_medica_fisica = $_POST['DS_autorizacao_medica_fisica'];

    // Consulta SQL para atualizar os dados
    $sql = "UPDATE user_form SET nome='$nome',
                                 sobrenome='$sobrenome',
                                 dt_nascimento='$dt_nascimento',
                                 cpf='$cpf',
                                 telefone='$telefone',
                                 telefone2='$telefone2',
                                 endereco='$endereco',
                                 email='$email',
                                 OBS='$OBS',
                                 SN_saude_preexistente='$SN_saude_preexistente',
                                 DS_saude_preexistente='$DS_saude_preexistente',
                                 SN_lesao_cirurgia='$SN_lesao_cirurgia',
                                 DS_lesao_cirurgia='$DS_lesao_cirurgia',
                                 SN_restricao_medica='$SN_restricao_medica',
                                 DS_restricao_medica='$DS_restricao_medica',
                                 SN_uso_medicacao='$SN_uso_medicacao',
                                 DS_uso_medicacao='$DS_uso_medicacao',
                                 SN_alergia_medicamento='$SN_alergia_medicamento',
                                 DS_alergia_medicamento='$DS_alergia_medicamento',
                                 SN_episodios_exercicios='$SN_episodios_exercicios',
                                 DS_episodios_exercicios='$DS_episodios_exercicios',
                                 SN_autorizacao_medica_fisica='$SN_autorizacao_medica_fisica',
                                 DS_autorizacao_medica_fisica='$DS_autorizacao_medica_fisica' 
                                 WHERE cduser=$cduser";

    if ($conn->query($sql) === TRUE) {
        header('location: ../mensalidade/mensalidade.php');
    } else {
        echo 'Erro ao atualizar cadastro: ' . $conn->error;
    }
}

// Fecha a conexão
$conn->close();
?>
