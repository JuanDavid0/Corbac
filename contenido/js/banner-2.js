// ================================================================
// ================================================================
// Esta funcion sirve para alinear la informacion en el banner segun la disposicion de base de datos
function alinearTexto(n){
    if(window.innerWidth >= 700){
    if(informacion[n].id ===  "disposicionTextoBaner0")
        disposicion = "moverITexto";
    else if (informacion[n].id === "disposicionTextoBaner1")
        disposicion = "moverCTexto";
    else if (informacion[n].id === "disposicionTextoBaner2")
        disposicion = "moverDTexto";
}else{
    disposicion = "moverITexto";
}
}
// Esta funcion se carga al iniciar el banner colocando los bullets segun numero de banners y ordena el primer campo de informacion en el banner
function iniciar2() {
    bannerIndex = 0;
    banners = document.getElementsByClassName("slideBanner");
    informacion = document.getElementsByClassName("informacionBanner");  
    alinearTexto(bannerIndex);    
    botones = document.getElementsByClassName("bullet");
    banners[bannerIndex].style.opacity = 1;
    banners[bannerIndex].style.left = 0;
    botones[bannerIndex].classList.add("botonactivoBanner");
    informacion[bannerIndex].classList.add(disposicion);
    autoplay();
}
// funcion para detectar el clic en los botones laterales del banner
function bannerClick(n) { mover(bannerIndex + n);}
// Funcion para comprobar y mover el banner en la direccion que corresponda
function mover(n) {    
    var actual, siguiente;
    var animacionMoverBanner = { actual: "", siguiente: ""};
    if (n > bannerIndex) { if (n >= banners.length) {n = 0;}
        animacionMoverBanner.actual = "moverIActualBanner";
        animacionMoverBanner.siguiente = "moverISiguienteBanner";
    } else if (n < bannerIndex) { if (n < 0){(n = banners.length - 1);}
        animacionMoverBanner.actual = "moverDActualBanner";
        animacionMoverBanner.siguiente = "moverDSiguienteBanner";
    }
    if (n !== bannerIndex) {
        siguiente = banners[n];
        actual = banners[bannerIndex];
        for (i = 0; i < banners.length; i++) {
            banners[i].className = "slideBanner";
            botones[i].classList.remove("botonactivoBanner");
            informacion[i].classList.remove("moverDTexto");
            informacion[i].classList.remove("moverITexto");
            informacion[i].classList.remove("moverCTexto");
        }
        alinearTexto(n);
        actual.classList.add(animacionMoverBanner.actual);
        siguiente.classList.add(animacionMoverBanner.siguiente);
        botones[n].classList.add("botonactivoBanner");
        informacion[n].classList.add(disposicion);
        bannerIndex = n;
    }
    clearInterval(intervalo);
    autoplay();
}
// Funcion para mover el banner automaticamente
function autoplay() {    
    intervalo = setInterval(function () {
        bannerClick(1);
    }, 5000);
}