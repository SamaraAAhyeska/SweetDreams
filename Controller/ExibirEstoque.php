<?php

include_once("Model/EstoqueDAO_class.php");

class ExibirEst
{

	public function __construct()
	{

		$dao = new EstoqueDAO();
		$cont = $dao->exibir($_GET["id"]);
		include_once("view/ExibirEst.php");
	}
}
