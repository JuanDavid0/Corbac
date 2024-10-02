var rutaOculta;
window.onload = function () {
    rutaOculta = document.getElementById("rutaOculta").value;
};
function logUsuario() {
    var nombre = document.getElementById("inputUsuario").value;
    var contrasena = document.getElementById("inputContrasena").value;
    if (window.XMLHttpRequest) { // para navegadores IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // para navegadores IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if ((this.readyState === 4 && this.status === 200)) {
            if (this.responseText === "999") {
                var alerta = document.getElementsByClassName("alerta");
                alerta[0].style.display = "block";
                var alertaTitulo = document.getElementsByClassName("alerta-titulo");
                alertaTitulo[0].innerHTML = "Error de Sesión";
                alertaTitulo[0].classList.add("alerta-error-color1");
                var alertaIcono = document.getElementsByClassName("alerta-icono");
                alertaIcono[0].classList.add("closec");
                alertaIcono[0].classList.add("alerta-error-color1");
                document.getElementById("respuestaLogin").innerHTML = "Usuario y/o Contraseña incorrectas! Por favor intente nuevamente.";
                var alertaBoton = document.getElementsByClassName("alerta-boton");
                alertaBoton[0].classList.add("alerta-error-fondo1");
                LimpiarCamposUsuario();
            } else {
                document.location = this.responseText;
            }
        }
    };
    xmlhttp.open("GET", rutaOculta + "contenido/controlador/controladorLogueo.php?accion=iniciarSesion&usuario=" + nombre + "&contrasena=" + contrasena, true);
    xmlhttp.send();
}
function LimpiarCamposUsuario() {
    document.getElementById("inputUsuario").value = "";
    document.getElementById("inputContrasena").value = "";
}
function ocultarAlerta() {
    var alerta = document.getElementsByClassName("alerta");
    alerta[0].style.display = "none";
}