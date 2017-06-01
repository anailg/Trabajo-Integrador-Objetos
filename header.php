
	<header class="main-header" >				
		
		<img src="images/logo.jpg" alt="logotipo" class="logo">					
		
		<div class="main-nav">

		
			<div class="main-login">  <!-- Abre Menu Registro/Login Principal-->
		      <ul class="bar-login">
		      	  <?php if(!$auth->estaLogueado()): ?>		      	  	
		              <li><a href="login.php">Ingresar</a></li>              
		          <?php endif; ?>
		          <?php if($auth->estaLogueado()): ?>
		              <li><a href="logout.php">Cerrar Sesion</a></li>
		          <?php endif; ?>	
		          <?php if($auth->estaLogueado())
						{ 	
						// en vez de crear una instancia del repositorio y buscar el nombre del cliente directamente cree otra cookie y saco el nombre de ahi y asi me evito todo esto:
							//$repoClientes = $repo->getRepositorioClientes();
							//$cliente=$auth->traerClienteLogueado($repoClientes);
							//<li>Bienvenido <?php echo $cliente->getNombre(); 
							$cliente=$auth->nombreClienteLogueado();?>  
		                  <li>Bienvenido <?php echo $cliente; ?></li>
		          <?php } ?>  		          	                  
		      </ul>
		    </div>  <!-- Cierra Menu Registro/Login Principal-->

			
			<nav>
				<ul class="bar-nav">
					<li class="icono"><a href="main.php">&#xf015</a></li>
					<li class="descripcion"><a href="#">Productos</a></li>
					<li class="descripcion"><a href="#">Servicios</a></li>
					<li class="descripcion"><a href="#">Nosotros</a></li>
					<li class="descripcion"><a href="#">Contacto</a></li>
					<li class="icono"><a href="faq.php">&#xf128</a></li>				
					<li class="icono"><a href="#">&#xf002</a></li>	
					<li class="icono"><a href="#">&#xf07a</a></li>					
				</ul>
			</nav>

		</div>

	</header>




