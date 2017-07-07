<?php  
	include("../soporte.php");

	$cantClientes = $repo->getRepositorioClientes()->contarClientes();
	
	header('Content-Type', 'application/json');
	print json_encode([ 'cantClientes' => $cantClientes ]);

?>