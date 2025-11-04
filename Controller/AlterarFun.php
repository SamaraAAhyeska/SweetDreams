<?php
define('ROOT_PATH', __DIR__ . '/../');

include_once(ROOT_PATH . "Model/FuncionarioDAO.php");

class AlteraFun
{
    public function __construct()
    {
        if (isset($_POST["enviar"])) {
            //formulário enviar foi enviado

            $c = new Cliente();
            $c->setId($_POST["id"]);
            $c->setNome($_POST["nome"]);
            $c->setCpf($_POST["cpf"]);
            $c->setEndereco($_POST["endereco"]);
            $c->setIdade($_POST["idade"]);
            $c->setCidade($_POST["cidade"]);
            $c->setTelefone($_POST["telefone"]);


            $dao = new FuncionarioDAO();
            $dao->alterar($c);

            $status = "Alteração do Funcionário " . $c->getNome() . " efetuada com sucesso";

            $lista = $dao->listar();

            include_once("view/Lista_funcionario.php");
        } else {
            $id = $_GET["id"];
            $dao = new FuncionarioDAO();
            $c = $dao->exibir($id);

            include("view/AdminAlterarFun.php");
        }
    }
}
