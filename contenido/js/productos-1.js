var i, imgIndex = 0, imagenes;
function galeryClick(n, id) {
    mover(imgIndex + n, id);
}
function mover(n, id) {
    var actual, siguiente;
    imagenes = document.getElementsByClassName("slide-" + id);
    if (imagenes.length > 1) {        
        imagenes[0].style.left = "-100%";
        var animacionMoverBanner = {actual: "", siguiente: ""};
        if (n > imgIndex) {
            if (n >= imagenes.length) { n = 0; }
            animacionMoverBanner.actual = "moverIActualImg";
            animacionMoverBanner.siguiente = "moverISiguienteImg";
        } else if (n < imgIndex) {
            if (n < 0) { (n = imagenes.length - 1);}
            animacionMoverBanner.actual = "moverDActualImg";
            animacionMoverBanner.siguiente = "moverDSiguienteImg";
        }
        if (n !== imgIndex) {
            siguiente = imagenes[n];
            actual = imagenes[imgIndex];
            for (i = 0; i < imagenes.length; i++) {imagenes[i].className = "producto-1-conte slide-" + id; }
            actual.classList.add(animacionMoverBanner.actual);
            siguiente.classList.add(animacionMoverBanner.siguiente);
            imgIndex = n;
        }
    }
}