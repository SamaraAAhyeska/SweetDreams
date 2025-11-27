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
            $e->setProduto($_POST["produto"]);
            $e->setQuantidade($_POST["quantidade"]);
            $e->setDataEntrada($_POST["data_entrada"]);
            $e->setResponsavel($_POST["responsavel"]);

            $dao = new EstoqueDAO();
            $dao->cadastrar($e);

            $status = "Entrada de estoque do produto <strong>" . 
                      $e->getProduto() . "</strong> registrada com sucesso!";

            $lista = $dao->listar();

            include_once(__DIR__ . "/../view/Lista_estoque.php");
        } 
        
        else {
            include_once(__DIR__ . "/../view/cadastrarEstoque.php");
        }
    }
}
