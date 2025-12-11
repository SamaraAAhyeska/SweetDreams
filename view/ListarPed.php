<?php
include_once("../Model/PedidoDAO.php");

$dao = new PedidoDAO();
$lista = $dao->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Pedidos</title>

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

    <h2>Listagem de Pedidos</h2>

    <a href="FinalizarPed.php">Cadastrar novo Pedido</a>
    <br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Produtos</th>
            <th>Confeiteira</th>
            <th>Veredito</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($lista as $p): ?>
            <tr>
                <td><?= $p->getIdPedido(); ?></td>
                <td><?= $p->getNomeCliente(); ?></td>

                <td>
                    <pre style="white-space: pre-wrap;">
<?= print_r(json_decode($p->getProdutos(), true), true); ?>
                    </pre>
                </td>

                <td><?= $p->getIdConfeiteira(); ?></td>
                <td><?= $p->getVeredito(); ?></td>
                <td><?= $p->getStatus(); ?></td>

                <td class="acoes">
                    <a href="AlterarPedido.php?id_pedido=<?= $p->getIdPedido(); ?>">Editar</a>
                    <a href="ExcluirPedido.php?id_pedido=<?= $p->getIdPedido(); ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>

</html>
