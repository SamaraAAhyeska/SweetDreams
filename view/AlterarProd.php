<?php
// Inclui o Controller que busca os dados do Produto
include_once(__DIR__ . "/../Model/ProdutoDAO.php");

$Produto = null;

// Verifica se o ID do Produto foi passado via GET
if (isset($_GET['id_prod'])) {
  $id = $_GET['id_prod'];
  $dao = new ProdutoDAO();
  $Produto = $dao->buscarPorId($id); // Função que retorna o objeto Produto
}

// Se não encontrou o Produto, exibe mensagem e sai
if (!$Produto) {
  echo "<h2>Produto não encontrado!</h2>";
  echo '<p><a href="listaProd.php">Voltar à lista de Produtos</a></p>';
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Produto</title>
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
    input[type="number"] {
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
    <h2>Editar Produto</h2>


    <!-- O formulário já vem preenchido com dados via PHP -->
    <form action="../Produto.php?fun=alterar" method="POST">
      <!-- Campo oculto para enviar o ID do Produto -->
      <input type="hidden" name="id_prod" value="<?php echo $Produto->getId_prod(); ?>">


      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" value="<?php echo $Produto->getNome(); ?>" required />

      <label for=" descricao">Descricao</label>
      <input type="text" id="descricao" name="descricao" value="<?php echo $Produto->getDescricao(); ?>" maxlength="14" required />

      <label for="Preco">Preco</label>
      <input type="number" id="preco" name="preco" placeholder="Digite o valor do produto" step="0.01" required />


      <button type="submit" name="enviar" class="cadastro-btn">Salvar Alterações</button>
    </form>

    <div class="voltar-link">
      <p><a href="view/ListaProd.php">Voltar à lista de Produtos</a></p>
    </div>
  </div>
</body>

</html>