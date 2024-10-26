var rutaOculta;
window.onload = function () {
    rutaOculta = document.getElementById("rutaOculta").value;
};
function filtrarValor() {
    var texto = document.getElementById('inputFiltroDistribuidor').value;
    //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
    if (window.XMLHttpRequest) { // para navegadores IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // para navegadores IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if ((this.readyState === 4 && this.status === 200)) {
            //mostrar resultados en esta capa                            
            document.getElementById("contenedor-personas-admin").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", rutaOculta + "contenido/ajax/controladorDistribuidor.php?accion=filtrar&texto=" + texto, true);
    //enviando los valores a registro.php para que inserte los datos
    xmlhttp.send();
}
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
                window.location = rutaOculta + "faqadmin/" + this.responseText;
            }
        };
        xmlhttp.open("GET", rutaOculta + "contenido/ajax/ajaxFaq.php?accion=eliminar&id=" + id, true);
        xmlhttp.send();
    }
}
function mostrarAlerta() {
    var alerta = document.getElementsByClassName("alerta");
    alerta[0].style.display = "block";
    var capaalerta = document.getElementById("contenedorRespuesta");
    capaalerta.style.display = "block";
}
function ocultarAlerta() {
    var alerta = document.getElementsByClassName("alerta");
    alerta[0].style.display = "none";
    var capaalerta = document.getElementById("contenedorRespuesta");
    capaalerta.style.display = "none";
}
function ocultarConfirmar(formulario) {
    document.getElementById(formulario).style.display = "none";
    document.getElementById("contenedorRespuesta").style.display = "none";
}
function mostrarConfirmar(formulario, id) {
    var alerta = document.getElementById(formulario);
    alerta.style.display = "block";
    var capaalerta = document.getElementById("contenedorRespuesta");
    capaalerta.style.display = "block";
    document.getElementById("idEliminar").value = id;
}