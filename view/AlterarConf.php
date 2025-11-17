<?php
// Inclui o Controller que busca os dados do Confeiteira
include_once(__DIR__ . "/../Model/ConfeiteiraDAO.php");

$Confeiteira = null;

// Verifica se o ID do Confeiteira foi passado via GET
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $dao = new ConfeiteiraDAO();
  $Confeiteira = $dao->buscarPorId($id); // Função que retorna o objeto Confeiteira
}

// Se não encontrou o Confeiteira, exibe mensagem e sai
if (!$Confeiteira) {
  echo "<h2>Confeiteira não encontrado!</h2>";
  echo '<p><a href="Lista_Conf.php">Voltar à lista de Confeiteiras</a></p>';
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Confeiteira</title>
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
    <h2>Editar Confeiteira</h2>
    

    <!-- O formulário já vem preenchido com dados via PHP -->
    <form action="../Confeiteira.php?fun=alterar" method="POST">
      <!-- Campo oculto para enviar o ID do Confeiteira -->
      <input type="hidden" name="id" value="<?php echo $Confeiteira->getId(); ?>">


      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" value="<?php echo $Confeiteira->getNome(); ?>" required />

      <label for=" cpf">CPF</label>
      <input type="text" id="cpf" name="cpf" value="<?php echo $Confeiteira->getCpf(); ?>" maxlength="14" required />

      <label for="endereco">Endereço</label>
      <input type="text" id="endereco" name="endereco" value="<?php echo $Confeiteira->getEndereco(); ?>" required />

      <label for="idade">Idade</label>
      <input type="number" id="idade" name="idade" value="<?php echo $Confeiteira->getIdade(); ?>" required min="0" />

      <label for="cidade">Cidade</label>
      <input type="text" id="cidade" name="cidade" value="<?php echo $Confeiteira->getCidade(); ?>" required />

      <label for="telefone">Telefone</label>
      <input type="text" id="telefone" name="telefone" value="<?php echo $Confeiteira->getTelefone(); ?>" required />

      <label for="encomenda">Encomenda</label>
      <input type="text" id="encomenda" name="encomenda" value="<?php echo $Confeiteira->getEncomenda(); ?>" required />

      <button type="submit" name="enviar" class="cadastro-btn">Salvar Alterações</button>
    </form>

    <div class="voltar-link">
      <p><a href="view/Lista_Confeiteira.php">Voltar à lista de Confeiteiras</a></p>
    </div>
  </div>
</body>

</html>