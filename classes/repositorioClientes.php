<?php
	require_once("cliente.php");

	abstract class RepositorioClientes {

		abstract public function guardar(Cliente $cliente);
		abstract public function traerTodosLosClientes();

		public function existeElMail($email) {

	        $cliente = $this->traerClientePorEmail($email);

	        if ($cliente) {
	            return true;
	        }

	        return false;
	    }

	    public function traerClientePorEmail($email) {
	    	
	        //1: Me traigo todos los clientes y ya opero con arrays
	        $clientes = $this->traerTodosLosclientes();

	        //2: Los recorro y si alguno es el que busco, devuelvo
	        foreach($clientes as $cliente)
	        {
	            if ($cliente->getEmail() == $email)
	            {
	                return $cliente;
	            }
	        }

	        return false;
	    }

	    public function contarClientes() {
	    	
	       
	        $clientes = $this->traerTodosLosclientes();

	        $cantidad=0;
	        foreach($clientes as $cliente)
	        {
	            $cantidad+=1;	            
	        }

	        return $cantidad;
	    }
	}