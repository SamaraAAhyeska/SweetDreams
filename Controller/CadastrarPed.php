<?php
include_once(__DIR__ . "/../Model/PedidoDAO.php");
include_once(__DIR__ . "/../Model/Pedido_class.php");

class CadastrarPed
{
    // Controller

    public function __construct()
    {
        if (isset($_POST["enviar"])) {

            // ============================================
            // FORMULÁRIO ENVIADO — CADASTRAR PEDIDO
            // ============================================

            $p = new Pedido();
            $p->setId_cliente($_POST["id_cliente"]);
            $p->setNome_cliente($_POST["nome_cliente"]);

            // produtos vem como array -> converter para JSON
            if (isset($_POST["produtos"]) && is_array($_POST["produtos"])) {
                $jsonProdutos = json_encode($_POST["produtos"], JSON_UNESCAPED_UNICODE);
                $p->setProdutos($jsonProdutos);
            }

            $p->setPrevisao_retirada($_POST["previsao_retirada"]);
            $p->setId_confeiteira($_POST["id_confeiteira"]);
            $p->setVeredito_confeiteira($_POST["veredito_confeiteira"]);
            $p->setStatus($_POST["status"]);
            $p->setValor($_POST["valor"]);

            // DAO
            $dao = new PedidoDAO();
            $dao->cadastrar($p);

            $status = "Pedido do cliente <strong>" .
                      $p->getNome_cliente() .
                      "</strong> cadastrado com sucesso!";

            $lista = $dao->listar();

            include_once(__DIR__ . "/../view/listaPedido.php");
        }

        // ============================================
        // PRIMEIRO ACESSO — MOSTRAR FORMULÁRIO
        // ============================================
        else {
            include_once(__DIR__ . "/../view/cadastrarPedido.php");
        }
    }
}
