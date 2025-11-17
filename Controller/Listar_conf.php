<?php
include_once(__DIR__ . "/../Model/ConfeiteiraDAO.php");
class Listarconf
{

    public function __construct()
    {
        $dao = new ConfeiteiraDAO();
        $lista = $dao->listar();
        //array de objetos do tipo contato

        include_once("view/Lista_conf.php");
    }
}
