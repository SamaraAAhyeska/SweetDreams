<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastro de funcionario</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #fce4ec, #f8bbd0);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .cadastro-box {
      background-color: #ffffff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      width: 350px;
    }

    .cadastro-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #d81b60;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #ad1457;
      font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 2px solid #f8bbd0;
      border-radius: 6px;
      font-size: 14px;
      outline: none;
    }

    .cadastro-btn {
      width: 100%;
      background-color: #ec407a;
      color: #fff;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .cadastro-btn:hover {
      background-color: #c2185b;
    }

    .login-link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .login-link a {
      color: #d81b60;
      text-decoration: none;
      font-weight: bold;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    .mensagem-sucesso {
      margin-top: 15px;
      text-align: center;
      color: green;
      font-weight: bold;
      display: none;
    }

    .mensagem-erro {
      margin-top: 10px;
      text-align: center;
      color: red;
      font-weight: bold;
      display: none;
    }
  </style>
</head>
<body>
  <div class="cadastro-box">
    <h2>Cadastro de funcionario</h2>
      <form action="Funcionario.php?fun=cadastrar" method="POST">
      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required />

      <label for="cpf">CPF</label>
      <input type="text" id="cpf" name="cpf" placeholder="Digite seu CPF" maxlength="14" required />

      <label for="endereco">Endereço</label>
      <input type="text" id="endereco" name="endereco" placeholder="Digite seu endereço" required />

      <label for="idade">Idade</label>
      <input type="number" id="idade" name="idade" placeholder="Digite sua idade" required min="0" />

      <label for="cidade">Cidade</label>
      <input type="text" id="cidade" name="cidade" placeholder="Digite sua cidade" required />
      
      <label for="telefone">Telefone</label>
      <input type="text" id="telefone" name="telefone" placeholder="Digite seu telefone" required />

      <!-- <label for="senha">Senha</label> -->
      <!-- <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required /> -->

      <!-- <label for="confirmarSenha">Confirmar Senha</label> -->
      <!-- <input type="password" id="confirmarSenha" name="confirmarSenha" placeholder="Repita sua senha" required /> -->

      <button type="submit" name="enviar" class="cadastro-btn">Cadastrar</button>
</form>

   <div class="login-link">
      <p>Já tem uma conta? <a href="login.html">Voltar ao login</a></p>
    </div>
  </div>
</body>
</html>

