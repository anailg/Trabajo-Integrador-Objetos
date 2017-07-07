<?php 
	require_once("soporte.php");
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>Cooking Company - Cliente creado</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins">	
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel='stylesheet' type='text/css' id='paleta' class='paleta1' href='css/paletaColores1.css'>
	</head>

	<body>

		<?php
			include "header.php";
		?>
	
		<div class="mensaje">
		
			<h2>Felicitaciones! se ha registrado con exito.</h2>

			<div class="btn_continuar">
					<a href="main.php">Continuar</a> <br>
			</div> 
			
		</div>

		<?php
			include "footer.php";
		?>

	</body>

	
</html>

