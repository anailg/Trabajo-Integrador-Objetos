<?php 

	require_once("classes/cliente.php");
	require_once("classes/repositorioClientes.php");
	require_once("classes/repositorioJSON.php");
	require_once("classes/repositorioMySQL.php");

	function migrarClientes() {

		$repoJSON = new RepositorioJSON();
		$repoCliJSON = $repoJSON->getRepositorioClientes();

		$repoMySQL = new RepositorioMySQL();
		$repoCliMySQL = $repoMySQL->getRepositorioClientes();
		
		$clientes = $repoCliJSON->traerTodosLosClientes();

		$errores=[];
		foreach ($clientes as $cliente) {
			$result = $repoCliMySQL -> guardar($cliente);
			if (!($result===true)) {
				$errores[]=$result;
			}
		}
		
		return $errores;

	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Migración de JSON a MySQL - Cooking Company</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/migrar.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins">	
</head>

<body>

	<div class=container>

	<div class=container-2>
		<h3>Se copiarán los datos del archivo JSON a la base de datos de MySQL. Espere por favor ...</h3>
		<?php  
			$errores=migrarClientes();
			include("errores.php");
		?>
		<h3>Finalizó la copia de datos</h3>

		<div class="btn_continuar">
			<a href="menuMigrar.php">Volver</a> <br>
		</div> 
	</div>	
	</div>

</body>
</html>
