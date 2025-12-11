<?php

class Pedido
{
    private $id_pedido;
    private $id_cliente;
    private $nome_cliente;
    private $produtos;               // ARRAY (JSON no banco)
    private $previsao_retirada;
    private $id_confeiteira;
    private $veredito_confeiteira;
    private $status;
    private $data_criacao;
    private $valor;

    // ============================================
    // ID PEDIDO
    // ============================================
    public function getId_pedido()
    {
        return $this->id_pedido;
    }

    public function setId_pedido($id_pedido)
    {
        $this->id_pedido = $id_pedido;
    }

    // ============================================
    // ID CLIENTE
    // ============================================
    public function getId_cliente()
    {
        return $this->id_cliente;
    }

    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    // ============================================
    // NOME CLIENTE
    // ============================================
    public function getNome_cliente()
    {
        return $this->nome_cliente;
    }

    public function setNome_cliente($nome_cliente)
    {
        $this->nome_cliente = $nome_cliente;
    }

    // ============================================
    // PRODUTOS (array)
    // ============================================
    public function getProdutos()
    {
        return $this->produtos;
    }

    public function setProdutos($produtos)
    {
        // Aceita array ou JSON e garante que será array interno
        if (is_string($produtos)) {
            $this->produtos = json_decode($produtos, true);
        } else {
            $this->produtos = $produtos;
        }
    }

    // ============================================
    // PREVISÃO DE RETIRADA
    // ============================================
    public function getPrevisao_retirada()
    {
        return $this->previsao_retirada;
    }

    public function setPrevisao_retirada($previsao_retirada)
    {
        $this->previsao_retirada = $previsao_retirada;
    }

    // ============================================
    // ID CONFEITEIRA
    // ============================================
    public function getId_confeiteira()
    {
        return $this->id_confeiteira;
    }

    public function setId_confeiteira($id_confeiteira)
    {
        $this->id_confeiteira = $id_confeiteira;
    }

    // ============================================
    // VEREDITO CONFEITEIRA
    // ============================================
    public function getVeredito_confeiteira()
    {
        return $this->veredito_confeiteira;
    }

    public function setVeredito_confeiteira($veredito_confeiteira)
    {
        $this->veredito_confeiteira = $veredito_confeiteira;
    }

    // ============================================
    // STATUS
    // ============================================
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    // ============================================
    // DATA DE CRIAÇÃO
    // ============================================
    public function getData_criacao()
    {
        return $this->data_criacao;
    }

    public function setData_criacao($data_criacao)
    {
        $this->data_criacao = $data_criacao;
    }

    // ============================================
    // VALOR
    // ============================================
    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }
}
?>
