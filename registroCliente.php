<?php 
	require_once("soporte.php");	

    if ($auth->estaLogueado()) {
        header("Location:main.php");exit;
    }
    require_once("php/setInputValues.php");
?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>Cooking Company - Sign-In</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css">	 -->
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins">
		<link rel="stylesheet" type="text/css" href="css/extractoBootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel='stylesheet' type='text/css' id='paleta' class='paleta1' href='css/paleta1.css'>

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
				  		echo "<div class='mensaje-error'><h3>$titulo_error</h3></div>";
				  	}		
				?>	

				<div class="crear-cliente">
							
					<h2>Nuevo cliente</h2>

					<form class="form-alta" method="post" action="php/cliente.controller.php"
						  enctype="multipart/form-data">

						<div class="form-group <?php if ($errores['email']) : ?>has-error<?php endif ?>">
							<label for="email">Email </label> 	
							<?php 
								echo "<input class='input-field' id='email' type='e-mail'
									name='email' value='".$arr_cliente['email']."'' 
								    /> ";
								    // required /> ";
							?>
							<span class='help-block'>							
								<?php if (isset($errores['email'])){echo($errores['email']);} ?>
							</span>
						</div>
						<br> 
						
						<div class="form-group <?php if ($errores['password']) : ?>has-error<?php endif ?>">
							<label for="password">Password </label> 
							<?php 
								echo "<input class='input-field' id='password' type='password' name='password' 
									value='".$arr_cliente['password']."'' maxlength='20' /> ";
							?>						
							<br>  
							<label for="password2" >Confirmar </label>
			                <input id="password2" type="password" name="password2" value=""  maxlength="20">
			                
			                <span class='help-block'>
			                	<?php if(isset($errores['password'])){echo($errores['password']);} ?>
			                </span> 
			                
			            </div>
		                <br>      
		             
						<div class="form-group <?php if ($errores['nombre']) : ?>has-error<?php endif ?>">
							<label for="nombre">Nombre </label>		
							<?php 
								echo "<input class='input-field' id='nombre' type='text' name='nombre' 
									value='".$arr_cliente['nombre']."'
									 maxlength='20'>" 
							?>
							<span class='help-block'>
								<?php if (isset($errores['nombre'])){echo($errores['nombre'].'  ');} ?>	
							</span>								
						</div>
						
						<div class="form-group 
							<?php if ($errores['apellido']) : ?>has-error<?php endif ?>">
							<label for="apellido">Apellido </label>	
							<?php 
								echo "<input class='input-field' id='apellido' type='text' name='apellido' 
									   value='".$arr_cliente['apellido']."' required maxlength='30'>" 
							?>
							<span class='help-block'>
			                	<?php if (isset($errores['apellido'])) {echo($errores['apellido']);} ?>
			            	</span>							
						</div>			
						<br> 

						<div class="form-group <?php if ($errores['avatar']) : ?>has-error<?php endif ?>">
							<label for="avatar">Imagen perfil </label>		
							<input class='input-field' id="avatar" type="file" name="avatar" value="" > 
						</div>
						<br> 				

						<div class="form-group <?php if ($errores['sexo']) : ?>has-error<?php endif ?>">
							<label for="sexo">Sexo </label>		
							<select name="sexo" class='input-field'>
									<option value="femenino">Femenino</option>
									<option value="masculino">Masculino</option>
							</select>
							<span class='help-block'>
								<?php if(isset($errores['sexo'])) {echo($errores['sexo'].'  ');}?>
							</span>
						</div>
						
						<div class="form-group 
							<?php if ($errores['fechanac']) : ?>has-error<?php endif ?>">
							<label for="fechanac">Nacimiento </label>		
							<?php 
								echo "<input class='input-field' id='fechanac' type='date' name='fechanac' 
									   value='".$arr_cliente['fechanac']."' >" 
							?>
							<span class='help-block'>
								<?php if(isset($errores['fechanac'])){echo($errores['fechanac']);}?>
							</span> 
						</div>	
						<br> 
								
						<div class="dir-envio">
							<div class="form-group <?php if ($errores['direccion']) : ?>has-error<?php endif ?>">
								<label for="direccion">Dirección</label> 

								<?php 
									echo "<input class='input-field' id='direccion' type='text' name='direccion' 
										   value='".$arr_cliente['direccion']."' required maxlength='100'>" 
								?>
								<span class='help-block'>
									<?php if (isset($errores['direccion'])){echo($errores['direccion']);} ?>
								</span>
							</div>							
							
							<div class="form-group 
								<?php if ($errores['codPostal']) : ?>has-error<?php endif ?>">
								<label for="codPostal">Cod.Postal </label> 
								<?php 
									echo "<input class='input-field' id='codPostal' type='text' name='codPostal' 
										   value='".$arr_cliente['codPostal']."' required maxlength='8'>" 
								?>
								<span class='help-block'>
									<?php if(isset($errores['codPostal'])){echo($errores['codPostal']);} ?>
								</span>
							</div>	
							
							<div class="form-group 
								<?php if ($errores['localidad']) : ?>has-error<?php endif ?>">
								<label for="localidad">Localidad </label>  	
								<?php 
									echo "<input class='input-field' id='localidad' type='text' name='localidad' 
										   value='".$arr_cliente['localidad']."' required maxlength='50'>" 
								?>
								<span class='help-block'>
									<?php if(isset($errores['localidad'])) {echo($errores['localidad']);} ?>
								</span>
							</div>
							 
							<div class="form-group 
								<?php if ($errores['provincia']) : ?>has-error<?php endif ?>">
								<label for="provincia">Provincia </label>  	
								<select class='input-field' name="provincia" >
										<option value="Capital Federal">Capital Federal</option>
										<option value="Buenos Aires">Buenos Aires</option>
								</select>
								<span class='help-block'>
									<?php if(isset($errores['provincia'])) {echo($errores['provincia']); }?>
								</span>
							</div>
							
						</div>
						
						<div class='botones'>							
							<button name='registrar' type='submit'>Crear cuenta</button>
						</div> 

					</form>

				</div>
			</div>
		</div>
		
		<?php
			include "footer.php";
		?>

		<script src="js/validacionesRegistro.js"></script>
	</body>

</html>
