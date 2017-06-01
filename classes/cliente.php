<?php 

	require_once("repositorioClientes.php");

	class Cliente {

		private $id;
		private $email;
		private $password;
		private $nombre;
		private $apellido;
		private $sexo;
		private $fechanac;
		private $direccion;
		private $codPostal;
		private $localidad;
		private $provincia;
		private $avatar;

		public function __construct($array)
		{
			$this->id = $array["id"];			
			$this->email = $array["email"];
			$this->password = $array["password"];
			$this->nombre =$array["nombre"];
			$this->apellido = $array["apellido"];
			$this->sexo = $array["sexo"];			
			$this->fechanac = $array["fechanac"];
			$this->direccion = $array["direccion"];
			$this->codPostal = $array["codPostal"];
			$this->localidad = $array["localidad"];
			$this->provincia = $array["provincia"];
			$this->avatar = $array["avatar"];
		}

		/*** Getters ***/

		public function getId()
		{
			return $this->id;
		}
		public function getEmail()
		{
			return $this->email;
		}
		public function getPassword()
		{
			return $this->password;
		}

		public function getNombre()
		{
			return $this->nombre;
		}
		
		public function getApellido()
		{
			return $this->apellido;
		}

		public function getSexo()
		{
			return $this->sexo;
		}

		public function getFechaNac()
		{
			return $this->fechanac;
		}

		public function getDireccion()
		{
			return $this->direccion;
		}

		public function getCodPostal()
		{
			return $this->codPostal;
		}

		public function getLocalidad()
		{
			return $this->localidad;
		}

		public function getProvincia()
		{
			return $this->provincia;
		}

		public function getAvatar()
		{
			return $this->avatar;
		}

		/*** Setters ***/

		public function setId($id)
		{
			$this->id = $id;
		}

		public function setEmail($email)
		{
			$this->email = $email;
		}
		public function setPassword($password)
		{
			$this->password = password_hash($password, PASSWORD_DEFAULT);
		}

		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
		}
		
		public function setApellido($apellido)
		{
			$this->apellido  = $apellido ;
		}

		public function setSexo($sexo)
		{
			$this->sexo = $sexo;
		}

		public function setFechaNac($fechanac)
		{
			$this->fechanac = $fechanac;
		}

		public function setDireccion($direccion)
		{
			$this->direccion = $direccion;
		}

		public function setCodPostal($codPostal)
		{
			$this->codPostal = $codPostal;
		}

		public function setLocalidad($localidad)
		{
			$this->localidad = $localidad;
		}

		public function setProvincia($provincia)
		{
			$this->provincia = $provincia;
		}

		public function setAvatar($avatar)
		{
			$this->avatar = $avatar;
		}

		public function guardarAvatar($avatar) {
    
		    if ($avatar['error'] == UPLOAD_ERR_OK) 

		    	{
			    	$origen = $avatar['tmp_name'];

			    	$ext = pathinfo($avatar['name'],PATHINFO_EXTENSION);

			    	$id=uniqid(); //Genero un identificador unico para el nombre

			    	$nombre = $this->getNombre().$id.".".$ext;

			    	$destino = __DIR__ . './data/images/'.$nombre;
			    	
			    	if (!move_uploaded_file($origen, $destino)) 
			    		{
				    		/* Fallo la copia del archivo de imagen => Dar algun WARNING */
				    		//$warning="No se pudo ubicar el avatar en la carpeta destino";
				    		$destino='';
						}
				}

		    else { 	$destino=''; }

		    return $destino;

		}

		/**  Otros metodos **/
		
		public function guardar(RepositorioClientes $repo) {
			return $repo->guardar($this);
		}

		public function toArray() {

			return [
				"id" => $this->getId(),				
				"email" => $this->getEmail(),
				"password" => $this->getPassword(),
				"nombre" => $this->getNombre(),
				"apellido" => $this->getApellido(),
				"sexo" => $this->getSexo(),
				"fechanac" => $this->getfechaNac(),
				"direccion" => $this->getDireccion(),
				"codPostal" => $this->getcodPostal(),
				"localidad" => $this->getLocalidad(),
				"provincia" => $this->getProvincia(),
				"avatar" => $this->getAvatar()
			];
			
		}

}


