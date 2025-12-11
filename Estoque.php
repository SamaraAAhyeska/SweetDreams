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
        $pag = new excluirEst();

    } elseif ($fun == "listar") {

        include_once("Controller/Listar_estoque.php");
        $pag = new ListarEst();

    } elseif ($fun == "exibir") {

        include_once("Controller/ExibirEstoque.php");
        $pag = new ExibirEst();

    } else {

        include_once("Controller/ListarEstoque.php");
        $pag = new ListarEst();
    }

} else {

    include_once("Controller/ListarEstoque.php");
    $pag = new ListarEst();
}

?>
