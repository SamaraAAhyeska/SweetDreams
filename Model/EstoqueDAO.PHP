<?php
include_once("ConnectionFactory_class.php"); //PDO
include_once("Estoque_class.php"); //entidade
include_once(__DIR__ . "/../Model/EstoqueDAO.php");

class EstoqueDAO
{
    public $con = null;

    public function __construct()
    {
        $conF = new ConnectionFactory();
        $this->con = $conF->getConnection();
    }

    // cadastrar
    public function cadastrar($cont)
    {
        try {
            $stmt = $this->con->prepare(
                "INSERT INTO estoque(id_produto, quantidade)
                 VALUES (:id_produto, :quantidade)"
            );

            $stmt->bindValue(":id_produto", $cont->getId_produto());
            $stmt->bindValue(":quantidade", $cont->getQuantidade());

            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    // alterar
    public function alterar($cont)
    {
        try {
            $stmt = $this->con->prepare(
                "UPDATE estoque 
                 SET id_produto=:id_produto, quantidade=:quantidade 
                 WHERE id_estoque=:id_estoque"
            );

            $stmt->bindValue(":id_produto", $cont->getId_produto());
            $stmt->bindValue(":quantidade", $cont->getQuantidade());
            $stmt->bindValue(":id_estoque", $cont->getId_estoque());

            $this->con->beginTransaction();
            $stmt->execute();
            $this->con->commit();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    // excluir
    public function excluir($cont)
    {
        try {
            $stmt = $this->con->prepare(
                "DELETE FROM estoque WHERE id_estoque = :id_estoque"
            );

            $stmt->bindValue(":id_estoque", $cont->getId_estoque(), PDO::PARAM_INT);
            $stmt->execute();

            return ($stmt->rowCount() > 0);
        } catch (PDOException $ex) {
            echo "Erro ao excluir: " . $ex->getMessage();
            return false;
        }
    }

    // listar
    public function listar($query = null)
    {
        try {
            if ($query == null) {
                $dados = $this->con->query("SELECT * FROM estoque");
            } else {
                $dados = $this->con->query($query);
            }

            $lista = array();

            foreach ($dados as $linha) {
                $c = new Estoque();
                $c->setId_estoque($linha["id_estoque"]);
                $c->setId_produto($linha["id_produto"]);
                $c->setQuantidade($linha["quantidade"]);
                $c->setData_Atualizacao($linha["data_atualizacao"]);

                $lista[] = $c;
            }
            return $lista;

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    // exibir
    public function exibir($id_estoque)
    {
        try {
            $lista = $this->con->query(
                "SELECT * FROM estoque WHERE id_estoque = " . $id_estoque
            );

            $dado = $lista->fetchAll(PDO::FETCH_ASSOC);

            $c = new Estoque();
            $c->setId_estoque($dado[0]["id_estoque"]);
            $c->setId_produto($dado[0]["id_produto"]);
            $c->setQuantidade($dado[0]["quantidade"]);
            $c->setData_Atualizacao($dado[0]["data_atualizacao"]);

            return $c;

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    // buscarPorId
    public function buscarPorId($id)
    {
        try {
            $stmt = $this->con->prepare(
                "SELECT * FROM estoque WHERE id_estoque = :id_estoque"
            );
            $stmt->bindValue(":id_estoque", $id, PDO::PARAM_INT);
            $stmt->execute();
            $dado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dado) {
                $c = new Estoque();
                $c->setId_estoque($dado["id_estoque"]);
                $c->setId_produto($dado["id_produto"]);
                $c->setQuantidade($dado["quantidade"]);
                $c->setData_Atualizacao($dado["data_atualizacao"]);

                return $c;
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
            return null;
        }
    }
}
?>
