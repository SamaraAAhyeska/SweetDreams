<?php
include_once("ConnectionFactory_class.php"); //PDO
include_once("Produto_class.php"); //entidade
include_once(__DIR__ . "/../Model/ProdutoDAO.php");

class ProdutoDAO
{
    //DAO - Data Access Object	
    //CRUD - Creat, Read, Update e Delete
    //operações básicas de banco de dados

    public $con = null; //obj recebe conexão

    public function __construct()
    {
        $conF = new ConnectionFactory();
        $this->con = $conF->getConnection();
    }

    //cadastrar
    public function cadastrar($cont)
    {
        try {
            $stmt = $this->con->prepare(
                "INSERT INTO produto(nome, descricao, preco)
				VALUES (:nome,  :descricao, :preco)"
            );
            //:nome - é uma âncora e será ligado pelo bindValue
            //SQL injection
            //ligamos as âncoras aos valores de Contato
            $stmt->bindValue(":nome", $cont->getNome());
            $stmt->bindValue(":descricao", $cont->getDescricao());
            $stmt->bindValue(":preco", $cont->getPreco());
            
            $stmt->execute(); //execução do SQL	
            /*$this->con->close();
				$this->con = null;*/
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    //alterar
    public function alterar($cont)
    {
        try {
            $stmt = $this->con->prepare(
                "UPDATE produto SET nome=:nome, 
				descricao=:descricao, preco=:preco WHERE id_prod=:id_prod"
            );

            //ligamos as âncoras aos valores de Contato

            $stmt->bindValue(":nome", $cont->getNome());
            $stmt->bindValue(":descricao", $cont->getDescricao());
            $stmt->bindValue(":preco", $cont->getPreco());
            $stmt->bindValue(":id_prod", $cont->getId_prod());
            $this->con->beginTransaction();
            $stmt->execute(); //execução do SQL	
            $this->con->commit();
            /*$this->con->close();
				$this->con = null;*/
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }
    //excluir
public function excluir($cont)
{
    try {
        $stmt = $this->con->prepare("DELETE FROM produto WHERE id_prod = :id_prod");
        $stmt->bindValue(":id_prod", $cont->getId_prod(), PDO::PARAM_INT);
        $stmt->execute();

        // Verifica se realmente excluiu
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        echo "Erro ao excluir: " . $ex->getMessage();
        return false;
    }
}


    //listar
    public function listar($query = null)
    {
        //se não recebe parâmetro (ou seja, uma consulto personalizada)
        //$query recebe nulo
        try {
            if ($query == null) {
                $dados = $this->con->query("SELECT * FROM Produto");
                //dataset (conjunto de dados) com todos os dados
                //query() é função PDO, executa SQL
            } else {
                $dados = $this->con->query($query);
                //se listar receber parâmetro este será uma SQL 
                //SQL específica
            }
            $lista = array(); //crio chamando função array()

            /*for($i = 0; $i<$dados.lenght; $i++){
					$c->setNome($dados[i][1]);
				}*/

            foreach ($dados as $linha) {
                //percorre linha a linha de dados e coloca cada registro
                //na variável linha (que é um vetor)
                $c = new Produto();
                $c->setId_prod($linha["id_prod"]);
                $c->setNome($linha["nome"]);
                $c->setDescricao($linha["descricao"]);
                $c->setPreco($linha["preco"]);
                
                $lista[] = $c;
            }
            return $lista;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    //exibir 
    public function exibir($id_prod)
    {
        try {
            $lista = $this->con->query("SELECT * FROM Produto WHERE id_prod = " . $id_prod);

            /*$this->con->close();
				$this->con = null;*/

            $dado = $lista->fetchAll(PDO::FETCH_ASSOC);

            $c = new Produto();
            $c->setId_prod($dado[0]["id_prod"]);
            $c->setNome($dado[0]["nome"]);
            $c->setDescricao($dado[0]["descricao"]);
            $c->setPreco($dado[0]["preco"]);


            return $c;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }


    public function buscarPorId($id)
    {
        try {
            $stmt = $this->con->prepare("SELECT * FROM Produto WHERE id_prod = :id_prod");
            $stmt->bindValue(":id_prod", $id, PDO::PARAM_INT);
            $stmt->execute();
            $dado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dado) {
                $c = new Produto();
                $c->setId_prod($dado["id_prod"]);
                $c->setNome($dado["nome"]);
                $c->setDescricao($dado["descricao"]);
                $c->setPreco($dado["preco"]);
          
                return $c;
            } else {
                return null; // Produto não encontrado
            }
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
            return null;
        }
    }
}
