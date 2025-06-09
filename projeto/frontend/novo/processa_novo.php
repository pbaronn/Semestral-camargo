<?php
session_start();
require_once '../login/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campos = [
        'cduser', 'SN_saude_preexistente', 'SN_lesao_cirurgia', 'SN_restricao_medica', 'SN_uso_medicacao',
        'SN_alergia_medicamento', 'SN_episodios_exercicios', 'SN_autorizacao_medica_fisica', 'DS_objetivo',
        'DS_saude_preexistente', 'DS_lesao_cirurgia', 'DS_restricao_medica', 'DS_uso_medicacao',
        'DS_alergia_medicamento', 'DS_episodios_exercicios', 'DS_autorizacao_medica_fisica', 'nome', 'sobrenome',
        'dt_nascimento', 'cpf', 'telefone', 'telefone2', 'endereco', 'email'
    ];
    $valores = [];
    foreach ($campos as $campo) {
        $valores[$campo] = $_POST[$campo] ?? '';
    }
    $valores['cduser'] = $valores['cpf'];
    $sql = "INSERT INTO user_form (" . implode(',', $campos) . ") VALUES (" . str_repeat('?,', count($campos)-1) . "?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($campos)), ...array_values($valores));
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Novo aluno cadastrado!'); window.location.href='../menu/menu.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar aluno!'); window.history.back();</script>";
    }
}
?> 