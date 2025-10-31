<?php
class Cliente
{
	//classe entidade	
	private $id;
	private $nome;
	private $cpf;
	private $endereco;
	private $idade;
	private $cidade;
	private $telefone;


	public function __construct() {}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	public function getId()
	{
		return $this->id;
	}
	//demais getters e setters

	public function getNome()
	{
		return $this->nome;
	}
	public function setNome($n)
	{
		$this->nome = $n;
	}

	public function getCpf()
	{
		return $this->cpf;
	}
	public function setCpf($cpf)
	{
		$this->cpf = $cpf;
	}

	public function getEndereco()
	{
		return $this->endereco;
	}
	public function setEndereco($e)
	{
		$this->endereco = $e;
	}
	public function getCidade()
	{
		return $this->cidade;
	}
	public function setCidade($cid)
	{
		$this->cidade = $cid;
	}
	public function getIdade()
	{
		return $this->idade;
	}
	public function setIdade($idd)
	{
		$this->idade = $idd;
	}
	public function getTelefone()
	{
		return $this->telefone;
	}
	public function setTelefone($t)
	{
		$this->telefone = $t;
	}
}
