<?php
session_start();
//include_once("visao/topo.php");
if (isset($_GET["fun"])) {

    $fun = $_GET["fun"];

    if ($fun == "cadastrar") {

        include_once("Controller/CadastrarConf.php");
        $pag = new CadastrarConf();
    } elseif ($fun == "alterar") {
        include_once("Controller/AlterarConf.php");
        $pag = new AlterarConf();
    } elseif ($fun == "excluir") {

        include_once("Controller/Excluirconf.php"); //op == sim
        $pag = new ExcluirConf();
        
    } elseif ($fun == "listar") {
        include_once("Controller/Listar_conf.php");
        $pag = new ListarConf();

    } elseif ($fun == "exibir") {
        include_once("Controller/Exibirconf.php");
        $pag = new Exibirconf();
    } else {
        include_once("Controller/Listar_conf.php");
        $pag = new ListarConf();
    }
} else {
    include_once("Controller/Listar_conf.php");
    $pag = new Listarconf();
}

//include_once("visao/base.php");
