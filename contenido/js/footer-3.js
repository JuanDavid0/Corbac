var contadorM = 0;
function verMapa(){
    var botonMapa = document.getElementById("footer-mapa");
    var ContMapa = document.getElementById("footer-mapa-cont");
    if(contadorM == 0){
        botonMapa.style.bottom = "100%";
        if(window.matchMedia("(max-width: 476px)").matches){
            ContMapa.style.height = "calc(100% - 76.33px)";
        } else if(window.matchMedia("(max-width: 900px)").matches){
            ContMapa.style.height = "calc(100% - 62.75px)";
        } else {
            ContMapa.style.height = "calc(100% - 44.3px)";
        }
        contadorM = 1;
    } else if(contadorM == 1){
        if(window.matchMedia("(max-width: 476px)").matches){
            botonMapa.style.bottom = "76.33px";
        } else if(window.matchMedia("(max-width: 900px)").matches){
            botonMapa.style.bottom = "62.75px";
        } else {
            botonMapa.style.bottom = "44.3px";
        }
        ContMapa.style.height = "0";
        contadorM = 0;
    } 
}