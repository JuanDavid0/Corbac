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