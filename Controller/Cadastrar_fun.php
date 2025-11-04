<?php
include_once(__DIR__ . "/../Model/FuncionarioDAO.php");


class CadastrarFun
{
    //Controller 

    public function __construct()
    {

        if (isset($_POST["enviar"])) {
            //formulário enviar foi enviado

            $c = new Cliente();
            $c->setNome($_POST["nome"]);
            $c->setCpf($_POST["cpf"]);
            $c->setEndereco($_POST["endereco"]);
            $c->setIdade($_POST["idade"]);
            $c->setCidade($_POST["cidade"]);
            $c->setTelefone($_POST["telefone"]);


            $dao = new FuncionarioDAO();
            $dao->cadastrar($c);

            $status = "Cadastro do funcionário " . $c->getNome() .
                " efetuado com sucesso";

            $lista = $dao->listar();

             include_once(__DIR__ . "/../view/Lista_funcionariophp");
        } else {

             include_once(__DIR__ . "/../view/AdminCadastrarFune.html");
        }
    }
}
