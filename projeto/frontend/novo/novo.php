
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Cadastro</title>
    <link rel="stylesheet" href="novo.css">
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <img src="img/logo.png" alt="Logo" class="logo">
            <div class="user-info">
                Seja bem vindo, @Camargo
            </div>
        </div>
        <nav class="main-nav">
            <a href="#" class="nav-item" id="inicio"><img src="img/casa.png" alt="Início"> Início</a>
            <a href="#" class="nav-item" id="config"><img src="img/eng.png" alt="Configurações"> Configurações</a>
            <a href="#" class="nav-item" id="sair"><img src="img/sair.png" alt="Sair"> Sair</a>
        </nav>
    </header>
    <div class="cadastro-container">
        <h1>Novo Cadastro</h1>
        
        <div class="cadastro-form">
        <form action="processa_cadastro.php" method="post" class="cadastro-form">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" class="form-input">
            </div>

            <div class="form-group">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" id="sobrenome" name="sobrenome" class="form-input">
            </div>

            <div class="form-group">
                <label for="dataNascimento">Data de nascimento</label>
                <input type="text" id="dt_nascimento" name="dt_nascimento" class="form-input">
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" class="form-input">
            </div>

            <div class="form-group">
                <label for="tel1">Tel.</label>
                <input type="text" id="telefone" name="telefone" class="form-input">
            </div>

            <div class="form-group">
                <label for="tel2">Tel. 2</label>
                <input type="text" id="telefone2" name="telefone2" class="form-input">
            </div>

            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" class="form-input">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-input">
            </div>

            <div class="form-group">
                <label for="observacoes">Observações</label>
                <textarea id="observacoes" name="observacoes" class="form-input textarea"></textarea>
            </div>

            <div class="form-group checkbox-group">
                <label>Possui alguma condição de saúde pré-existente?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="SN_saude_preexistente" value="nao"> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_saude_preexistente" value="sim"> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="DS_saude_preexistente">
            </div>

            <div class="form-group checkbox-group">
                <label>Já teve alguma lesão grave ou cirurgia?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="SN_lesao_cirurgia" value="nao"> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_lesao_cirurgia" value="sim"> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="DS_lesao_cirurgia">
            </div>

            <div class="form-group checkbox-group">
                <label>Possui alguma restrição médica para atividades físicas?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="SN_restricao_medica" value="nao"> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_restricao_medica" value="sim"> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="restricaoDesc">
            </div>

            <div class="form-group checkbox-group">
                <label>Está fazendo uso de alguma medicação contínua?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="medicacao" value="nao"> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="medicacao" value="sim"> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="medicacaoDesc">
            </div>

            <div class="form-group checkbox-group">
                <label>Tem alergia a algum medicamento ou substância?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="alergia" value="nao"> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="alergia" value="sim"> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="alergiaDesc">
            </div>

            <div class="form-group checkbox-group">
                <label>Já teve episódios de tontura, desmaios ou problemas cardíacos ao praticar exercícios?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="episodios" value="nao"> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="episodios" value="sim"> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="episodiosDesc">
            </div>

            <div class="form-group checkbox-group">
                <label>Tem autorização médica para a prática de atividades físicas?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="autorizacao" value="nao"> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="autorizacao" value="sim"> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="autorizacaoDesc">
            </div>

            <div class="form-group checkbox-group">
                <label>Está fazendo uso de alguma medicação contínua?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="SN_uso_medicacao" value="nao"> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="SN_uso_medicacao" value="sim"> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="DS_uso_medicacao">
            </div>
            <div class="button-group">
                <button class="btn-salvar" id="btnSalvar">Salvar</button>
                <button class="btn-cancelar" id="btnCancelar">Cancelar</button>
            </div>
        </form>
        </div>
    </div>

    <script src="novo.js"></script>
</body>
</html>