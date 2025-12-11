<?php
define('ROOT_PATH', __DIR__ . '/../');

include_once(ROOT_PATH . "Model/EstoqueDAO.php");

class AlterarEstoque
{
    public function __construct()
    {
        if (isset($_POST["enviar"])) {

            $e = new Estoque();

            // 🔥 CAPTURA O ID DO ESTOQUE (estava faltando!)
            $e->setId_estoque($_POST["id_estoque"]);

            $e->setId_prod($_POST["id_prod"]);
            $e->setQuantidade($_POST["quantidade"]);
           

            $dao = new EstoqueDAO();
            $dao->alterar($e);

            $status = "Alteração do registro de estoque do produto <strong>" .
                      $e->getId_prod() . "</strong> efetuada com sucesso.";

            $lista = $dao->listar();

            include_once("view/ListaEstoque.php");
        } 
        
        else {
            $id = $_GET["id_estoque"];
            $dao = new EstoqueDAO();
            $e = $dao->exibir($id);

            include("view/AlterarEstoque.php");
        }
    }
}
