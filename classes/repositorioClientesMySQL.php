<?php
	require_once("repositorioClientes.php");
	require_once("DB.php");

	class RepositorioClientesMySQL extends RepositorioClientes {
		
		public function traerTodosLosClientes() {

			$conn = new DB;
			$db = $conn->getConn();

	        $clientes = [];	        

	        $sql="SELECT cli.id,cli.email,cli.password,cli.nombre,cli.apellido, cli.sexo,
	        		     cli.fechanacimiento as fechanac,
	        		     dir.calle as direccion, dir.codigo_postal as codPostal,
	        		     dir.localidad as localidad, 
	        		     dir.provincia as provincia, cli.avatar 
	        		FROM cliente as cli LEFT JOIN direccion as dir 
	        		ON cli.id=dir.id_cliente 
	        		ORDER BY cli.id, principal DESC ";

	        
	        $query=$db->query($sql);

	        $arrClientes = $query->fetchALL(PDO::FETCH_ASSOC);

	        foreach ($arrClientes as $clienteArray) {

				$cliente = new cliente($clienteArray);							
					        	
				$clientes[] = $cliente;
			}	        
		        
		   	return $clientes;
	    } 	
	   

	    public function guardar(cliente $cliente) {	    	
	    	
	    	$conn = new DB;
			$db = $conn->getConn();

	    	$sql = "INSERT INTO cliente 
	    				VALUES (default, '".
	    						$cliente->getEmail()."','".
	    						$cliente->getPassword()."','".
	    						$cliente->getNombre()."','".
	    						$cliente->getApellido()."','".
	    						$cliente->getSexo()."','".
								$cliente->getFechaNac()."','".
								$cliente->getAvatar()."')";

			try {
				$db -> exec($sql);
				$idCliente = $db->lastInsertId();				
			}
			catch(PDOException $e) {
    			return $e->getMessage();  		
    		};

    		
    		$calle=$cliente->getDireccion();
    		$codPostal=$cliente->getCodPostal();
    		$localidad=$cliente->getLocalidad();
    		$provincia=$cliente->getProvincia();

    		// Si la direccion de envio no fue especificada (optativa) no inserto en la tabla
    		// de direcciones
    		if (($calle=='') || ($localidad=='') ||($provincia=='')) { return true; }
    		
    		try { 

    			$principal=true;

				$stmt = $db -> prepare ("INSERT INTO direccion ".
											" VALUES (default,:id_cliente,:principal,:calle,".
											         ":codigo_postal,:localidad,:provincia)");

				$stmt->bindParam(':id_cliente',$idCliente,PDO::PARAM_INT);
				$stmt->bindParam(':principal',$principal,PDO::PARAM_BOOL);
				$stmt->bindParam(':calle',$calle,PDO::PARAM_STR);
				$stmt->bindParam(':codigo_postal',$codPostal,PDO::PARAM_STR);
				$stmt->bindParam(':localidad',$localidad,PDO::PARAM_STR);
				$stmt->bindParam(':provincia',$provincia,PDO::PARAM_STR);

				$stmt -> execute();

				return true;
			}
			catch(PDOException $e) {
    				return $e->getMessage();  		
    		};
		 
		}


		public function existeElMail($email){
		
			$conn = new DB;
			$db = $conn->getConn();

	    	$sql = "SELECT id FROM cliente ".
	    				" WHERE email='".$email."'"	;

	    	$query=$db->query($sql);

			if ($query->rowCount()>0) {return true;}
			else {return false;}				

		}

		public function traerClientePorEmail($email) {
	    	
	        $conn = new DB;
			$db = $conn->getConn();

	    	$sql="SELECT cli.id,cli.email,cli.password,cli.nombre,cli.apellido, cli.sexo,
	        		     cli.fechanacimiento as fechanac,
	        		     dir.calle as direccion, dir.codigo_postal as codPostal,
	        		     dir.localidad as localidad, 
	        		     dir.provincia as provincia, cli.avatar 
	        		FROM cliente as cli LEFT JOIN direccion as dir 
	        		ON cli.id=dir.id_cliente 
	        		WHERE cli.email='".$email."'".
	        	  " ORDER BY cli.id, principal DESC ";        
	        	  				

	    	$query=$db->query($sql);

			if ($query->rowCount()>0) {
				$clienteArray = $query->fetch(PDO::FETCH_ASSOC);
	    		$cliente = new cliente($clienteArray);	
				return $cliente;
			} else {
				return false;
			}	
	        
	    }

	}



