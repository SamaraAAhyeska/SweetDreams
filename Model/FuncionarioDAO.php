<?php
include_once("ConnectionFactory_class.php"); //PDO
include_once("Funcionario_class.php"); //entidade
include_once(__DIR__ . "/../Model/FuncionarioDAO.php");

class FuncionarioDAO
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
                "INSERT INTO funcionario(nome, endereco, idade, cidade, telefone, cpf)
				VALUES (:nome,  :endereco, :idade, :cidade,  :telefone, :cpf)"
            );
            //:nome - é uma âncora e será ligado pelo bindValue
            //SQL injection
            //ligamos as âncoras aos valores de Contato
            $stmt->bindValue(":nome", $cont->getNome());
            $stmt->bindValue(":endereco", $cont->getEndereco());
            $stmt->bindValue(":idade", $cont->getIdade());
            $stmt->bindValue(":cidade", $cont->getCidade());
            $stmt->bindValue(":telefone", $cont->getTelefone());
            $stmt->bindValue(":cpf", $cont->getCpf());


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
                "UPDATE funcionario SET nome=:nome, 
				cpf = :cpf, endereco=:endereco, idade=:idade, cidade=:cidade, telefone=:telefone WHERE
				id=:id"
            );

            //ligamos as âncoras aos valores de Contato

            $stmt->bindValue(":nome", $cont->getNome());
            $stmt->bindValue(":cpf", $cont->getCpf());
            $stmt->bindValue(":endereco", $cont->getEndereco());
            $stmt->bindValue(":idade", $cont->getIdade());
            $stmt->bindValue(":cidade", $cont->getCidade());
            $stmt->bindValue(":telefone", $cont->getTelefone());
            $stmt->bindValue(":id", $cont->getId());
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
        $stmt = $this->con->prepare("DELETE FROM funcionario WHERE id = :id");
        $stmt->bindValue(":id", $cont->getId(), PDO::PARAM_INT);
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
                $dados = $this->con->query("SELECT * FROM funcionario");
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
                $c = new funcionario();
                $c->setId($linha["id"]);
                $c->setNome($linha["nome"]);
                $c->setCpf($linha["cpf"]);
                $c->setEndereco($linha["endereco"]);
                $c->setIdade($linha["idade"]);
                $c->setCidade($linha["cidade"]);
                $c->setTelefone($linha["telefone"]);
                $lista[] = $c;
            }
            return $lista;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    //exibir 
    public function exibir($id)
    {
        try {
            $lista = $this->con->query("SELECT * FROM funcionario WHERE id = " . $id);

            /*$this->con->close();
				$this->con = null;*/

            $dado = $lista->fetchAll(PDO::FETCH_ASSOC);

            $c = new funcionario();
            $c->setId($dado[0]["id"]);
            $c->setNome($dado[0]["nome"]);
            $c->setCpf($dado[0]["cpf"]);
            $c->setEndereco($dado[0]["endereco"]);
            $c->setIdade($dado[0]["idade"]);
            $c->setCidade($dado[0]["cidade"]);
            $c->setTelefone($dado[0]["telefone"]);

            return $c;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }


    public function buscarPorId($id)
    {
        try {
            $stmt = $this->con->prepare("SELECT * FROM funcionario WHERE id = :id");
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $dado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dado) {
                $c = new funcionario();
                $c->setId($dado["id"]);
                $c->setNome($dado["nome"]);
                $c->setCpf($dado["cpf"]);
                $c->setEndereco($dado["endereco"]);
                $c->setIdade($dado["idade"]);
                $c->setCidade($dado["cidade"]);
                $c->setTelefone($dado["telefone"]);
                return $c;
            } else {
                return null; // funcionario não encontrado
            }
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
            return null;
        }
    }
}
