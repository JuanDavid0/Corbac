// ===========================================================
// Funciones formulario de contacto
// ===========================================================
function enviarContacto() {     
        var nombre = document.getElementById("nombreContacto").value;
        var telefono = document.getElementById("numeroContacto").value;
        var email = document.getElementById("emailContacto").value;
        var texto = document.getElementById("textoContacto").value;            
        //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
        if (window.XMLHttpRequest) { // para navegadores IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // para navegadores IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if ((this.readyState === 4 && this.status === 200)) {
                //mostrar resultados en esta capa            
                LimpiarCamposForm();                        
                document.getElementById('openModal').classList.remove('invisible');    
                document.getElementById('openModal').style.opacity = 1;          
            }
        };
        xmlhttp.open("GET", "https://anbu.com.co/contenido/funciones/enviar_contacto.php?nombre="+nombre+"&telefono="+telefono+"&email="+email+"&texto="+texto, true);        
        //enviando los valores a registro.php para que inserte los datos
        xmlhttp.send();            
}
function LimpiarCamposForm() {            
    var fContac = document.getElementById("formulario-3-form-formulario");
    if(fContac !== null){
     document.getElementById("formulario-3-form-formulario").reset();       
    }        
}
function  cerrarModal() {
    document.getElementById('openModal').style.opacity = 0;                
    document.getElementById('openModal').classList.add('invisible');    
}