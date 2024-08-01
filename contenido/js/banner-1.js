// Esta función sirve para alinear la información en el banner según la disposición de la base de datos
function alinearTexto(n){
    if(window.innerWidth >= 700){
        if(informacion[n].id === "disposicionTextoBaner0")
            disposicion = "moverITexto";
        else if (informacion[n].id === "disposicionTextoBaner1")
            disposicion = "moverCTexto";
        else if (informacion[n].id === "disposicionTextoBaner2")
            disposicion = "moverDTexto";
    } else {
        disposicion = "moverITexto";
    }
}

// Esta función se carga al iniciar el banner, colocando los bullets según el número de banners y ordena el primer campo de información en el banner
function iniciar() {
    bannerIndex = 0;
    banners = document.getElementsByClassName("slideBanner");
    informacion = document.getElementsByClassName("informacionBanner");
    alinearTexto(bannerIndex);
    for (let i = 0; i < banners.length; i++) {
        document.write("<span class=\"bullet\" onclick=\"mover(" + i + ")\"></span>");
    }
    botones = document.getElementsByClassName("bullet");
    banners[bannerIndex].style.opacity = 1;
    banners[bannerIndex].style.left = 0;
    botones[bannerIndex].classList.add("botonactivoBanner");
    informacion[bannerIndex].classList.add(disposicion);
    autoplay();
}

// Función para detectar el clic en los botones laterales del banner
function bannerClick(n) { mover(bannerIndex + n); }

// Función para comprobar y mover el banner en la dirección que corresponda
function mover(n) {
    let actual, siguiente;
    let animacionMoverBanner = { actual: "", siguiente: "" };
    if (n > bannerIndex) {
        if (n >= banners.length) { n = 0; }
        animacionMoverBanner.actual = "moverIActualBanner";
        animacionMoverBanner.siguiente = "moverISiguienteBanner";
    } else if (n < bannerIndex) {
        if (n < 0) { n = banners.length - 1; }
        animacionMoverBanner.actual = "moverDActualBanner";
        animacionMoverBanner.siguiente = "moverDSiguienteBanner";
    }
    if (n !== bannerIndex) {
        siguiente = banners[n];
        actual = banners[bannerIndex];
        for (let i = 0; i < banners.length; i++) {
            banners[i].className = "slideBanner";
            botones[i].classList.remove("botonactivoBanner");
            informacion[i].classList.remove("moverDTexto", "moverITexto", "moverCTexto");
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

// Función para mover el banner automáticamente
function autoplay() {
    intervalo = setInterval(function () {
        bannerClick(1);
    }, 5000);
}
