<?php
include_once __DIR__ . "/../Model/EstoqueDAO.php";
include_once __DIR__ . "/../Model/Estoque_class.php";
include_once __DIR__ . "/../Model/ProdutoDAO.php";
include_once __DIR__ . "/../Model/Produto_class.php";


$EstoqueDAO = new EstoqueDAO();
$lista = $EstoqueDAO->listar();
$produtoDAO = new ProdutoDAO();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Estoque</title>
    <style>
        body {
            font-family: Arial;
            background: linear-gradient(to right, #fce4ec, #f8bbd0);
            padding: 20px;
        }

        h1 {
            color: #880e4f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        th, td {
            padding: 10px;
            border: 1px solid #f8bbd0;
        }

        th {
            background-color: #f8bbd0;
            color: #880e4f;
        }

        tr:hover {
            background-color: #fde4ec;
        }

        a, button {
            color: #d81b60;
            text-decoration: none;
            font-size: 15px;
            cursor: pointer;
            background: none;
            border: none;
        }

        a:hover, button:hover {
            text-decoration: underline;
        }

        .btn-popup {
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<h1>Estoque</h1>

<!-- LINHA SUPERIOR COM OS DOIS LINKS -->
<div style="display: flex; justify-content: space-between; width: 100%;">
    
    <!-- Cadastrar -->
    <a href="Estoque.php?fun=cadastrar" class="btn-popup">Cadastrar novo item</a>

    <!-- Consultar Produtos (acima de Ações) -->
    <a class="btn-popup"
       href="#"
       onclick="window.open('ConsultarProd.php',
       'popup',
       'width=900,height=600,scrollbars=yes');">
        Consultar Produtos
    </a>

</div>

<br><br>

<table>
    <tr>
        <th>Produto</th>
        <th>ID Produto</th>
        <th>Quantidade</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($lista as $e): ?>
        <tr>

            <td><?= $produtoDAO->buscarNomePorId($e->getId_prod()); ?></td>

            <td><?= $e->getId_prod(); ?></td>

            <td><?= $e->getQuantidade(); ?></td>

            <td>
                <a href="AlterarEstoque.php?id_estoque=<?= $e->getId_estoque(); ?>">Editar</a> |
                <a href="ExcluirEstoque.php?id_estoque=<?= $e->getId_estoque(); ?>">Excluir</a>
            </td>

        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
