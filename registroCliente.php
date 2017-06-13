<?php 
	/* soporte.php crea :
	  	-una instancia del la clase auth ($auth) para manejar todos los metodos que tienen que ver con el login (session y cookie) y
	  	-una instancia del repositorio ($repo) para poder trabajar con los clientes
	 */
	require_once("soporte.php");

	require_once("classes/validadorCliente.php");
	require_once("inputValues.php");

    if ($auth->estaLogueado()) {
        header("Location:main.php");exit;
    }

	$titulo_error='';
	$arr_cliente=clear_inputValues();
	$errores=[];

	$repoClientes = $repo->getRepositorioClientes();

	if (!empty($_POST))    {  

			$arr_cliente=set_inputValues($_POST);

		    $validador = new ValidadorCliente();
		       
		    $errores = $validador->validar($_POST, $repo);

		    if (empty($errores)) //Si no hay errores guardo el nuevo Cliente

		        {    
		            //Primero: creo la instancia
		            $cliente = new Cliente($arr_cliente);
	            
		            // Seteo la password para que se guarde hasheada
		            $cliente->setPassword($_POST["password"]);
		           
					//Guardo el Avatar a su lugar y seteo el path de donde quedo
					$cliente->setAvatar($cliente->guardarAvatar($_FILES["avatar"]));
		            
		            if ($cliente->guardar($repoClientes)) 
		            {  
						//Si no hubo problemas al guardar el Cliente voy a la pagina de exito
						$auth->loguear($cliente);
						header("Location:registroCliente_exito.php");
						exit; 		
					}
		        	else { 
		        		// Si fallo el guardado del Cliente 
					   $titulo_error = "Se produjo un error al guardar el registro, 
					   					por favor intentelo nuevamente." ;			
				      }
		        }
			else { 
				// Si fallo la validacion del Cliente (hubo errores)				
				$titulo_error ="Por favor revise los datos ingresados";			        
			}
	}
	
?>


<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>Cooking Company - Sign-In</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins">	
	</head>

	<body>

		<?php
			include "header.php";
		?>


		<div class=container-formulario>

		
			<h1>Crear cuenta</h1>

			<div class=crear-cliente-container>	
				
				<?php 
				  	if (!($titulo_error=='')) {
				  		echo "<div class='mensaje-error'>
				  		 		  <h3>$titulo_error</h3>
							  </div>";
				  	}	

				  	include('errores.php');		
				?>	

				<div class="crear-cliente">
							
					<h2>Nuevo cliente</h2>


					<form class="form-alta" method="post" 					
						  enctype="multipart/form-data">

						<label for="email">Email </label> 	
						<?php 
							echo "<input id='email' type='e-mail' name='email' 
							       value='".$arr_cliente['email']."'' required /> ";
						?>
						<!--<span class='error'><?php echo($errores['email']); ?></span>-->
						<br> <br>
						
						<label for="password">Password </label> 
						<?php 
							echo "<input id='password' type='password' name='password' 
							       value='".$arr_cliente['password']."'' maxlength='20' /> ";
						?>						
						
						<label for="password2" >Confirmar </label>
		                <input id="password2" type="password" name="password2" value=""  maxlength="20">
		                <br>  
		                <!--<span class='error'><?php echo($errores['password']); ?></span>-->
		                <br>             
		             
						<label for="nombre">Nombre </label>		
						<?php 
							echo "<input id='nombre' type='text' name='nombre' 
								   value='".$arr_cliente['nombre']."' required maxlength='20'>" 
						?>
						
						<label for="apellido">Apellido </label>	
						<?php 
							echo "<input id='apellido' type='text' name='apellido' 
								   value='".$arr_cliente['apellido']."' required maxlength='30'>" 
						?>	
						<br>						
						<!--<span class='error'><?php echo($errores['nombre'].'  '); ?></span>
						<span class='error'><?php echo($errores['apellido']); ?></span> -->
						<br>

						<label for="avatar">Imagen perfil </label>		
						<input id="avatar" type="file" name="avatar" value="" > <br> <br>						

						<label for="sexo">Sexo </label>		
						<select name="sexo" >
								<option value="femenino">Femenino</option>
								<option value="masculino">Masculino</option>
						</select>
						
						<label for="fechanac">Fecha de Nacimiento </label>		
						<?php 
							echo "<input id='fechanac' type='date' name='fechanac' 
								   value='".$arr_cliente['fechanac']."' >" 
						?>	
						<br> 
						<!--<span class='error'><?php echo($errores['sexo'].'  '); ?></span>
						<span class='error'><?php echo($errores['fechanac']); ?></span> -->
						<br>
								
						<label for="direccion">Dirección</label>  	

						<?php 
							echo "<input id='direccion' type='text' name='direccion' 
								   value='".$arr_cliente['direccion']."' required maxlength='100'>" 
						?>	
						
						<label for="codPostal">Codigo Postal </label> 
						<?php 
							echo "<input id='codPostal' type='text' name='codPostal' 
								   value='".$arr_cliente['codPostal']."' required maxlength='8'>" 
						?>	
						<br>
						<!--<span class='error'><?php echo($errores['direccion'].'  '); ?></span>
						<span class='error'><?php echo($errores['codPostal']); ?></span> -->
						<br>

						<label for="localidad">Localidad </label>  	
						<?php 
							echo "<input id='localidad' type='text' name='localidad' 
								   value='".$arr_cliente['localidad']."' required maxlength='50'>" 
						?>	 

						<label for="provincia">Provincia </label>  	
						<select name="provincia" >
								<option value="Capital Federal">Capital Federal</option>
								<option value="Buenos Aires">Buenos Aires</option>
						</select>
						<br>
						<!--<span class='error'><?php echo($errores['localidad'].'  '); ?></span>
						<span class='error'><?php echo($errores['provincia']); ?></span> -->
						<br>
						
						<div class='botones'>
							<!--<button name='reset' type='reset'>Reset</button> -->
							<button name='registrar' type='submit'>Crear cuenta</button>
						</div> 

					</form>

				</div>
			</div>
		</div>
		
		<?php
			include "footer.php";
		?>

	</body>

</html>
