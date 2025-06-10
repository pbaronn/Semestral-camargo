<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Cadastro - Force Gym</title>
    <link rel="stylesheet" href="novo.css">
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <div class="user-info">
                Seja bem vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>
            </div>
            <nav class="main-nav">
                <a href="../menu/menu.php" class="nav-item"><img src="../menu/img/casa.png" alt="Início"> Início</a>
                <a href="../configuracoes/configuracoes.php" class="nav-item"><img src="../menu/img/eng.png" alt="Configurações"> Configurações</a>
                <a href="../login/logout.php" class="nav-item"><img src="../menu/img/sair.png" alt="Sair"> Sair</a>
            </nav>
        </div>
    </header>
    <div class="menu-container">
        <h1>Novo Cadastro</h1>
        <form action="processa_cadastro.php" method="post" class="form-novo">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required>
            </div>
            <div class="form-group">
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" name="sobrenome" id="sobrenome" required>
            </div>
            <div class="form-group">
                <label for="dt_nascimento">Data de Nascimento:</label>
                <input type="date" name="dt_nascimento" id="dt_nascimento" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" id="cpf" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" required>
            </div>
            <div class="form-group">
                <label for="telefone2">Telefone 2:</label>
                <input type="text" name="telefone2" id="telefone2">
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" id="endereco">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="obs">Objetivo:</label>
                <input type="text" name="obs" id="obs">
            </div>

            <!-- Doença preexistente -->
            <div class="form-group">
                <label>Possui alguma doença preexistente?</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="SN_saude_preexistente" value="Sim" id="saudeSim" required> Sim
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_saude_preexistente" value="Não" id="saudeNao"> Não
                    </label>
                </div>
                <div class="form-group" id="campoSaudeDetalhe" style="display:none; margin-top:10px;">
                    <label for="DS_saude_preexistente">Se sim, qual?</label>
                    <input type="text" name="DS_saude_preexistente" id="DS_saude_preexistente">
                </div>
            </div>

            <!-- Lesão/cirurgia -->
            <div class="form-group">
                <label>Já teve lesão ou fez cirurgia?</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="SN_lesao_cirurgia" value="Sim" id="lesaoSim" required> Sim
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_lesao_cirurgia" value="Não" id="lesaoNao"> Não
                    </label>
                </div>
                <div class="form-group" id="campoLesaoDetalhe" style="display:none; margin-top:10px;">
                    <label for="DS_lesao_cirurgia">Se sim, qual?</label>
                    <input type="text" name="DS_lesao_cirurgia" id="DS_lesao_cirurgia">
                </div>
            </div>

            <!-- Restrição médica -->
            <div class="form-group">
                <label>Possui restrição médica?</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="SN_restricao_medica" value="Sim" id="restricaoSim" required> Sim
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_restricao_medica" value="Não" id="restricaoNao"> Não
                    </label>
                </div>
                <div class="form-group" id="campoRestricaoDetalhe" style="display:none; margin-top:10px;">
                    <label for="DS_restricao_medica">Se sim, qual?</label>
                    <input type="text" name="DS_restricao_medica" id="DS_restricao_medica">
                </div>
            </div>

            <!-- Uso de medicação -->
            <div class="form-group">
                <label>Faz uso de medicação?</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="SN_uso_medicacao" value="Sim" id="medicacaoSim" required> Sim
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_uso_medicacao" value="Não" id="medicacaoNao"> Não
                    </label>
                </div>
                <div class="form-group" id="campoMedicacaoDetalhe" style="display:none; margin-top:10px;">
                    <label for="DS_uso_medicacao">Se sim, qual?</label>
                    <input type="text" name="DS_uso_medicacao" id="DS_uso_medicacao">
                </div>
            </div>

            <!-- Alergia a medicamento -->
            <div class="form-group">
                <label>Possui alergia a medicamento?</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="SN_alergia_medicamento" value="Sim" id="alergiaSim" required> Sim
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_alergia_medicamento" value="Não" id="alergiaNao"> Não
                    </label>
                </div>
                <div class="form-group" id="campoAlergiaDetalhe" style="display:none; margin-top:10px;">
                    <label for="DS_alergia_medicamento">Se sim, qual?</label>
                    <input type="text" name="DS_alergia_medicamento" id="DS_alergia_medicamento">
                </div>
            </div>

            <!-- Episódios ao praticar exercícios -->
            <div class="form-group">
                <label>Já teve episódios ao praticar exercícios?</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="SN_episodios_exercicios" value="Sim" id="episodiosSim" required> Sim
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_episodios_exercicios" value="Não" id="episodiosNao"> Não
                    </label>
                </div>
                <div class="form-group" id="campoEpisodiosDetalhe" style="display:none; margin-top:10px;">
                    <label for="DS_episodios_exercicios">Se sim, qual?</label>
                    <input type="text" name="DS_episodios_exercicios" id="DS_episodios_exercicios">
                </div>
            </div>

            <!-- Autorização médica -->
            <div class="form-group">
                <label>Possui autorização médica para atividade física?</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="SN_autorizacao_medica_fisica" value="Sim" id="autorizacaoSim" required> Sim
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_autorizacao_medica_fisica" value="Não" id="autorizacaoNao"> Não
                    </label>
                </div>
                <div class="form-group" id="campoAutorizacaoDetalhe" style="display:none; margin-top:10px;">
                    <label for="DS_autorizacao_medica_fisica">Se sim, qual?</label>
                    <input type="text" name="DS_autorizacao_medica_fisica" id="DS_autorizacao_medica_fisica">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-novo">Salvar</button>
                <a href="../menu/menu.php" class="btn-voltar">Voltar ao Menu</a>
            </div>
        </form>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const campos = [
            {sim: 'saudeSim', nao: 'saudeNao', campo: 'campoSaudeDetalhe'},
            {sim: 'lesaoSim', nao: 'lesaoNao', campo: 'campoLesaoDetalhe'},
            {sim: 'restricaoSim', nao: 'restricaoNao', campo: 'campoRestricaoDetalhe'},
            {sim: 'medicacaoSim', nao: 'medicacaoNao', campo: 'campoMedicacaoDetalhe'},
            {sim: 'alergiaSim', nao: 'alergiaNao', campo: 'campoAlergiaDetalhe'},
            {sim: 'episodiosSim', nao: 'episodiosNao', campo: 'campoEpisodiosDetalhe'},
            {sim: 'autorizacaoSim', nao: 'autorizacaoNao', campo: 'campoAutorizacaoDetalhe'}
        ];
        campos.forEach(function(obj) {
            const sim = document.getElementById(obj.sim);
            const nao = document.getElementById(obj.nao);
            const campo = document.getElementById(obj.campo);
            if(sim && nao && campo) {
                sim.addEventListener('change', function() {
                    campo.style.display = this.checked ? 'block' : 'none';
                });
                nao.addEventListener('change', function() {
                    campo.style.display = 'none';
                });
            }
        });
    });
    </script>
</body>
</html>