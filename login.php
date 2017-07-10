<?php 
	
	require_once("soporte.php");
	require_once("classes/validadorLogin.php");

	if ($auth->estaLogueado()) {
		header("Location:main.php");exit;
	}

	$errores = [];
	$filter_email="";

	if ($_POST) {
		
		$validador = new ValidadorLogin();

		$errores = $validador->validar($_POST, $repo);
		
		if (empty($errores))
		{
			$cliente = $repo->getRepositorioClientes()->traerClientePorEmail($_POST["email"]);
			$auth->loguear($cliente);
			if ($validador->estaEnFormulario("recordarme")) 
			{
				$auth->guardarCookie($cliente);
			}
			header("Location:main.php");exit;
		} else {$filter_email=$_POST["email"];}
	}
	
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Cooking Company - Sign-In</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins">	
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel='stylesheet' type='text/css' id='paleta' class='paleta1' href='css/paleta1.css'>
	
</head>

<body>

	<?php
			include "header.php";
	?>

	<div class=container-formulario>

		<h1>Ingresar</h1>

		<div class=sign-in-container>

			<div class="cliente-antiguo">

				<h2>Ya soy cliente</h2>

				<form action="" method="post">

					<?php include("errores.php"); ?> 
				
					<label for="email">Email</label>  <br>	
					<?php 
						echo "<input id='email' type='e-mail' name='email' 
						       value='".$filter_email."'' required /> ";
					?> 
					<!--<span class='error'><?php echo($errores['email']); ?></span>-->
					<br> <br>
					
					<label for="password">Password</label> <br>
					<input type="password" name="password" value="" required>  <br><br>

					<a href="cambio-pswd.html">Olvidé mi password</a><br><br>

					<button type=”submit”>Ingresar</button> <br>
					<input type="checkbox" checked="checked" name="recordarme"> Recordarme					

		  		</form>
		  		
		  	</div> <!-- termina cliente-antiguo -->

			<div class="cliente-nuevo">

				<h2>Soy nuevo</h2>

				<h3> ¿Porque crear una cuenta?</h3>
				<p> Te permite hacer tus pedidos fácil y rápido </p>
				<p> Podés subscribirte para recibir novedades y recetas exclusivas</p>
				<p> Podés participar de sorteos</p>

				<div class="btn_crearcliente">
					<a href="registroCliente.php">Crear cuenta</a> <br>
				</div> 


			</div> <!-- termina cliente-nuevo -->

			
		</div> <!-- termina container-sign-in -->
	
	</div>
	
	<?php
		include "footer.php";
	?>
	

</body>

</html>