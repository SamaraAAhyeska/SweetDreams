<?php
session_start();

if (isset($_GET["fun"])) {

    $fun = $_GET["fun"];

    if ($fun == "cadastrar") {

        include_once("Controller/Cadastrar_fun.php");  
        $pag = new Cadastrarfun();

    } elseif ($fun == "alterar") {
        include_once("Controller/AlterarFun.php");
        $pag = new AlterarFun();
        
    } elseif ($fun == "excluir") {

        include_once("Controller/Excluirfun.php"); //op == sim
        $pag = new Excluirfun();
    } elseif ($fun == "listar") {
        include_once("Controller/Listar_fun.php");
        $pag = new Listarfun();
    } elseif ($fun == "exibir") {
        include_once("Controller/ExibirFun.php");
        $pag = new ExibirFun();
    } else {
        include_once("Controller/Listar_fun.php");
        $pag = new Listarfun();
    }
} else {
    include_once("Controller/Listar_fun.php");
    $pag = new Listarfun();
}

?>