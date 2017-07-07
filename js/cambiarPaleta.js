;(function (window, document, undefined) {

	function cambiarPaleta() {
		var paletaActual=checkpaleta()
	    var elemento = document.getElementById("paleta");
	    if (paletaActual == "paleta1") {
	      	elemento.className = "paleta2";
	      	elemento.href="css/paletaColores2.css"
	      	setCookie("paleta", paleta2, 1);	      	
	    } else {
	      	elemento.className = "paleta1";
	      	elemento.href="css/paletaColores1.css"
	      	setCookie("paleta", paleta1, 1);
		}
	}

	function setearPaleta() {
		var paletaActual=checkpaleta()
	    var elemento = document.getElementById("paleta");
	    if (paletaActual == "paleta1") {
	      	elemento.href="css/paletaColores1.css"   	
	    } else {
	      	elemento.href="css/paletaColores2.css"
		}
	}
	
	function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function checkPaleta() {
    	
        var paleta = getCookie("paleta");
        if (paleta = "") {
            paleta = "paleta1" ;
            setCookie("paleta", paleta, 1);
            }
        }
        return paleta
    }

	
}(window, document));