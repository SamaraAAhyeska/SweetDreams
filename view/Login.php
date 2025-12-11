
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
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

    .login-box {
      background-color: #ffffff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      width: 350px;
    }

    .login-box h2 {
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
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 2px solid #f8bbd0;
      border-radius: 6px;
      font-size: 14px;
      outline: none;
    }

    .login-btn {
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

    .login-btn:hover {
      background-color: #c2185b;
    }

    .extras {
      text-align: center;
      margin-top: 15px;
    }

    .extras a {
      color: #ad1457;
      font-size: 14px;
      text-decoration: none;
    }

    .extras a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Entrar</h2>

<form action="../Controller/LoginC.php" method="POST">

      <label for="usuario">Usuário</label>
      <input type="text" id="usuario" name="usuario" placeholder="Seu usuário" required>

      <label for="password">Senha</label>
      <input type="password" id="password" name="senha" placeholder="••••••••" required>
     


      <button type="submit" class="login-btn">Entrar</button>

      <div class="extras">
        <a href="#">Esqueceu a senha?</a>
      </div>

    </form>
  </div>
</body>
</html>
