<?php
include_once("Model/ClienteDAO.php");

class ListarCliente
{

    public function __construct()
    {
        $dao = new ClienteDAO();
        $lista = $dao->listar();
        //array de objetos do tipo contato

        include_once("view/Lista_cliente.php");
    }
}
