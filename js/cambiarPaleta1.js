;(function (window, document, undefined) {
			function cambiarPaleta() {
				
			    var elemento = document.getElementById("paleta");
			    if (elemento.className == "paleta1") {
			      	elemento.className = "paleta2";
			      	elemento.href="css/paletaColores2.css"
			    } else {
			      	elemento.className = "paleta1";
			      	elemento.href="css/paletaColores1.css"
				}
			}
}(window, document));
