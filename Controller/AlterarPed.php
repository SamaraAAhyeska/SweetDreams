<?php
define('ROOT_PATH', __DIR__ . '/../');

include_once(ROOT_PATH . "Model/PedidoDAO.php");
include_once(ROOT_PATH . "Model/Pedido_class.php");

class AlterarPed
{
    public function __construct()
    {
        if (isset($_POST["enviar"])) {
            // Formulário enviado

            $p = new Pedido();
            $p->setId_pedido($_POST["id_pedido"]);
            $p->setId_cliente($_POST["id_cliente"]);
            $p->setNome_cliente($_POST["nome_cliente"]);

            // Produtos chegam como JSON → salvar como JSON
            if (isset($_POST["produtos"]) && is_string($_POST["produtos"])) {
                $p->setProdutos($_POST["produtos"]);
            }

            $p->setPrevisao_retirada($_POST["previsao_retirada"]);
            $p->setId_confeiteira($_POST["id_confeiteira"]);
            $p->setVeredito_confeiteira($_POST["veredito_confeiteira"]);
            $p->setStatus($_POST["status"]);
            $p->setValor($_POST["valor"]);

            $dao = new PedidoDAO();
            $dao->alterar($p);

            $status = "Pedido #" . $p->getId_pedido() . " alterado com sucesso!";

            $lista = $dao->listar();

            include_once("view/Lista_pedido.php");
        } 
        else {
            // Carregar dados para edição
            $id = $_GET["id"];
            $dao = new PedidoDAO();
            $p = $dao->exibir($id);

            include("view/AdminAlterarPed.php");
        }
    }
}
