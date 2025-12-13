<?php
include_once __DIR__ . "/../Model/ProdutoDAO.php";
include_once __DIR__ . "/../Model/Produto_class.php";

$ProdutoDAO = new ProdutoDAO();
$lista = $ProdutoDAO->listar();

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Produtos</title>
    <style>
        body {
            font-family: Arial;
            background: linear-gradient(to right, #fce4ec, #f8bbd0);
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        th,
        td {
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

        a {
            text-decoration: none;
            color: #d81b60;
        }

        a:hover {
            text-decoration: underline;
        }

        .acoes a {
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <?php
    if (isset($status)) {
        echo "<h2>$status</h2>";
    }
    ?>

    <a href="../Produto.php?fun=cadastrar">Cadastrar novo Produto</a>
    <br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($lista as $p): ?>
            <tr>
                <td><?= $p->getId_prod(); ?></td>
                <td><a href="../Produto.php?fun=exibir&id_prod=<?= $p->getId_prod(); ?>"><?= $p->getNome(); ?></a></td>
                <td><?= $p->getDescricao(); ?></td>
                <td><?= $p->getPreco(); ?></td>

                <td class="acoes">
                    <a href="view/AlterarProd.php?id_prod=<?= $p->getId_prod(); ?>">Editar</a>
                    <a href="view/ExcluirProd.php?id_prod=<?= $p->getId_prod(); ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>

</html>

<?php
if (isset($_GET['status']) && !empty($_GET['status'])) {
    echo "<h2 style='color:green; font-family:Arial;'>" . htmlspecialchars($_GET['status']) . "</h2>";
}
?>