<?php

include '../clases/galeria.php';
include '../controlador/controladorGaleria.php';
include '../clases/ruta.php';
date_default_timezone_set("America/Bogota");
$fehcaServidor = getdate(time());
$fecha = "" . $fehcaServidor['year'] . "-" . $fehcaServidor['mon'] . "-" . $fehcaServidor['mday'];
$rutaFinal = Ruta::retornaRutaAdmin();
$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "crear") {
    $galeria = new Galeria();
    $galeria->servicio_url_amigable = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_STRING);    
    $galeria->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $galeria->texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING);
    $retorno = filter_input(INPUT_POST, 'retorno', FILTER_SANITIZE_STRING);    
    $galeria->imagen = basename($_FILES['imagen']['name']);                   
    $galeria->estado = 'activo';        
    $galeria->video = filter_input(INPUT_POST, 'video');
    if ($galeria->imagen != '') {
        $img_rute = "../assets/" . basename($_FILES['imagen']['name']);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
            $respuesta = ControladorGaleria::crearGaleria($galeria);
         
            header("Location: " . $rutaFinal.$retorno );
        } else {
            header("Location: " . $rutaFinal.$retorno);
        }
    } else {
        header("Location: " . $rutaFinal.$retorno);
    }
}
if ($accion == "editar") {
    $galeria = new Galeria();
    $galeria->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_STRING);    
    $galeria->servicio_url_amigable = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_STRING);    
    $galeria->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $galeria->texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING);
    $retorno = filter_input(INPUT_POST, 'retorno', FILTER_SANITIZE_STRING);    
    $galeria->imagen = basename($_FILES['imagen']['name']);                   
    $galeria->estado = 'activo';        
    $galeria->video = filter_input(INPUT_POST, 'video');
    $galeriaActual = ControladorGaleria::buscarGaleria($galeria);
    if ($galeriaActual != null) {
        if ($galeria->imagen != '') {
            $img_rute = "../assets/" . basename($_FILES['imagen']['name']);
            $img_rute_anterior = "../assets/" . $galeriaActual['imagen_p'];
            unlink($img_rute_anterior);
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {                
            }
        } else {
            $galeria->imagen = $galeriaActual['imagen'];            
        }
        $respuesta = ControladorGaleria::editarGaleria($galeria);
        echo $respuesta;
        header("Location: " . $rutaFinal . $retorno);
    } else {
       header("Location: " . $rutaFinal . $retorno);
    }
}
$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "eliminar") {
    $galeria = new Galeria();
    $galeria->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $galeriaActual = ControladorGaleria::buscarGaleria($galeria);
    if ($galeriaActual != null) {
        unlink("../assets/".$galeriaActual['imagen']);
        unlink("../assets/".$galeriaActual['imagen_p']);
    }
    echo ControladorGaleria::eliminarGaleria($galeria);
}