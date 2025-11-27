<?php
session_start();
//include_once("visao/topo.php");
if (isset($_GET["fun"])) {

    $fun = $_GET["fun"];

    if ($fun == "cadastrar") {

        include_once("Controller/CadastrarProduto.php");  
        $pag = new CadastrarProd();

    } elseif ($fun == "alterar") {
        include_once("Controller/AlterarProduto.php");
        $pag = new AlterarProd();
        
    } elseif ($fun == "excluir") {

        include_once("Controller/ExcluirProduto.php"); //op == sim
        $pag = new ExcluirProd();
    } elseif ($fun == "listar") {
        include_once("Controller/listarProd.php");
        $pag = new ListarProd();
    } elseif ($fun == "exibir") {
        include_once("Controller/ExibirProd.php");
        $pag = new ExibirProd();
    } else {
        include_once("Controller/listarProd.php");
        $pag = new ListarProd();
    }
} else {
    include_once("Controller/listarProd.php");
    $pag = new ListarProd();
}

//include_once("visao/base.php");
