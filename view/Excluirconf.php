<?php
require_once __DIR__ . "/../Model/ConnectionFactory_class.php";

// Criar a conexão PDO
$connFactory = new ConnectionFactory();
$conn = $connFactory->getConnection();

// Passo 1: receber o ID
if (!isset($_GET['id'])) {
    header("Location: Confeiteira.php?fun=listar&status=" . urlencode("ID inválido!"));
    exit;
}

$id = (int)$_GET['id'];

// Passo 2: buscar dados do confeiteira
$sql = "SELECT * FROM confeiteira WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$cont = $stmt->fetch(PDO::FETCH_OBJ);

if (!$cont) {
    header("Location: Confeiteira.php?fun=listar&status=" . urlencode("confeiteira não encontrado!"));
    exit;
}

// Passo 3: se confirmou exclusão, deletar
if (isset($_GET['conf']) && $_GET['conf'] === 'sim') {
    $del = "DELETE FROM confeiteira WHERE id = :id";
    $stmtDel = $conn->prepare($del);
    $stmtDel->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmtDel->execute()) {
        $status = "confeiteira excluído com sucesso!";
    } else {
        $status = "Erro ao excluir confeiteira!";
    }

    // Fecha a conexão
    $conn = null;

    // ✅ Redireciona corretamente para a listagem com mensagem
    header("Location: ../Confeiteira.php?fun=listar&status=" . urlencode($status));
    exit;
}



?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Autorização de Exclusão</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
    </style>
</head>

<body>

    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h1>Confirmar exclusão de <?= htmlspecialchars($cont->nome); ?></h1>
            <p>Tem certeza de que deseja excluir este funcionário? Esta ação não pode ser desfeita.</p>
            <button onclick="confirmDelete()">Sim</button>
            <button onclick="closeModal()">Não</button>
        </div>
    </div>

    <script>
        // Abre a modal ao carregar a página
        window.onload = function() {
            document.getElementById('confirmModal').style.display = 'block';
        };

        // Fechar modal e voltar para listagem
        function closeModal() {
            document.getElementById('confirmModal').style.display = 'none';
            window.location.href = '../Confeiteira.php?fun=listar';
        }

        // Confirmar exclusão
        function confirmDelete() {
            window.location.href = 'Excluirconf.php?id=<?= $cont->id ?>&conf=sim';
        }
    </script>

</body>

</html>