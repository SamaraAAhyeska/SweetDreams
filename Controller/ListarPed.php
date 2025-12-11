<?php
include_once("Model/PedidoDAO.php");

class ListarPed
{

    public function __construct()
    {
        $dao = new PedidoDAO();
        $lista = $dao->listar();
        //array de objetos do tipo contato

        include_once("view/ListarPed.php");
    }
}
