


<?php

include_once(__DIR__ . "/../model/ClienteDAO.php");

class ExcluirCliente
{
    public function __construct()
    {
        // Verifica se o ID foi enviado
        if (!isset($_GET["id"])) {
            echo "<h3 style='color:red;'>Erro: Nenhum cliente foi selecionado para exclusão.</h3>";
            return; // encerra a execução da função
        }

        $id = $_GET["id"];
        $dao = new ClienteDAO();

        // Busca o cliente pelo ID
        $cont = $dao->exibir($id);

        // Se foi confirmado
        if (isset($_GET["conf"]) && $_GET["conf"] == "sim") {
            $dao->excluir($cont);
            $status = "O cliente <strong>" . $cont->getNome() . "</strong> foi excluído com sucesso.";

            $lista = $dao->listar();
            include_once("/../view/Lista_cliente.php");
        }
    }
}
?>



