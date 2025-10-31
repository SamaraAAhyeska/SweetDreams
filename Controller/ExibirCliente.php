<?php

include_once("model/ClienteDAO_class.php");

class ExibirCliente
{

	public function __construct()
	{

		$dao = new ClienteDAO();
		$cont = $dao->exibir($_GET["id"]);
		include_once("view/ExibirCliente.php");
	}
}
