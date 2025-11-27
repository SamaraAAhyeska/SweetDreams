<?php
class Estoque
{
    private $id_estoque;
    private $id_produto;
    private $quantidade;
    private $data_atualizacao; // apenas leitura

    public function __construct() {}

    // ID Estoque
    public function setId_estoque($id)
    {
        $this->id_estoque = $id;
    }
    public function getId_estoque()
    {
        return $this->id_estoque;
    }

    // ID Produto
    public function setId_produto($id)
    {
        $this->id_produto = $id;
    }
    public function getId_produto()
    {
        return $this->id_produto;
    }

    // Quantidade
    public function setQuantidade($q)
    {
        $this->quantidade = $q;
    }
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    // Data de atualização (somente leitura)
    public function getData_atualizacao()
    {
        return $this->data_atualizacao;
    }
    public function setData_atualizacao($data)
    {
        // usado apenas para preencher a entidade ao ler do banco
        $this->data_atualizacao = $data;
    }
}
