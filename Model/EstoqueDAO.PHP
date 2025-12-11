<?php
include_once("ConnectionFactory_class.php"); //PDO
include_once("Estoque_class.php"); //entidade
include_once(__DIR__ . "/../Model/EstoqueDAO.php");
include_once(__DIR__ . "/../Model/ProdutoDAO.php");


class EstoqueDAO
{
    public $con = null;

    public function __construct()
    {
        $conF = new ConnectionFactory();
        $this->con = $conF->getConnection();
    }

    // ============================================================
    // VERIFICAR SE JÁ EXISTE id_prod CADASTRADO
    // ============================================================
    public function existeIdProd($id_prod)
    {
        $stmt = $this->con->prepare(
            "SELECT COUNT(*) AS total FROM estoque WHERE id_prod = :id_prod"
        );
        $stmt->bindValue(":id_prod", $id_prod);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res["total"] > 0;
    }

    // ============================================================
    // CADASTRAR
    // ============================================================
    public function cadastrar($cont)
    {
        try {

            // Primeiro valida se já existe um id_prod igual
            if ($this->existeIdProd($cont->getId_prod())) {
                echo "<p style='color:red;'>Erro: Já existe estoque cadastrado para este ID de produto.</p>";
                return false;
            }

            $stmt = $this->con->prepare(
                "INSERT INTO estoque(id_prod, quantidade)
                 VALUES (:id_prod, :quantidade)"
            );

            $stmt->bindValue(":id_prod", $cont->getId_prod());
            $stmt->bindValue(":quantidade", $cont->getQuantidade());

            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
            return false;
        }
    }

    // ============================================================
    // ALTERAR
    // ============================================================
    public function alterar($cont)
    {
        try {
            // Verificar se já existe OUTRO estoque usando este id_prod
            $stmtCheck = $this->con->prepare(
                "SELECT id_estoque FROM estoque WHERE id_prod = :id_prod"
            );
            $stmtCheck->bindValue(":id_prod", $cont->getId_prod());
            $stmtCheck->execute();
            $dados = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            // Se existir um registro com o mesmo id_prod e não for este que está editando → ERRO
            if ($dados && $dados["id_estoque"] != $cont->getId_estoque()) {
                echo "<p style='color:red;'>Erro: Já existe outro estoque cadastrado com este ID de produto.</p>";
                return false;
            }

            $stmt = $this->con->prepare(
                "UPDATE estoque 
                 SET id_prod=:id_prod, quantidade=:quantidade 
                 WHERE id_estoque=:id_estoque"
            );

            $stmt->bindValue(":id_prod", $cont->getId_prod());
            $stmt->bindValue(":quantidade", $cont->getQuantidade());
            $stmt->bindValue(":id_estoque", $cont->getId_estoque());

            $this->con->beginTransaction();
            $stmt->execute();
            $this->con->commit();

            return true;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
            return false;
        }
    }

    // ============================================================
    // EXCLUIR
    // ============================================================
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

    // ============================================================
    // LISTAR
    // ============================================================
    public function listar($query = null)
    {
        try {
            $dados = ($query == null) ?
                $this->con->query("SELECT * FROM estoque") :
                $this->con->query($query);

            $lista = array();

            foreach ($dados as $linha) {
                $c = new Estoque();
                $c->setId_estoque($linha["id_estoque"]);
                $c->setId_prod($linha["id_prod"]);
                $c->setQuantidade($linha["quantidade"]);
                $c->setData_Atualizacao($linha["data_atualizacao"]);
                $lista[] = $c;
            }
            return $lista;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    // ============================================================
    // EXIBIR
    // ============================================================
    public function exibir($id_estoque)
    {
        try {
            $lista = $this->con->query(
                "SELECT * FROM estoque WHERE id_estoque = " . $id_estoque
            );

            $dado = $lista->fetchAll(PDO::FETCH_ASSOC);

            $c = new Estoque();
            $c->setId_estoque($dado[0]["id_estoque"]);
            $c->setId_prod($dado[0]["id_prod"]);
            $c->setQuantidade($dado[0]["quantidade"]);
            $c->setData_Atualizacao($dado[0]["data_atualizacao"]);

            return $c;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    // ============================================================
    // BUSCAR POR ID
    // ============================================================
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
                $c->setId_prod($dado["id_prod"]);
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
    public function buscarPorNome($nome) {
    $sql = "SELECT * FROM estoque WHERE nome = ?";
    $stmt = $this->con->prepare($sql);
    $stmt->bindValue(1, $nome);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function descontar($id, $qtd) {
    $sql = "UPDATE estoque SET quantidade = quantidade - ? WHERE id = ?";
    $stmt = $this->con->prepare($sql);
    $stmt->bindValue(1, $qtd);
    $stmt->bindValue(2, $id);
    $stmt->execute();
}

}

