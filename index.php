<?php
session_start(); //Inicia a sessão
//área de memória dentro do servidor
//carrinho de compras, seus dados de conexão
//qualquer variável que vc queira criar
//include_once("visao/topo.php");
include_once("Controller/CadastrarConf.php");
$index = new CadastrarConf();
//atribuição de responsabilidade
//o Controller  sabe como exibir a lista de Clientes
//include_once("visao/base.php");
