<?php
require_once __DIR__ . "/../Model/ConnectionFactory_class.php";
require_once __DIR__ . "/../Model/PedidoDAO.php";
require_once __DIR__ . "/../Model/Pedido_class.php";

// Instancia o DAO
$dao = new PedidoDAO();

// -------------------------------------------
// PASSO 1: Validar ID recebido
// -------------------------------------------
if (!isset($_GET['id_pedido']) || empty($_GET['id_pedido'])) {
    header("Location: ../Pedido.php?fun=listar&status=" . urlencode("ID de pedido inválido!"));
    exit;
}

$id = (int) $_GET['id_pedido'];

// -------------------------------------------
// PASSO 2: Buscar pedido
// -------------------------------------------
$pedido = $dao->buscarPorId($id);

if (!$pedido) {
    header("Location: ../Pedido.php?fun=listar&status=" . urlencode("Pedido não encontrado!"));
    exit;
}

// -------------------------------------------
// PASSO 3: Se confirmou exclusão → excluir
// -------------------------------------------
if (isset($_GET['conf']) && $_GET['conf'] === 'sim') {

    if ($dao->excluir($id)) {
        $status = "Pedido excluído com sucesso!";
    } else {
        $status = "Erro ao excluir o pedido!";
    }

    header("Location: ../Pedido.php?fun=listar&status=" . urlencode($status));
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Confirmar Exclusão</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .modal {
            display: block;
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #ffffff;
            margin: 12% auto;
            padding: 25px;
            border: 2px solid #d81b60;
            width: 90%;
            max-width: 420px;
            text-align: center;
            border-radius: 10px;
        }

        h1 {
            color: #d81b60;
            font-size: 22px;
        }

        p {
            font-size: 16px;
        }

        button {
            background-color: #d81b60;
            color: #fff;
            padding: 12px 20px;
            border: none;
            margin: 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
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

            <h1>Confirmar Exclusão</h1>

            <p>
                <strong>ID do Pedido:</strong> <?= htmlspecialchars($pedido["id_pedido"]); ?><br>
                <strong>Cliente:</strong> <?= htmlspecialchars($pedido["nome_cliente"]); ?><br><br>

                Tem certeza que deseja excluir este pedido?<br>
                <strong>Essa ação é irreversível.</strong>
            </p>

            <button onclick="confirmDelete()">Sim, excluir</button>
            <button class="cancelar" onclick="cancelar()">Cancelar</button>

        </div>
    </div>

    <script>
        function cancelar() {
            window.location.href = "../Pedido.php?fun=listar";
        }

        function confirmDelete() {
            window.location.href =
                "ExcluirPedido.php?id_pedido=<?= $pedido['id_pedido']; ?>&conf=sim";
        }
    </script>

</body>

</html>
