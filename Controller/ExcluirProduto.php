<?php

include_once(__DIR__ . "/../Model/EstoqueDAO.php");

class ExcluirEstoque
{
    public function __construct()
    {
        // Verifica se o ID foi enviado
        if (!isset($_GET["id_estoque"])) {
            echo "<h3 style='color:red;'>Erro: Nenhum registro de estoque foi selecionado para exclusão.</h3>";
            return; // Encerra a execução
        }

        $id = $_GET["id_estoque"];
        $dao = new EstoqueDAO();

        // Busca o estoque pelo ID
        $estoque = $dao->buscarPorId($id);

        if (!$estoque) {
            echo "<h3 style='color:red;'>Erro: Registro de estoque não encontrado.</h3>";
            return;
        }

        // Se foi confirmado
        if (isset($_GET["conf"]) && $_GET["conf"] == "sim") {

            $dao->excluir($estoque);

            $status = "O registro de estoque (ID " . $estoque->getId_estoque() . ") foi excluído com sucesso.";

            // Carrega lista de estoque
            $lista = $dao->listar();
            include_once(__DIR__ . "/../view/listaEstoque.php");
        }
    }
}
?>
