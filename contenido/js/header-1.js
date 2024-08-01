// Funcion general para menu responsive, busqueda y filtros
function mostrar_menu(tipo){
    var menumob = document.getElementById("menumob-"+tipo);
    var menumobf = document.getElementById("menumob-fondo-"+tipo);
    var menumobo = document.getElementById("menumob-opciones-"+tipo);
    menumob.style.left = '0';
    menumobf.style.left = '0';
    menumobf.style.opacity = '1';
    menumobo.style.left = '0';
}
//Ocultar
function ocultar_menu(tipo){
    var menumob = document.getElementById("menumob-"+tipo);
    var menumobf = document.getElementById("menumob-fondo-"+tipo);
    var menumobo = document.getElementById("menumob-opciones-"+tipo);
    setTimeout(function(){
        menumob.style.left = '-100%';
        menumobf.style.left = '-100%';
    }, 500);
    menumobf.style.opacity = '0';
    menumobo.style.left = '-100%';
}
// // Función scroll header
window.onscroll = function () {
    ScrollHeader();
};
// Funcion para realizar transiciones header scroll
function ScrollHeader() {
        var header = document.getElementById("header");
        var nav = document.getElementById("nav");
        if (document.body.scrollTop > 480 || document.documentElement.scrollTop > 480) {
            header.classList.add("header-sc");
            nav.classList.add("nav-scroll");
        } else {
            header.classList.remove("header-sc");
            nav.classList.remove("nav-scroll");
        }
   
}
function MostrarInfo(numCaja){
    var contenedor = document.getElementsByClassName("submenum");
    var fontSize = contenedor[numCaja].clientHeight;
    if(fontSize != 0){
        contenedor[numCaja].style.height = "0px";
        contenedor[numCaja].style.marginTop = "0px";
    } else if(fontSize == 0){
        contenedor[numCaja].style.height = "auto";
        contenedor[numCaja].style.marginTop = "10px";
    }
}