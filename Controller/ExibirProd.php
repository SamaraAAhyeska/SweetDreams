<?php

include_once("Model/ProdutoDAO.php");

class ExibirProd
{

	public function __construct()
	{

		$dao = new ProdutoDAO();
		$cont = $dao->exibir($_GET["id_prod"]);
		include_once("view/ListaProd.php");
	}
}
