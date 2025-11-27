<?php
include_once("Model/EstoqueDAO.php");

class ListarFun
{

    public function __construct()
    {
        $dao = new EstoqueDAO();
        $lista = $dao->listar();
        //array de objetos do tipo contato

        include_once("view/Lista_funcionario.php");
    }
}
