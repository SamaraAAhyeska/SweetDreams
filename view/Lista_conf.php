<?php
include_once __DIR__ . "/../Model/ConfeiteiraDAO.php";
include_once __DIR__ . "/../Model/Confeiteira_class.php";

$confDAO = new ConfeiteiraDAO();
$lista = $confDAO->listar(); // ← sem isso o foreach quebra
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Confeiteira</title>
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

    <a href="../Confeiteira.php?fun=cadastrar">Cadastrar Nova(o) Confeiteira(o)</a>
    <br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Endereço</th>
            <th>Idade</th>
            <th>Cidade</th>
            <th>Telefone</th>
            <th>Encomenda</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($lista as $c): ?>
            <tr>
                <td><?= $c->getId(); ?></td> 
                <td><a href="../Confeiteira.php?fun=exibir&id=<?= $c->getId(); ?>"><?= $c->getNome(); ?></a></td>
                <td><?= $c->getCpf(); ?></td>
                <td><?= $c->getEndereco(); ?></td>
                <td><?= $c->getIdade(); ?></td>
                <td><?= $c->getCidade(); ?></td>
                <td><?= $c->getTelefone(); ?></td>
                <td><?= $c->getEncomenda(); ?></td>
                <td class="acoes">
                    <a href="AlterarConf.php?id=<?= $c->getId(); ?>">Editar</a>
                    <a href="ExcluirConf.php?id=<?= $c->getId(); ?>">Excluir</a>
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