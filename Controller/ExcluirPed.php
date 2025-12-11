<?php

include_once(__DIR__ . "/../Model/PedidoDAO.php");

class ExcluirPed
{
    public function __construct()
    {
        // Verifica se o ID foi enviado
        if (!isset($_GET["id"])) {
            echo "<h3 style='color:red;'>Erro: Nenhum pedido foi selecionado para exclusão.</h3>";
            return; // encerra a execução
        }

        $id = $_GET["id"];
        $dao = new PedidoDAO();

        // Busca o pedido pelo ID
        $ped = $dao->exibir($id);

        // Se foi confirmado
        if (isset($_GET["conf"]) && $_GET["conf"] == "sim") {

            $dao->excluir($ped);

            $status = "O pedido <strong>ID #" . $ped->getId_pedido() . "</strong> foi excluído com sucesso.";

            $lista = $dao->listar();
            include_once(__DIR__ . "/../view/Lista_pedido.php");
        }
    }
}
?>
