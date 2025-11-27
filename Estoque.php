<?php
session_start();

if (isset($_GET["fun"])) {

    $fun = $_GET["fun"];

    if ($fun == "cadastrar") {

        include_once("Controller/CadastrarEstoque.php");  
        $pag = new CadastrarEstoque();

    } elseif ($fun == "alterar") {

        include_once("Controller/AlterarEstoque.php");
        $pag = new AlterarEstoque();

    } elseif ($fun == "excluir") {

        include_once("Controller/ExcluirEstoque.php");
        $pag = new ExcluirEstoque();

    } elseif ($fun == "listar") {

        include_once("Controller/ListarEstoque.php");
        $pag = new ListarEstoque();

    } elseif ($fun == "exibir") {

        include_once("Controller/ExibirEstoque.php");
        $pag = new ExibirEstoque();

    } else {

        include_once("Controller/ListarEstoque.php");
        $pag = new ListarEstoque();
    }

} else {

    include_once("Controller/ListarEstoque.php");
    $pag = new ListarEstoque();
}

?>
