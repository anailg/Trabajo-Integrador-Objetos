<?php

	require_once("classes/auth.php");
	require_once("classes/repositorioJSON.php");
	require_once("classes/repositorioMySQL.php");

	
	$tipoRepositorio = "MySQL";

	switch($tipoRepositorio) {
		case "json":
			$repo = new RepositorioJSON();
			break;
		case "MySQL":
			$repo = new RepositorioMySQL();
			break;
	}

	$auth = Auth::getInstancia($repo->getRepositorioClientes());
?>
