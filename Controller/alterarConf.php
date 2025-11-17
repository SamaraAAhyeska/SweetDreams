<?php
define('ROOT_PATH', __DIR__ . '/../');

include_once(ROOT_PATH . "Model/ConfeiteiraDAO.php");

class AlterarConf
{
    public function __construct()
    {
        if (isset($_POST["enviar"])) {
            //formulário enviar foi enviado

            $c = new Confeiteira();
            $c->setId($_POST["id"]);
            $c->setNome($_POST["nome"]);
            $c->setCpf($_POST["cpf"]);
            $c->setEndereco($_POST["endereco"]);
            $c->setIdade($_POST["idade"]);
            $c->setCidade($_POST["cidade"]);
            $c->setTelefone($_POST["telefone"]);
            $c->setEncomenda($_POST["encomenda"]);


            $dao = new ConfeiteiraDAO();
            $dao->alterar($c);

            $status = "Alteração da confeiteira" . $c->getNome() . " efetuada com sucesso";

            $lista = $dao->listar();

            include_once("view/Lista_conf.php");
        } else {
            $id = $_GET["id"];
            $dao = new ConfeiteiraDAO();
            $c = $dao->exibir($id);

            include("view/AlterarConf.php");
        }
    }
}
