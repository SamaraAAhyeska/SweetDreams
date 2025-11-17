<?php
include_once(__DIR__ . "/../Model/ConfeiteiraDAO.php");


class CadastrarConf
{
    //Controller 

    public function __construct()
    {

        if (isset($_POST["enviar"])) {
            //formulário enviar foi enviado

            $c = new Confeiteira();
            $c->setNome($_POST["nome"]);
            $c->setCpf($_POST["cpf"]);
            $c->setEndereco($_POST["endereco"]);
            $c->setIdade($_POST["idade"]);
            $c->setCidade($_POST["cidade"]);
            $c->setTelefone($_POST["telefone"]);
            $c->setEncomenda($_POST["encomenda"]);


            $dao = new ConfeiteiraDAO();
            $dao->cadastrar($c);

            $status = "Cadastro de confeiteira(o) " . $c->getNome() .
                " efetuado com sucesso";

            $lista = $dao->listar();

            include_once(__DIR__ . "/../view/Lista_conf.php");
        } else {

            include_once(__DIR__ . "/../view/cadastrarConf.php");
        }
    }
}
