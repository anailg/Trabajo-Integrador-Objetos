<?php

	abstract Class Repositorio {
		
		protected $repositorioClientes;

		public function getRepositorioClientes() {
			return $this->repositorioClientes;
		}
	}