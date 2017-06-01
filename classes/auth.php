<?php 
	require_once("cliente.php");
	require_once("repositorioClientes.php");
	
	class Auth {

		public static $instancia;

		public static function getInstancia(RepositorioClientes $repoClientes) {
			if (self::$instancia == null) {
				self::$instancia = new Auth();
				self::$instancia->autologuear($repoClientes);
			}

			return self::$instancia;
		}

		private function __construct() {

		}

		public function loguear(Cliente $cliente) {
        	$_SESSION["clienteLogueado"] = $cliente->getEmail();
        	$_SESSION["nombreClienteLogueado"] = $cliente->getNombre();
    	}

    	public function traerclienteLogueado(RepositorioClientes $repo) {

	        if (!$this->estaLogueado()) {
	            return null;
	        }
	        $mailLogueado = $_SESSION["clienteLogueado"];
	        return $repo->traerClientePorEmail($mailLogueado);
	    }

	    public function estaLogueado() {
	        return isset($_SESSION["clienteLogueado"]);
	    }

	    public function nombreClienteLogueado() {

	        if (isset($_SESSION["nombreClienteLogueado"]))
	        	 { $nombre=$_SESSION["nombreClienteLogueado"];}
	        else { $nombre=""; }
	               
	        return $nombre;
	    }


	    public function guardarCookie(Cliente $cliente) {
	        setcookie("clienteLogueado", $cliente->getEmail(), time() + 3600 * 24);
	        setcookie("nombreClienteLogueado", $cliente->getNombre(), time() + 3600 * 24);
	    }

	    private function autologuear(RepositorioClientes $repo) {

	        session_start();

	        if (!$this->estaLogueado()) {

	            if (isset($_COOKIE["clienteLogueado"])) {

	                $cliente = $repo->traerclientePorEmail($_COOKIE["clienteLogueado"]);

	                $this->loguear($cliente);
	            }
	        }
    	}

    	 public function logout()
		  {
		      $_SESSION=array(); //Ver si hace falta

		      session_destroy();

		      $this->unsetCookie("clienteLogueado");
		      $this->unsetCookie("nombreClienteLogueado");
		  }

		  private function unsetCookie($nombreCookie)
		  {
		      setcookie($nombreCookie, "", -1);
		  }
	}
?>