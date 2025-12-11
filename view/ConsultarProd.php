<?php
include_once __DIR__ . "/../Model/ProdutoDAO.php";

$produtoDAO = new ProdutoDAO();
$lista = $produtoDAO->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Produtos Cadastrados</title>

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
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #f8bbd0;
            text-align: left;
        }

        th {
            background-color: #f8bbd0;
            color: #880e4f;
        }

        tr:hover {
            background-color: #fde4ec;
        }

        button {
            background: #d81b60;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #ad1457;
        }
    </style>

</head>

<body>

<h1>Produtos Cadastrados</h1>



<table>
    <tr>
        <th>ID Produto</th>
        <th>Nome</th>
      
    </tr>

    <?php foreach ($lista as $p): ?>
        <tr>
            <td><?= $p->getId_prod(); ?></td>
            <td><?= $p->getNome(); ?></td>
            
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
