<?php

include_once(__DIR__ . "/../Model/EstoqueDAO.php");

class excluirEst
{
    public function __construct()
    {
        // Verifica se o ID foi enviado
        if (!isset($_GET["id"])) {
            echo "<h3 style='color:red;'>Erro: Nenhum estoque foi selecionado para exclusão.</h3>";
            return;
        }

        $id = $_GET["id"];
        $dao = new EstoqueDAO();

        // Busca o estoque pelo ID
        $cont = $dao->exibir($id);

        if (!$cont) {
            echo "<h3 style='color:red;'>Erro: Estoque não encontrado.</h3>";
            return;
        }

        // Se foi confirmado "sim"
        if (isset($_GET["conf"]) && $_GET["conf"] == "sim") {

            $dao->excluir($cont);

            $status = "O registro de estoque do produto <strong>" 
                        . $cont->getId_prod() . 
                      "</strong> foi excluído com sucesso.";

            // Lista novamente
            $lista = $dao->listar();

            include_once(__DIR__ . "/../view/listaEstoque.php");
        }
    }
}
?>
