<?php
include_once(__DIR__ . "/../Model/ProdutoDAO.php");

class CadastrarProd  //corrigir
{
    //Controller 

    public function __construct()
    {

        if (isset($_POST["enviar"])) {
            // Formulário enviado

            $p = new Produto(); ///corrigir
            $p->setNome($_POST["nome"]);
            $p->setDescricao($_POST["descricao"]);
            $p->setPreco($_POST["preco"]);

            $dao = new ProdutoDAO();
            $dao->cadastrar($p);

            $status = "Cadastro do produto '" . $p->getNome() . "' efetuado com sucesso";

            $lista = $dao->listar();

            include_once(__DIR__ . "/../view/ListaProd.php");
        } else {

            include_once(__DIR__ . "/../view/CadastrarProd.php");
        }
    }
}
