<?php
include_once(__DIR__ . "/../Model/EstoqueDAO.php");
include_once(__DIR__ . "/../Model/Estoque_class.php");

class CadastrarEstoque
{
    // Controller

    public function __construct()
    {
        if (isset($_POST["enviar"])) {
            // formulário enviado

            $e = new Estoque();
            $e->setId_prod($_POST["produto"]);
            $e->setQuantidade($_POST["quantidade"]);
         

            $dao = new EstoqueDAO();
            $dao->cadastrar($e);

            $status = "Entrada de estoque do produto <strong>" . 
                      $e->getid_Prod() . "</strong> registrada com sucesso!";

            $lista = $dao->listar();

            include_once(__DIR__ . "/../view/listaEstoque.php");
        } 
        
        else {
            include_once(__DIR__ . "/../view/cadastrarEstoque.php");
        }
    }
}
