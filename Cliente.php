<?php

include_once(__DIR__ . "../Model/ClienteDAO.php");
include_once(__DIR__ . "../Model/Cliente_class.php");
session_start();

if (isset($_GET["fun"])) {

    $fun = $_GET["fun"];

    if ($fun == "cadastrar") {

        include_once("Controller/Cadastrar_cliente.php");  
        $pag = new CadastrarCliente();

    } elseif ($fun == "alterar") {
        include_once("Controller/alterarCliente.php");
        $pag = new AlterarCliente();
        
    } elseif ($fun == "excluir") {

        include_once("Controller/ExcluirCliente.php"); //op == sim
        $pag = new ExcluirCliente();
    } elseif ($fun == "listar") {
        include_once("Controller/Listar_cliente.php");
        $pag = new ListarCliente();
    } elseif ($fun == "exibir") {
        include_once("Controller/ExibirCliente.php");
        $pag = new ExibirCliente();
    } else {
        include_once("Controller/Listar_cliente.php");
        $pag = new ListarCliente();
    }
} else {
    include_once("Controller/Listar_cliente.php");
    $pag = new ListarCliente();
}

?>