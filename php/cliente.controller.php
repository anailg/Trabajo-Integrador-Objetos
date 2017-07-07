<?php 
	
	require_once("../soporte.php");
	require_once("../classes/validadorCliente.php");
	require_once("setInputValues.php");

	$repoClientes = $repo->getRepositorioClientes();
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') { 			

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
		            
		            if ($cliente->guardar($repoClientes)) {  
						$auth->loguear($cliente);						
						// header("Location: ../registroCliente_exito.php");
						// exit; 		
					}
		        	else { 
		        		// Si fallo el guardado del Cliente 
					   $titulo_error = "Se produjo un error al guardar el registro, por favor intentelo nuevamente." ;
					}
		        }
			else { 
				// Si fallo la validacion del Cliente (hubo errores)				
				$titulo_error ="Por favor revise los datos ingresados";			        
			}			

			$url_destino_final = 'registroCliente_exito.php';
			
		    if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {

		        header('Content-Type', 'application/json');

		        if (!empty($errores)) {
		          header('HTTP/1.0 422 Unprocessable entity.');
		          print json_encode($errores);
		        } else {
		          print json_encode([ 'redirect_to' => $url_destino_final ]);
		        }
		        
		    } else {

		        if (empty($errores) && $titulo_error == '') {
		          	header("Location: ../registroCliente_exito.php");
		        } else {
		        	$_SESSION['titulo_error'] = $titulo_error;
					$_SESSION['arr_cliente'] = $arr_cliente;
					$_SESSION['mensajes_error'] = $errores;
					header("Location:../registroCliente.php");
		        }
		    }
	}

	
?>