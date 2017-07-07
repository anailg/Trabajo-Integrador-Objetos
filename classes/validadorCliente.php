<?php
	require_once("validador.php");
	require_once("repositorio.php");

	class ValidadorCliente extends Validador {

		public function validar(Array $datos, Repositorio $repo) {

			$repoClientes = $repo->getRepositorioClientes();

			$errores = [];

	        if (empty(trim($datos["nombre"])))
	        {
	            $errores["nombre"] = "El nombre es requerido";
	        }

	        if (empty(trim($datos["apellido"])))
	        {
	            $errores["apellido"] = "El apellido es requerido";
	        }

	        if (empty(trim($datos["email"])))
	        {
	            $errores["email"] = "El email es requerido";
	        }
	        elseif (!filter_var($datos["email"], FILTER_VALIDATE_EMAIL)) {
	            $errores["email"] = "El email ingresado no es correcto";   
	        }
	        elseif ($repoClientes->existeElMail($datos["email"]))
	        {
	            $errores["email"] = "El email ya esta registrado";      
	        }

	        /* --- Validaciones password ------*/		
			if ( (strlen($datos['password']) < 6) || (strlen($datos['password']) > 20)) {
				$errores['password'] = 
	            	'La contraseña debe tener al menos 6 caracteres y no mas de 20';
	        } elseif ($datos['password'] !== $datos['password2']) {
				$errores['password'] = 'Las contraseñas no coinciden';	
	        }

	        /* --- Validaciones Sexo ------*/
			if (($datos['sexo'] !== 'femenino') & ($datos['sexo'] !== 'masculino')){
	            $errores['sexo'] = 'Sexo invalido';
	        }

	           /* --- Validaciones Fecha Nacimiento ------*/
	        if ($this->fecha_invalida($datos['fechanac'])) {
				$errores['fechanac'] = 'La fecha de nacimiento no es valida';
			}

			/* --- Validaciones Codigo Postal ------*/
	        $cp_invalido=false;
	        $datos['codPostal']= trim($datos['codPostal']) ;
	        $long_cp=strlen($datos['codPostal']);
	        if (($long_cp!==8) & ($long_cp!==4) ){
	        	$cp_invalido=true;         	        	
	        } else {
		        	if ($long_cp==8){
		        		$datos['codPostal']=strtoupper($datos['codPostal']);
		        		if (!(($this->solo_letras(substr($datos['codPostal'],0,1))) &
		        			  ($this->solo_numeros(substr($datos['codPostal'],1,4)))&
		        			  ($this->solo_letras(substr($datos['codPostal'],5,3))) ) ){
		        			$cp_invalido=true;
		        		}

	        		} elseif (!($this->solo_numeros(substr($datos['codPostal'],1,4)))){
	        		  	$cp_invalido=true;
	        		}
	        		
	        	}
	        if ($cp_invalido) {        
	        	$errores['codPostal'] ='El codigo postal no es válido ';
	        }


	        if ($datos["direccion"] == "")
	        {
	            $errores["direccion"] = "Ingrese una direccion";      
	        }

	        if ($datos["localidad"] == "")
	        {
	            $errores["localidad"] = "Ingrese una localidad";      
	        }

       		/* --- Validaciones Provincia ------*/
	        if ($datos["provincia"] == "")
	        {
	            $errores["provincia"] = "Ingrese una provincia";      
	        } 
	        elseif (($datos['provincia'] !== 'Buenos Aires') & 
        			($datos['provincia'] !== 'Capital Federal'))
	        {
        		$errores['provincia'] = 'Disculpe no entregamos en esa provincia.';
        	}

	        /*
	        if ($_FILES["avatar"]["error"] != UPLOAD_ERR_OK) {
	            $errores["avatar"] = "Hubo un error al subir la imagen, intentelo de nuevo más tarde";
	        }
	        */

	        return $errores;
		}


		private function solo_letras($string){

			$flag=true;

			$tope=strlen($string);

			for ($i=0; $i<$tope;$i++){
				if ((ord($string[$i])<65) || (ord($string[$i]>90))){
					$flag=false;
					break; 
				}
		}

			return $flag;
		}

		private function solo_numeros($string){

			$flag=true;

			$tope=strlen($string);

			for ($i=0; $i<$tope;$i++){				
				if ((ord($string[$i])<48) || (ord($string[$i]>57))){
					$flag=false;
					break; 
				}
			}

			return $flag;
		}

		private function fecha_invalida($fecha){

		 	$fecha = new DateTime($fecha);
			$fecha_min = new DateTime("01/01/1900");
			$fecha_max = new DateTime("now");

			date_sub($fecha_max,date_interval_create_from_date_string("16 years"));

		 	if ( $fecha < $fecha_min || $fecha > $fecha_max ){
		 		return true;
		 	} else {
		 		return false;
		 	}

		 }

	}