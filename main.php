<?php
	require_once("soporte.php");
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Cooking Company</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins">
	<link rel="stylesheet" type="text/css" href="css/extractoBootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel='stylesheet' type='text/css' id='paleta' class='paleta1' href='css/paletaColores1.css'>

</head>

<body>
	<div class="container">

		<?php
			include "mostrarCantClientes.php";
			include "header.php";
		?>	
		
		<div class="banner">				
			<img src="images/imagenBanner1.jpg" alt="foto">	
			<img src="images/imagenBanner2.jpg" alt="foto">				
			<img src="images/imagenBanner3.jpg" alt="foto">	
			<img src="images/imagenBanner4.jpg" alt="foto">
		</div>


		<div class="frases">
			<div class="frase1">	
				<div class="texto">
					<h1>date un gusto</h1>
					<h3>Tentate con nuestras tortas caseras hechas con ingredientes de la mejor calidad</h3>
				</div>
				<img src="images/TortaMousseChocolate.jpg" alt="foto">
				
			</div>

			<div class="frase2">
				<div class="texto">
					<h1>recibí con dulzura</h1>
					<h3>Tenes visitas? Quedá como una reina sin trabajar! Además de tortas, tenemos bandejas de cuadraditos dulces, alfajores, postres en vasito y más</h3>
				</div>
				<img src="images/imagen1.jpg" alt="foto">			
			</div>
		
			<div class="frase3">
				<div class="texto">
					<h1>ponele color a tu festejo</h1>
					<h3>Es el cumpleanos de tu hijo? Tenemos la torta que quiere</h3>
				</div>
				<img src="images/rainbow.jpg" alt="foto">
				
			</div>
			
		</div>			

		<section class="main-promo">
			<article class="promotion" id="promo1">
				<h2>Promoción de la semana</h2>
				<img src="images/img-promo3.jpg" alt="foto" id="foto1">
				<p>Aprovechá la temporada de frutillas!!!
				   Tarta de frutillas: base sable cubierta de dulce de leche, crema y frutillas</p>				
			</article>
			<article class="promotion" id="promo2">
				<h2>La foto del día</h2>
				<img src="images/fotoDeldia.jpg" alt="foto">				
				<p>Algo de lo que hicimos para hoy!</p>
				<p>#marquise #lemonpie #tartadefrutilla #rogeles #postreenvasitos #bandejaminis #instacake #lovebaking</p>
			</article>
			<article class="promotion" id="promo3">
				<h2>Novedad</h2>
				<img src="images/img-promo1.jpg" alt="foto">
				<p>Torta de Chocolate blanco: con chocolate Toblerone !</p>
			</article>
			<article class="promotion" id="promo4">
				<h2>Destacado del mes</h2>
				<img src="images/img-promo4.jpg" alt="foto">
				<p>La vedette del mes fué el cheesecake con frutos rojos. Probalo! </p>
			</article>			
		</section>

		<?php
			include "footer.php";
		?>

		<script src="js/actualizarCantClientes.js"></script>
		
	</div>	

</body>

</html>

