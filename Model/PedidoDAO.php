<?php
include_once("ConnectionFactory_class.php"); // PDO
include_once("Pedido_class.php");             // entidade Pedido

class PedidoDAO
{
    public $con = null;

    public function __construct()
    {
        $conF = new ConnectionFactory();
        $this->con = $conF->getConnection();
    }

    // ============================================================
    // CADASTRAR
    // ============================================================
    public function cadastrar($p)
    {
        try {
            $stmt = $this->con->prepare(
                "INSERT INTO pedido (
                    id_cliente, nome_cliente, produtos, previsao_retirada,
                    id_confeiteira, veredito_confeiteira, status, valor
                ) VALUES (
                    :id_cliente, :nome_cliente, :produtos, :previsao_retirada,
                    :id_confeiteira, :veredito_confeiteira, :status, :valor
                )"
            );

            $stmt->bindValue(":id_cliente", $p->getId_cliente());
            $stmt->bindValue(":nome_cliente", $p->getNome_cliente());
            $stmt->bindValue(":produtos", json_encode($p->getProdutos()));
            $stmt->bindValue(":previsao_retirada", $p->getPrevisao_retirada());
            $stmt->bindValue(":id_confeiteira", $p->getId_confeiteira());
            $stmt->bindValue(":veredito_confeiteira", $p->getVeredito_confeiteira());
            $stmt->bindValue(":status", $p->getStatus());
            $stmt->bindValue(":valor", $p->getValor());

            $stmt->execute();
            return true;

        } catch (PDOException $ex) {
            echo "Erro ao cadastrar pedido: " . $ex->getMessage();
            return false;
        }
    }

    // ============================================================
    // ALTERAR
    // ============================================================
    public function alterar($p)
    {
        try {
            $stmt = $this->con->prepare(
                "UPDATE pedido SET
                    id_cliente = :id_cliente,
                    nome_cliente = :nome_cliente,
                    produtos = :produtos,
                    previsao_retirada = :previsao_retirada,
                    id_confeiteira = :id_confeiteira,
                    veredito_confeiteira = :veredito_confeiteira,
                    status = :status,
                    valor = :valor
                 WHERE id_pedido = :id_pedido"
            );

            $stmt->bindValue(":id_cliente", $p->getId_cliente());
            $stmt->bindValue(":nome_cliente", $p->getNome_cliente());
            $stmt->bindValue(":produtos", json_encode($p->getProdutos()));
            $stmt->bindValue(":previsao_retirada", $p->getPrevisao_retirada());
            $stmt->bindValue(":id_confeiteira", $p->getId_confeiteira());
            $stmt->bindValue(":veredito_confeiteira", $p->getVeredito_confeiteira());
            $stmt->bindValue(":status", $p->getStatus());
            $stmt->bindValue(":valor", $p->getValor());
            $stmt->bindValue(":id_pedido", $p->getId_pedido());

            $this->con->beginTransaction();
            $stmt->execute();
            $this->con->commit();

            return true;

        } catch (PDOException $ex) {
            echo "Erro ao alterar pedido: " . $ex->getMessage();
            return false;
        }
    }

    // ============================================================
    // EXCLUIR
    // ============================================================
    public function excluir($p)
    {
        try {
            $stmt = $this->con->prepare(
                "DELETE FROM pedido WHERE id_pedido = :id_pedido"
            );

            $stmt->bindValue(":id_pedido", $p->getId_pedido(), PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0;

        } catch (PDOException $ex) {
            echo "Erro ao excluir pedido: " . $ex->getMessage();
            return false;
        }
    }

    // ============================================================
    // LISTAR
    // ============================================================
    public function listar($query = null)
    {
        try {
            $dados = ($query == null)
                ? $this->con->query("SELECT * FROM pedido ORDER BY id_pedido DESC")
                : $this->con->query($query);

            $lista = array();

            foreach ($dados as $linha) {

                $p = new Pedido();
                $p->setId_pedido($linha["id_pedido"]);
                $p->setId_cliente($linha["id_cliente"]);
                $p->setNome_cliente($linha["nome_cliente"]);
                $p->setProdutos(json_decode($linha["produtos"], true));
                $p->setPrevisao_retirada($linha["previsao_retirada"]);
                $p->setId_confeiteira($linha["id_confeiteira"]);
                $p->setVeredito_confeiteira($linha["veredito_confeiteira"]);
                $p->setStatus($linha["status"]);
                $p->setData_criacao($linha["data_criacao"]);
                $p->setValor($linha["valor"]);

                $lista[] = $p;
            }

            return $lista;

        } catch (PDOException $ex) {
            echo "Erro ao listar pedidos: " . $ex->getMessage();
        }
    }

    // ============================================================
    // EXIBIR
    // ============================================================
    public function exibir($id_pedido)
    {
        try {
            $stmt = $this->con->prepare(
                "SELECT * FROM pedido WHERE id_pedido = :id_pedido"
            );
            $stmt->bindValue(":id_pedido", $id_pedido, PDO::PARAM_INT);
            $stmt->execute();

            $dado = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dado) {
                return null;
            }

            $p = new Pedido();
            $p->setId_pedido($dado["id_pedido"]);
            $p->setId_cliente($dado["id_cliente"]);
            $p->setNome_cliente($dado["nome_cliente"]);
            $p->setProdutos(json_decode($dado["produtos"], true));
            $p->setPrevisao_retirada($dado["previsao_retirada"]);
            $p->setId_confeiteira($dado["id_confeiteira"]);
            $p->setVeredito_confeiteira($dado["veredito_confeiteira"]);
            $p->setStatus($dado["status"]);
            $p->setData_criacao($dado["data_criacao"]);
            $p->setValor($dado["valor"]);

            return $p;

        } catch (PDOException $ex) {
            echo "Erro ao exibir pedido: " . $ex->getMessage();
        }
    }

    // ============================================================
    // BUSCAR POR ID
    // ============================================================
    public function buscarPorId($id)
    {
        try {
            $stmt = $this->con->prepare(
                "SELECT * FROM pedido WHERE id_pedido = :id_pedido"
            );
            $stmt->bindValue(":id_pedido", $id, PDO::PARAM_INT);
            $stmt->execute();

            $dado = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dado) {
                return null;
            }

            $p = new Pedido();
            $p->setId_pedido($dado["id_pedido"]);
            $p->setId_cliente($dado["id_cliente"]);
            $p->setNome_cliente($dado["nome_cliente"]);
            $p->setProdutos(json_decode($dado["produtos"], true));
            $p->setPrevisao_retirada($dado["previsao_retirada"]);
            $p->setId_confeiteira($dado["id_confeiteira"]);
            $p->setVeredito_confeiteira($dado["veredito_confeiteira"]);
            $p->setStatus($dado["status"]);
            $p->setData_criacao($dado["data_criacao"]);
            $p->setValor($dado["valor"]);

            return $p;

        } catch (PDOException $ex) {
            echo "Erro ao buscar pedido: " . $ex->getMessage();
            return null;
        }
    }
}
