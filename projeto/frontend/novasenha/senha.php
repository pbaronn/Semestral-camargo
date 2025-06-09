<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Senha</title>
  <link rel="stylesheet" href="senha.css">
</head>
<body>
  <div class="novasenha-container">
    <h1>Recuperar Senha</h1>
    <div class="form-container">
      <p class="instruction">Ensira seu e-mail para recuperação de senha</p>
      <input type="email" placeholder="E-mail" class="form-input">
      <div class="button-group">
        <button class="btn-salvar" onclick="window.location.href='../login/login.php'">Enviar</button>
        <a href="#" class="btn-cancelar" onclick="window.location.href='../login/login.php'">Voltar</a>
      </div>
    </div>
  </div>
</body>


<script>
document.getElementById("senhaa").addEventListener("click", function (event) {
        event.preventDefault();
        window.location.href = "../novasenha/senha.php";
    });

</script>
</html>
