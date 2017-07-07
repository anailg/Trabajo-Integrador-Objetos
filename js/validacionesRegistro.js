;(function (window, document, undefined) {

  
	window.onload = function () {

		  var formulario=document.forms[0];	    

	    formulario.addEventListener('submit', function (evento) {

        evento.preventDefault(); 

        var erroresJS = validar(formulario);

        if(Object.keys(erroresJS).length === 0){
          //empezamos server side
          validacionesServer(formulario);
        } else {
          //tiene errores en Javascript
          muestraErrores(erroresJS)
        }

	    }) // --- Fin addEventListener('submit'.....

	} // -- Fin window.onload


  //------------ VALIDACIONES ------------------------//

  function validar(formulario){

      var errores = {};

      var campo=formulario.nombre;          
      if (!campo.value) { 
          errores.nombre = "El nombre es requerido";
      } 

      var campo=formulario.apellido;
      if (!campo.value) { 
          errores.apellido = "El apellido es requerido";
      }

      var campo=formulario.email;      
      if (!campo.value) {
          errores.email = "El email es requerido";
      } else {
          if (!(validarEmail(campo))) { 
              errores.email = 'El email ingresado no es válido';
          }
      }

      var campo=formulario.password;
      var campo2=formulario.password2;          
      if (!campo.value || !campo2.value ) { 
          errores.password='Es necesario ingresar una contraseña y confirmarla'; 
      } else {
          if ((campo.value.length<6) || (campo.value.length>20)) {
              errores.password='La contraseña debe tener al menos 6 caracteres y no mas de 20';
          } else {
              if (campo.value !== campo2.value) {
                  errores.password='Las contraseñas no coinciden';
              }
          }
      }

      var campo=formulario.sexo;          
      if (!campo.value) { 
          errores.nombre = "El campo sexo es requerido";
      }

      
      return errores;
}

function validarEmail(campo) {
    var x = campo.value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {                
        return false;
    }
    return true;
}

//------------  FIN VALIDACIONES ---------------------------//

function validacionesServer(formulario){

    var req = new XMLHttpRequest()

    req.onreadystatechange = function () {
      
      if (this.readyState === 4) {

          console.log('Status: '+this.status)

          if (this.status === 200) {
            console.log("no hay errores backend") 
            
            var respuesta = JSON.parse(this.responseText)
            //console.log('Respuesta: '+respuesta)
            window.location.href = respuesta.redirect_to            
            
          } else {
            // mostramos errores 
            console.log("hay errores backend")
            
            var errors = JSON.parse(this.responseText)             
            //console.log('Errors: '+errors)

            muestraErrores(errors)

          } 
      }
    }

    req.open(formulario.method, formulario.action)
    req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    var data = new FormData(formulario)
    req.send(data)
}


function muestraErrores(errors){

  var campos = Array.from(document.querySelectorAll('.input-field'))               

  campos.forEach(function (campo) {
        var padre= campo.parentNode;                  
        if (errors.hasOwnProperty(campo.name)) {
            setearSpan(padre,errors[campo.name])
        } else {
            limpiarSpan(padre)
        } 
  })
}

    // -------------- Funciones usadas para las validaciones JS -----//

      function setearSpan(padre,texto) {

        var span = padre.querySelector('.help-block');
        
          if (!span){ 
              // Si no hay un elemento span para este campo  lo creo
              span = document.createElement('span');
              span.className='help-block';
              padre.append(span); 
          } 

          span.innerHTML=texto;         
                
          padre.className=addClassName(padre.className,'has-error') 

      }

      function limpiarSpan(padre) {

          var span = padre.querySelector('.help-block')

          if (!!(span)) {span.innerHTML=''} 

          padre.className=removeClassName(padre.className,'has-error')

      }
        
        function addClassName (className, newClass) {
          return className.split(' ')
            .filter(function (item) {
              return item !== newClass
            }).join(' ') + ' ' + newClass
        }

        function removeClassName (className, removeClass) {
          return className.split(' ')
            .filter(function (item) {
              return item !== removeClass
            }).join(' ')
        }

//----------------------------------------------------------------------------//


}(window, document));








	       
 


        


        
    	