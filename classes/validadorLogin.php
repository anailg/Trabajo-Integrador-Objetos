<?php
	require_once("validador.php");
	require_once("repositorio.php");
	
	class ValidadorLogin extends Validador {

		public function Validar(Array $datos, Repositorio $repo) {

			$repoClientes = $repo->getRepositorioClientes();

			$errores = [];

	        if (empty(trim($datos["email"])))
	        {
	            $errores["email"] = "Por favor ingrese mail";
	        }
	        if (empty(trim($datos["password"])))
	        {
	            $errores["password"] = "Por favor ingrese password";
	        }
	        if (!$repoClientes->existeElMail($datos["email"]))
	        {
	            $errores["email"] = "El cliente no existe";
	        }
	        else {
	            $cliente = $repoClientes->traerClientePorEmail($datos["email"]);

	            if (!password_verify($datos["password"], $cliente->getPassword())) {
	                $errores["password"] ="La contraseña es incorrecta";
	            }
	        }

	        return $errores;
		}
	}