<?php
include_once("Model/FuncionarioDAO.php");

class ListarFun
{

    public function __construct()
    {
        $dao = new FuncionarioDAO();
        $lista = $dao->listar();
        //array de objetos do tipo contato

        include_once("view/Lista_funcionario.php");
    }
}
