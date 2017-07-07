<?php
/* soporte.php crea :
	  	-una instancia del la clase auth ($auth) para manejar todos los metodos que tienen que ver con el login (session y cookie) y
	  	-una instancia del repositorio ($repo) para poder trabajar con los clientes
*/

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
