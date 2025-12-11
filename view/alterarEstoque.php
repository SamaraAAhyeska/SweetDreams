<?php
// Inclui o DAO do Estoque
include_once(__DIR__ . "/../Model/EstoqueDAO.php");

$Estoque = null;

// Verifica se o ID foi passado
if (isset($_GET['id_estoque'])) {
  $id = $_GET['id_estoque'];
  $dao = new EstoqueDAO();
  $Estoque = $dao->buscarPorId($id); // Função que deve retornar o objeto Estoque
}

// Se não encontrou o estoque
if (!$Estoque) {
  echo "<h2>Registro de Estoque não encontrado!</h2>";
  echo '<p><a href="ListaEstoque.php">Voltar à lista de Estoque</a></p>';
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Estoque</title>
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

    .voltar-link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .voltar-link a {
      color: #d81b60;
      text-decoration: none;
      font-weight: bold;
    }

    .voltar-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="cadastro-box">
    <h2>Editar Estoque</h2>

    <form action="../Estoque.php?fun=alterar" method="POST">

      <!-- ID oculto -->
      <input type="hidden" name="id_estoque" value="<?php echo $Estoque->getId_estoque(); ?>">

      <label for="id_prod">ID do Produto</label>
      <input type="number" id="id_prod" name="id_prod"
        value="<?php echo $Estoque->getId_prod(); ?>" required />

      <label for="quantidade">Quantidade</label>
      <input type="number" id="quantidade" name="quantidade"
        value="<?php echo $Estoque->getQuantidade(); ?>" required />



      <button type="submit" name="enviar" class="cadastro-btn">Salvar Alterações</button>
    </form>

    <div class="voltar-link">
      <p><a href="ListaEstoque.php">Voltar à lista de Estoque</a></p>
    </div>
  </div>
</body>

</html>
