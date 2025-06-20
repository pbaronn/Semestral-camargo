<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Cadastro</title>
    <link rel="stylesheet" href="visualizar.css">
</head>
<body>
    <header class="header">
            <div class="user-info">
                Seja bem vindo, @Camargo
            </div>
        </div>
        <nav class="main-nav">
            <a href="../menu/menu.php" class="nav-item" id="inicio"><img src="img/casa.png" alt="Início"> Início</a>
            <a href="../configuracoes/configuracoes.php" class="nav-item" id="config"><img src="img/eng.png" alt="Configurações"> Configurações</a>
            <a href="../login/logout.php" class="nav-item" id="sair"><img src="img/sair.png" alt="Sair"> Sair</a>
        </nav>
    </header>

    <div class="cadastro-container">
        <h1>Visualizar Cadastro</h1>
        
        <div class="cadastro-form">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" class="form-input">
            </div>

            <div class="form-group">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" id="sobrenome" class="form-input">
            </div>

            <div class="form-group">
                <label for="dataNascimento">Data de nascimento</label>
                <input type="text" id="dataNascimento" class="form-input">
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" class="form-input">
            </div>

            <div class="form-group">
                <label for="tel1">Tel.</label>
                <input type="text" id="tel1" class="form-input">
            </div>

            <div class="form-group">
                <label for="tel2">Tel. 2</label>
                <input type="text" id="tel2" class="form-input">
            </div>

            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" class="form-input">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-input">
            </div>

            <div class="form-group">
                <label for="observacoes">Observações</label>
                <textarea id="observacoes" class="form-input textarea"></textarea>
            </div>

            <div class="form-group checkbox-group">
                <label>Possui alguma condição de saúde pré-existente?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="saude" value="nao"> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="saude" value="sim"> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="saudeDesc">
            </div>

            <div class="form-group checkbox-group">
                <label>Já teve alguma lesão grave ou cirurgia?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="lesao" value="nao"> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="lesao" value="sim"> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="lesaoDesc">
            </div>

            <div class="form-group checkbox-group">
                <label>Possui alguma restrição médica para atividades físicas?</label>
                <div class="radio-options">
                    <label class="radio-label">
                        <input type="radio" name="restricao" value="nao"> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="restricao" value="sim"> Sim
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
                        <input type="radio" name="medicacaoContinua" value="nao"> Não
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="medicacaoContinua" value="sim"> Sim
                    </label>
                </div>
                <input type="text" class="form-input hidden" id="medicacaoContinuaDesc">
            </div>

            <div class="button-group">
                <button class="btn-voltar" id="btnvoltar">Voltar</button>
            </div>
        </div>
    </div>

    <script src="visualizar.js"></script>
</body>
</html>