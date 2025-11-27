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

        a {
            color: #d81b60;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <h1>Estoque</h1>
    <a href="Estoque.php?fun=cadastrar">Cadastrar novo item</a>
    <br><br>

    <table>
        <tr>
            <th>ID Estoque</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Atualização</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($lista as $e): ?>
            <tr>
                <td><?= $e->getId_estoque(); ?></td>
                <td><?= $e->getId_produto(); ?></td>
                <td><?= $e->getQuantidade(); ?></td>
                <td><?= $e->getData_Atualizacao(); ?></td>

                <td>
                    <a href="view/AlterarEstoque.php?id=<?= $e->getId_estoque(); ?>">Editar</a> |
                    <a href="view/ExcluirEstoque.php?id=<?= $e->getId_estoque(); ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>
