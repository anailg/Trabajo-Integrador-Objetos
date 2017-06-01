<?php
	require_once("repositorio.php");
	require_once("repositorioClientesJSON.php");

	class RepositorioJSON extends Repositorio {

		public function __construct() {
			$this->repositorioClientes = new RepositorioClientesJSON();
		}

	}