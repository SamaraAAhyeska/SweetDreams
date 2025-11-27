<?php
class Produto
{
    // Classe entidade
    private $id_prod;
    private $nome;
    private $descricao;
    private $preco;

    public function __construct() {}

    // ID
    public function setId_prod($id)
    {
        $this->id_prod= $id;
    }
    public function getId_prod()
    {
        return $this->id_prod;
    }

    // Nome
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($n)
    {
        $this->nome = $n;
    }

    // Descrição
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setDescricao($d)
    {
        $this->descricao = $d;
    }

    // Preço
    public function getPreco()
    {
        return $this->preco;
    }
    public function setPreco($p)
    {
        $this->preco = $p;
    }
}


