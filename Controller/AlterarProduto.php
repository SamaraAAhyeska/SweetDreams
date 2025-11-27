
<?php
define('ROOT_PATH', __DIR__ . '/../');

include_once(ROOT_PATH . "Model/ProdutoDAO.php");

class AlterarProd
{
    public function __construct()
    {
        if (isset($_POST["enviar"])) {
            //formulário enviar foi enviado

            $c = new Produto();
            $c->setId_prod($_POST["id_prod"]);
            $c->setNome($_POST["nome"]);
            $c->setDescricao($_POST["descricao"]);
            $c->setPreco($_POST["preco"]);



            $dao = new ProdutoDAO();
            $dao->alterar($c);

            $status = "Alteração do Produto " . $c->getNome() . " efetuada com sucesso";

            $lista = $dao->listar();

            include_once("view/ListaProd.php");
        } else {
            $id = $_GET["id_prod"];
            $dao = new ProdutoDAO();
            $c = $dao->exibir($id);

            include("view/AlterarProd.php");
        }
    }
}
