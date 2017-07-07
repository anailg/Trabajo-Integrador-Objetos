<?php  

	$cantClientes = $repo->getRepositorioClientes()->contarClientes();
	
	echo "<div  class='usuarios'>			
			<a id='msgCantClientes'>Ya somos ".$cantClientes.
				" clientes virtuales</a> 
		  </div>	"
?>