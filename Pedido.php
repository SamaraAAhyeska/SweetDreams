<?php
session_start();

if (isset($_GET["ped"])) {

    $ped = $_GET["ped"];

    if ($ped == "cadastrar") {

        include_once("Controller/CadastrarPed.php");
        $pag = new CadastrarPed();

    } elseif ($ped == "alterar") {

        include_once("Controller/AlterarPed.php");
        $pag = new AlterarPed();

    } elseif ($ped == "excluir") {

        include_once("Controller/ExcluirPed.php");
        $pag = new ExcluirPed();

    } elseif ($ped == "listar") {

        include_once("Controller/ListarPed.php");
        $pag = new ListarPed();

    } elseif ($ped == "exibir") {

        include_once("Controller/ExibirPed.php");
        $pag = new ExibirPed();

    } else {
        // Se parâmetro é desconhecido, listar
        include_once("Controller/ListarPed.php");
        $pag = new ListarPed();
    }

} else {
    // Se nada foi enviado, lista pedidos
    include_once("Controller/ListarPed.php");
    $pag = new ListarPed();
}
?>