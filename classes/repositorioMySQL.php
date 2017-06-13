<?php
	require_once("repositorio.php");
	require_once("repositorioClientesMySQL.php");

	class RepositorioMySQL extends Repositorio {

		public function __construct() {
			$this->repositorioClientes = new RepositorioClientesMySQL();
		}

	}