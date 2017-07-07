;(function (window, document, undefined) {

  // window.onload = function () {

    var carrusel = document.querySelector('#carrusel')
    var container = document.querySelector('#carrusel > .banner')
    
    var imageCount=5;
    
    var pos = 0
    carrusel.onclick = function (e) {
  
      if (e.clientX - carrusel.clientWidth / 2 > 0) {
        pos-=carrusel.clientWidth
        console.log(pos)
        if (pos<=-(carrusel.clientWidth*imageCount)) { pos +=(carrusel.clientWidth*imageCount)}
        container.style.transform = 'translate(' + pos + 'px)'
      } else {
        pos+=carrusel.clientWidth
        console.log(pos)
        if (pos>=0) { pos -=(carrusel.clientWidth*imageCount)}
        container.style.transform = 'translate(' + pos + 'px)'
      }
    }

    

  // }

}(window, document));
