<?php

	require_once("classes/auth.php");
	require_once("classes/repositorioJSON.php");

	
	$tipoRepositorio = "json";

	switch($tipoRepositorio) {
		case "json":
			$repo = new RepositorioJSON();
			break;
	}

	$auth = Auth::getInstancia($repo->getRepositorioClientes());
?>
