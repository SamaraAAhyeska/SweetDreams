<?php

include_once(__DIR__ . "/../Model/ProdutoDAO.php");

class ExcluirProd
{
    public function __construct()
    {
        // Verifica se o ID foi enviado
        if (!isset($_GET["id_prod"])) {
            echo "<h3 style='color:red;'>Erro: Nenhum registro de Produto foi selecionado para exclusão.</h3>";
            return; // Encerra a execução
        }

        $id = $_GET["id_prod"];
        $dao = new ProdutoDAO();

        // Busca o Produto pelo ID
        $Produto = $dao->buscarPorId($id);

        if (!$Produto) {
            echo "<h3 style='color:red;'>Erro: Registro de Produto não encontrado.</h3>";
            return;
        }

        // Se foi confirmado
        if (isset($_GET["conf"]) && $_GET["conf"] == "sim") {

            $dao->excluir($Produto);

            $status = "O registro de Produto (ID " . $Produto->getId_prod() . ") foi excluído com sucesso.";

            // Carrega lista de Produto
            $lista = $dao->listar();
            include_once(__DIR__ . "/../view/ListaProd.php");
        }
    }
}
?>
