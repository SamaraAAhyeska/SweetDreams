<?php
include_once(__DIR__ . '/../Model/PedidoDAO.php');

if (!isset($_GET['id'])) {
    die("ID inválido");
}

$id = $_GET['id'];

$dao = new PedidoDAO();
$dao->atualizarStatus($id, 'finalizado');

header("Location: ../view/ListaPedido.php");
exit;
