<?php
ob_start();
session_start();

include_once("../Model/LoginDAO.php");
include_once("../Model/Login_class.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = trim($_POST["usuario"] ?? "");
    $senha   = trim($_POST["senha"] ?? "");

    if (empty($usuario) || empty($senha)) {
        $_SESSION['error'] = "Preencha todos os campos!";
        header("Location: ../view/Login.php");
        ob_end_flush();
        exit;
    }

    $dao = new LoginDAO();
    $dados = $dao->buscarUsuario($usuario);

    // 🔓 LOGIN SEM HASH — COMPARAÇÃO DIRETA
    if ($dados && $senha === $dados['senha']) {

        $_SESSION['usuario'] = $dados['usuario'];

        header("Location: ../view/cadastrarEstoque.php");
        ob_end_flush();
        exit;
    }

    $_SESSION['error'] = "Usuário ou senha inválidos!";
    header("Location: ../view/Login.php");
    ob_end_flush();
    exit;
}

ob_end_flush();
?>
