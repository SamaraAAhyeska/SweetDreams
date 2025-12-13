<?php
include_once __DIR__ . "/../Model/ProdutoDAO.php";
include_once __DIR__ . "/../Model/Produto_class.php";

class ListarProd
{
    public function __construct()
    {
        $ProdutoDAO = new ProdutoDAO();
        $lista = $ProdutoDAO->listar();

        // envia lista para a view
        include_once __DIR__ . "/../view/ListaProd.php";
    }
}

new ListarProd();
