<?php
session_start();

if (!isset($_SESSION['logado'])) {
    header('Location: ../login/index.php');
    exit;
}

require '../../backend/conexao.php';

// Captura o ID passado via GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    echo "ID inválido ou não informado.";
    exit;
}

// Consulta na tabela user_form
$sql = "SELECT * FROM user_form WHERE cd_userform = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Cadastro não encontrado.";
    exit;
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cadastro</title>
    <link rel="stylesheet" href="editar.css">
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <div class="user-info">
                Seja bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>
            </div>
            <nav class="main-nav">
                <a href="../menu/menu.php" class="nav-item" id="inicio"><img src="img/casa.png" alt="Início"> Início</a>
                <a href="../confuguracoes/confuguracoes.php" class="nav-item" id="config"><img src="img/eng.png" alt="Configurações"> Configurações</a>
                <a href="../login/logout.php" class="nav-item"><img src="img/sair.png" alt="Sair"> Sair</a>
            </nav>
        </div>
    </header>

    <div class="cadastro-container">
        <h1>Editar Cadastro</h1>
        
        <div class="cadastro-form">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" class="form-input"  value="<?php echo $row['nome']; ?>">
            </div>

            <div class="form-group">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" id="sobrenome" name="sobrenome" class="form-input"value="<?php echo $row['sobrenome']; ?>">
            </div>

            <div class="form-group">
                <label for="dataNascimento">Data de nascimento</label>
                <input type="text" id="dt_nascimento" name="dt_nascimento" class="form-input"value="<?php echo $row['dt_nascimento']; ?>">
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" class="form-input"value="<?php echo $row['cpf']; ?>">
            </div>

            <div class="form-group">
                <label for="tel1">Tel.</label>
                <input type="text" id="telefone" name="telefone" class="form-input"value="<?php echo $row['telefone']; ?>">
            </div>

            <div class="form-group">
                <label for="tel2">Tel. 2</label>
                <input type="text" id="telefone2" name="telefone2" class="form-input"value="<?php echo $row['telefone2']; ?>">
            </div>

            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" class="form-input"value="<?php echo $row['endereco']; ?>">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-input"value="<?php echo $row['email']; ?>">
            </div>

            <div class="form-group">
                <label for="obs">Observações</label>
                <textarea id="obs" name="obs" class="form-input textarea"><?php echo htmlspecialchars($row['obs']); ?></textarea>
            </div>

            <div class="form-group checkbox-group">
                <label>Possui alguma condição de saúde pré-existente?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="SN_saude_preexistente" value="nao" <?php if($row['SN_saude_preexistente'] == '0') echo 'checked'; ?>> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_saude_preexistente" value="sim" <?php if($row['SN_saude_preexistente'] == '1') echo 'checked'; ?>> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="DS_saude_preexistente" name="DS_saude_preexistente"value="<?php echo $row['DS_saude_preexistente']; ?>">
            </div>

            <div class="form-group checkbox-group">
                <label>Já teve alguma lesão grave ou cirurgia?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="SN_lesao_cirurgia" value="nao" <?php if($row['SN_lesao_cirurgia'] == '0') echo 'checked'; ?>> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_lesao_cirurgia" value="sim" <?php if($row['SN_lesao_cirurgia'] == '1') echo 'checked'; ?>> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="DS_lesao_cirurgia" name="DS_lesao_cirurgia" value="<?php echo $row['DS_lesao_cirurgia']; ?>">
            </div>

            <div class="form-group checkbox-group">
                <label>Possui alguma restrição médica para atividades físicas?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="SN_restricao_medica" value="nao" <?php if($row['SN_restricao_medica'] == '0') echo 'checked'; ?>> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_restricao_medica" value="sim"<?php if($row['SN_restricao_medica'] == '1') echo 'checked'; ?>> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" name="DS_restricao_medica" id="DS_restricao_medica" value="<?php echo $row['DS_restricao_medica']; ?>">
            </div>

            <div class="form-group checkbox-group">
                <label>Está fazendo uso de alguma medicação contínua?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="SN_uso_medicacao" <?php if($row['SN_uso_medicacao'] == '0') echo 'checked'; ?>> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_uso_medicacao" <?php if($row['SN_uso_medicacao'] == '1') echo 'checked'; ?>> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="DS_uso_medicacao" name="DS_uso_medicacao"  value="<?php echo $row['DS_uso_medicacao']; ?>">
            </div>

            <div class="form-group checkbox-group">
                <label>Tem alergia a algum medicamento ou substância?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="SN_alergia_medicamento"<?php if($row['SN_alergia_medicamento'] == '0') echo 'checked'; ?>> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_alergia_medicamento" <?php if($row['SN_alergia_medicamento'] == '1') echo 'checked'; ?>> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" name="DS_alergia_medicamento" id="DS_alergia_medicamento" value="<?php echo $row['DS_alergia_medicamento']; ?>">
            </div>

            <div class="form-group checkbox-group">
                <label>Já teve episódios de tontura, desmaios ou problemas cardíacos ao praticar exercícios?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="SN_episodios_exercicios" <?php if($row['SN_episodios_exercicios'] == '0') echo 'checked'; ?>> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_episodios_exercicios" <?php if($row['SN_episodios_exercicios'] == '1') echo 'checked'; ?>> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="DS_episodios_exercicios" name="DS_episodios_exercicios" value="<?php echo $row['DS_episodios_exercicios']; ?>">
            </div>

            <div class="form-group checkbox-group">
                <label>Tem autorização médica para a prática de atividades físicas?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="SN_autorizacao_medica_fisica" value="nao" <?php if($row['SN_autorizacao_medica_fisica'] == '0') echo 'checked'; ?>> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_autorizacao_medica_fisica" <?php if($row['SN_autorizacao_medica_fisica'] == '1') echo 'checked'; ?>> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="DS_autorizacao_medica_fisica" name="DS_autorizacao_medica_fisica" value="<?php echo $row['DS_autorizacao_medica_fisica']; ?>">
            </div>
            <div class="button-group">
                <button class="btn-voltar" id="btnvoltar">Voltar</button>
                <button class="btn-cancelar" id="btnCancelar">Cancelar</button>
                <button class="btn-apagar" id="btnapagar">Apagar Cadastro</button>
            </div>
        </div>
    </div>
    </div>

    <script src="editar.js"></script>
</body>
</html>
