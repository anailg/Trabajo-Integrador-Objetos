;(function (window, document, undefined) {

  
	// window.onload = function () {

		//console.log('Actualizar cantidad de clientes')

		//entro=0;

		setInterval(actualizarCartel, 30000);

		function actualizarCartel(){

			//entro=entro+1

			//console.log('Entro a actualizar cartel '+entro)

			var elemento = document.getElementById("msgCantClientes");
		
			var req = new XMLHttpRequest()

	    	req.onreadystatechange = function () {
	      
	      		if (this.readyState === 4 && this.status === 200) {
	      			var respuesta = JSON.parse(this.responseText)
	      			//respuesta.cantClientes=respuesta.cantClientes+entro
	      			elemento.innerText=
                 	"Ya somos "+respuesta.cantClientes+" clientes virtuales"
				}
			}	
			req.open('GET', 'php/cantClientes.controller.php')
	    	req.send()
 
		} 
	// }

}(window, document));

