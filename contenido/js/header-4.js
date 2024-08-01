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