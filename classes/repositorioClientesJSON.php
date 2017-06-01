<?php
	require_once("repositorioClientes.php");

	class RepositorioClientesJSON extends RepositorioClientes {

		const ARCH_CLIENTES_JSON="./data/clientes.json";

		public function traerTodosLosClientes() {

	        $clientes = [];

	        if (file_exists(self::ARCH_CLIENTES_JSON)) {	        	
	       
		        //1: Me traigo todo el archivo
		        $archivoClientes = file_get_contents(self::ARCH_CLIENTES_JSON);

		        //2: Lo divido por lineas
		        $clientesJSON = explode(PHP_EOL , $archivoClientes);

		        //3: Borro la linea vacía del final
		        $cantidadClientes = count($clientesJSON);
		        $elUltimo = $cantidadClientes - 1;

		        unset($clientesJSON[$elUltimo]);

		        //4: Recorro mis lineas y las paso a arrays
		        foreach ($clientesJSON as $clienteJSON) {
		        	
		        	$clienteArray = json_decode($clienteJSON, true);

		        	$cliente = new cliente($clienteArray);
		        	/*
		        		$clienteArray["id"],	        		
		        		$clienteArray["email"],	        		
		        		$clienteArray["password"],
		        		$clienteArray["nombre"],
		        		$clienteArray["apellido"],
		        		$clienteArray["sexo"],
		        		$clienteArray["fechanac"],
		        		$clienteArray["direccion"],
		        		$clienteArray["codPostal"],
		        		$clienteArray["localidad"],	        		
		        		$clienteArray["provincia"],
		        		$clienteArray["avatar"]
		        	);*/

		            $clientes[] = $cliente;
		        }
		    }

	        return $clientes;
	    }

	   	// No me gusta mucho porque asume que los clientes estan guardados ordenados por id
	    public function traerProximoId() {

	    	
	        if (!file_exists(self::ARCH_CLIENTES_JSON)) {
	        	return 1;
	        } else {

		        //1: Me traigo todo el archivo
		        $archivoClientes = file_get_contents(self::ARCH_CLIENTES_JSON);

		        $elUltimo=-1;

		        if ($archivoClientes) {
			        //2: Lo divido por lineas
			        $clientesJSON = explode(PHP_EOL , $archivoClientes);

			        //3: Obtengo indice último cliente
			        $cantidadclientes = count($clientesJSON);
			        $elUltimo = $cantidadclientes - 2;
			    }

		        if ($elUltimo < 0) {
		            return 1;
		        }

		        //4: Traigo el último cliente
		        $ultimocliente = $clientesJSON[$elUltimo];

		        $ultimocliente = json_decode($ultimocliente, true);

		        return $ultimocliente["id"] + 1;

		    }
	    }

	    public function guardar(cliente $cliente) {
	    	
	    	if ($cliente->getId() == null) {
	    		$cliente->setId($this->traerProximoId());
	    	}

	    	$clienteJSON = json_encode($cliente->toArray());
	    	
	    	
	    	If (file_put_contents(self::ARCH_CLIENTES_JSON,$clienteJSON . PHP_EOL , 
	    						   FILE_APPEND | LOCK_EX))
	    	{
				return true; /* vuelve con exito siempre que el registro se guarde en el 	archivo de clientes.*/
			}

	 		else { 

	    		return false;  /* Devuelve FALSE solo cuando no puede guardar el registro en el archivo de clientes */
    		}    
	}


	public function existeElMail($email){
	
			$gestor = @fopen(self::ARCH_CLIENTES_JSON, "r");

			if ($gestor) { 
				while (($registro = fgets($gestor)) !== false) {
			
					$cliente=json_decode($registro,true);

					if ($cliente['email'] == $email ) {
						fclose($gestor);
						return true; 
					}
				} 

				fclose($gestor);
			} 

		
			return false;

		}


}

