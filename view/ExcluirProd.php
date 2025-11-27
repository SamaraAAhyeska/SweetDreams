<?php
require_once __DIR__ . "/../Model/ConnectionFactory_class.php";
require_once __DIR__ . "/../Model/EstoqueDAO.php";
require_once __DIR__ . "/../Model/Estoque_class.php";

// Criar conexão + DAO
$dao = new EstoqueDAO();
$conn = $dao->con;

// Passo 1: validar ID
if (!isset($_GET['id_estoque']) || empty($_GET['id_estoque'])) {
    header("Location: ../Estoque.php?fun=listar&status=" . urlencode("ID inválido!"));
    exit;
}

$id = (int) $_GET['id_estoque'];

// Passo 2: buscar registro
$cont = $dao->buscarPorId($id);

if (!$cont) {
    header("Location: ../Estoque.php?fun=listar&status=" . urlencode("Registro de estoque não encontrado!"));
    exit;
}

// Passo 3: se confirmou exclusão → deletar
if (isset($_GET['conf']) && $_GET['conf'] === 'sim') {

    if ($dao->excluir($cont)) {
        $status = "Estoque excluído com sucesso!";
    } else {
        $status = "Erro ao excluir o registro!";
    }

    header("Location: ../Estoque.php?fun=listar&status=" . urlencode($status));
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Confirmar Exclusão</title>

    <style>
        .modal {
            display: block;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #d81b60;
            width: 80%;
            max-width: 400px;
            text-align: center;
            border-radius: 8px;
        }

        h1 {
            color: #880e4f;
            font-size: 20px;
        }

        p {
            color: #333;
        }

        button {
            background-color: #d81b60;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #c2185b;
        }

        .cancelar {
            background-color: #777;
        }

        .cancelar:hover {
            background-color: #555;
        }
    </style>
</head>

<body>

    <div class="modal">
        <div class="modal-content">

            <h1>Excluir registro de estoque?</h1>

            <p>
                Produto ID: <b><?= htmlspecialchars($cont->getId_produto()); ?></b><br>
                Quantidade: <b><?= htmlspecialchars($cont->getQuantidade()); ?></b><br><br>
                Tem certeza de que deseja excluir este registro? <br>
                <strong>Esta ação não pode ser desfeita.</strong>
            </p>

            <button onclick="confirmDelete()">Sim</button>
            <button class="cancelar" onclick="cancelar()">Não</button>

        </div>
    </div>

    <script>
        function cancelar() {
            window.location.href = "../Estoque.php?fun=listar";
        }

        function confirmDelete() {
            window.location.href =
                "ExcluirEstoque.php?id_estoque=<?= $cont->getId_estoque(); ?>&conf=sim";
        }
    </script>

</body>

</html>
