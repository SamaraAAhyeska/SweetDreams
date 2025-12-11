<?php

include_once("Model/PedidoDAO.php");

class ExibirPed
{

	public function __construct()
	{

		$dao = new PedidoDAO();
		$cont = $dao->exibir($_GET["id_ped"]);
		include_once("view/ListarPed.php");
	}
}
