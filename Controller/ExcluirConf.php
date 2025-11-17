


<?php

include_once(__DIR__ . "/../Model/ConfeiteiraDAO.php");

class ExcluirConf
{
    public function __construct()
    {
        // Verifica se o ID foi enviado
        if (!isset($_GET["id"])) {
            echo "<h3 style='color:red;'>Erro: Nenhuma confeiteira foi selecionada para exclusão.</h3>";
            return; // encerra a execução da função
        }

        $id = $_GET["id"];
        $dao = new ConfeiteiraDAO();

        // Busca o cliente pelo ID
        $cont = $dao->exibir($id);

        // Se foi confirmado
        if (isset($_GET["conf"]) && $_GET["conf"] == "sim") {
            $dao->excluir($cont);
            $status = "A confeiteira <strong>" . $cont->getNome() . "</strong> foi excluída com sucesso.";

            $lista = $dao->listar();
            include_once("/../view/Lista_conf.php");
        }
    }
}
?>



