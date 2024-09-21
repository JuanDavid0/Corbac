var rutaOculta;
window.onload = function() {
  rutaOculta = document.getElementById("rutaOculta").value;  
};
function mostrarAlerta(){
    var alerta = document.getElementsByClassName("alerta");
    alerta[0].style.display = "block";
    var capaalerta = document.getElementById("contenedorRespuesta");
    capaalerta.style.display = "block";
}
function ocultarAlerta(){
    var alerta = document.getElementsByClassName("alerta");
    alerta[0].style.display = "none";
    var capaalerta = document.getElementById("contenedorRespuesta");
    capaalerta.style.display = "none";
}
function ocultarConfirmar(formulario){
    document.getElementById(formulario).style.display = "none";
    document.getElementById("contenedorRespuesta").style.display = "none";   
}
function mostrarConfirmar(formulario,id) {
    var alerta = document.getElementById(formulario);
    alerta.style.display = "block";
    var capaalerta = document.getElementById("contenedorRespuesta");
    capaalerta.style.display = "block";
    document.getElementById("idEliminar").value = id;    
}