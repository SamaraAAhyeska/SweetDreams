<?php

include_once("Model/FuncionarioDAO_class.php");

class ExibirFun
{

	public function __construct()
	{

		$dao = new FuncionarioDAO();
		$cont = $dao->exibir($_GET["id"]);
		include_once("view/ExibirFun.php");
	}
}
