var rutaOculta;
window.onload = function() {
  rutaOculta = document.getElementById("rutaOculta").value;  
};
function eliminarValor() {
    //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia        
    var id = document.getElementById("idEliminar").value;    
    if (id !== '') {
        if (window.XMLHttpRequest) { // para navegadores IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // para navegadores IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if ((this.readyState === 4 && this.status === 200)) {                                                    
                window.location = rutaOculta+"serviciosadmin/"+this.responseText;
            }
        };
        xmlhttp.open("GET", rutaOculta+"contenido/ajax/ajaxServicio.php?accion=eliminar&id="+id, true);
        xmlhttp.send();
        }
}
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
function crearUrl(cadena) {
    document.getElementById('url').value = normalizar(cadena);
}
var normalizar = (function () {
    var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç",
            to = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
            mapa = {};
    for (var i = 0, j = from.length; i < j; i++)
        mapa[ from.charAt(i) ] = to.charAt(i);
    return function (str) {
        var cadenaFinal = [];
        for (var i = 0, j = str.length; i < j; i++) {
            var c = str.charAt(i);
            if (mapa.hasOwnProperty(str.charAt(i))) {
                cadenaFinal.push(mapa[ c ]);
            } else {
                cadenaFinal.push(c);
            }
        }
        return cadenaFinal.join('').replace(/[^-A-Za-z0-9]+/g, '-').toLowerCase();
    };
})();