<?php

include_once("Model/ConfeiteiraDAO_class.php");

class ExibirConf
{

	public function __construct()
	{

		$dao = new ClienteDAO();
		$cont = $dao->exibir($_GET["id"]);
		include_once("view/Exibirconf.php");
	}
}
