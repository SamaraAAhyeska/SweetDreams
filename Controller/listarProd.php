<?php
include_once("Model/ProdutoDAO.php");

class ListarProd
{

    public function __construct()
    {
        $dao = new ProdutoDAO();
        $lista = $dao->listar();
        //array de objetos do tipo contato

        include_once("view/ListaProd.php");
    }
}
