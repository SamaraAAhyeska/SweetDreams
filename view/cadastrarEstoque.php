<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastro de Estoque</title>
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
      position: relative;
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

    /* Link no canto superior direito */
    .produtos-link {
      position: absolute;
      top: 15px;
      right: 15px;
      font-size: 14px;
      text-decoration: none;
      color: #d81b60;
      font-weight: bold;
      cursor: pointer;
    }

    .produtos-link:hover {
      text-decoration: underline;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #ad1457;
      font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"] {
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
  </style>
  <script>
    function abrirPopup() {
      window.open(
        'ConsultarProd.php', // página com a lista de produtos
        'PopupProdutos',
        'width=600,height=400,scrollbars=yes,resizable=yes'
      );
    }
  </script>
</head>
<body>
  <div class="cadastro-box">
    <!-- Link para abrir popup -->
    <span class="produtos-link" onclick="abrirPopup()">Pesquisar Produtos</span>

    <h2>Cadastro de Estoque</h2>

    <form action="../Estoque.php?fun=cadastrar" method="POST">

      <label for="produto">ID do Produto</label>
      <input type="number" id="produto" name="produto" placeholder="Informe o ID do produto" required />

      <label for="quantidade">Quantidade</label>
      <input type="number" id="quantidade" name="quantidade" placeholder="Quantidade em estoque" required />

      <button type="submit" name="enviar" class="cadastro-btn">Cadastrar</button>
    </form>
  </div>
</body>
</html>
