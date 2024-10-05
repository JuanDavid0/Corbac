<?php
include '../clases/servicio.php';
include '../controlador/controladorServicio.php';
include '../clases/ruta.php';
$rutaFinal = Ruta::retornaRutaAdmin();
$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "crear") {
    $servicio = new Servicio();    
    $servicio->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);  
    $servicio->subtitulo = filter_input(INPUT_POST, 'subtitulo', FILTER_SANITIZE_STRING);
    $servicio->ciudad = filter_input(INPUT_POST, 'ciudad', FILTER_SANITIZE_STRING);    
    $servicio->descripcion_corta = filter_input(INPUT_POST, 'descripcion_corta', FILTER_SANITIZE_STRING);
    $servicio->descripcion_larga = filter_input(INPUT_POST, 'descripcion_larga');            
    $servicio->imagen = basename($_FILES['imagen']['name']);    
    $servicio->icono = filter_input(INPUT_POST, 'icono', FILTER_SANITIZE_STRING);
    $servicio->video = filter_input(INPUT_POST, 'video');
    $servicio->url_amigable = filter_input(INPUT_POST, 'url_amigable', FILTER_SANITIZE_STRING);
    $servicio->texto_boton = filter_input(INPUT_POST, 'texto_boton', FILTER_SANITIZE_STRING);    
    $servicio->enlace = filter_input(INPUT_POST, 'enlace', FILTER_SANITIZE_STRING);
    $servicio->nivel = filter_input(INPUT_POST, 'nivel', FILTER_SANITIZE_STRING);
    $servicio->categoria_pagina = filter_input(INPUT_POST, 'categoria_pagina', FILTER_SANITIZE_STRING);    
    $servicio->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
    $servicio->estado = 'activo';
    if ($servicio->imagen != '') {
        $img_rute = "../assets/".basename($_FILES['imagen']['name']);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {           
                $respuesta = ControladorServicio::crearServicio($servicio);
                header("Location: " . $rutaFinal . "serviciosadmin/" . $respuesta);
            } else {
                header("Location: " . $rutaFinal . "serviciosadmin/2");
            }        
    } else {
        header("Location: " . $rutaFinal . "serviciosadmin/2");
    }
}
if ($accion == "editar") {
    $servicio->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_STRING);  
    $servicio->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);  
    $servicio->subtitulo = filter_input(INPUT_POST, 'subtitulo', FILTER_SANITIZE_STRING);
    $servicio->ciudad = filter_input(INPUT_POST, 'ciudad', FILTER_SANITIZE_STRING);    
    $servicio->descripcion_corta = filter_input(INPUT_POST, 'descripcion_corta', FILTER_SANITIZE_STRING);
    $servicio->descripcion_larga = filter_input(INPUT_POST, 'descripcion_larga');            
    $servicio->imagen = basename($_FILES['imagen']['name']);    
    $servicio->icono = filter_input(INPUT_POST, 'icono', FILTER_SANITIZE_STRING);
    $servicio->video = filter_input(INPUT_POST, 'video');
    $servicio->url_amigable = filter_input(INPUT_POST, 'url_amigable', FILTER_SANITIZE_STRING);
    $servicio->texto_boton = filter_input(INPUT_POST, 'texto_boton', FILTER_SANITIZE_STRING);    
    $servicio->enlace = filter_input(INPUT_POST, 'enlace', FILTER_SANITIZE_STRING);
    $servicio->nivel = filter_input(INPUT_POST, 'nivel', FILTER_SANITIZE_STRING);
    $servicio->categoria_pagina = filter_input(INPUT_POST, 'categoria_pagina', FILTER_SANITIZE_STRING);    
    $servicio->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
    $servicio->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $servicioActual = ControladorServicio::buscarServicio($servicio);
    if ($servicioActual != null) {        
        if ($servicio->imagen != '') {
            $img_rute = "../assets/" . basename($_FILES['imagen']['name']);
            $img_rute_anterior = "../assets/" . $servicioActual['imagen'];
            unlink($img_rute_anterior);
            if (move_uploaded_file($_FILES['imagen_p']['tmp_name'], $img_rute)) {
                $respuesta = ControladorServicio::editarServicio($servicio);
                header("Location: " . $rutaFinal . "serviciosadmin/".$respuesta);
            }
        }else{
            $servicio->imagen = $servicioActual['imagen'];
        }
        $respuesta = ControladorServicio::editarServicio($servicio);
        header("Location: " . $rutaFinal . "serviciosadmin/".$respuesta);
    } else {
        header("Location: " . $rutaFinal . "serviciosadmin/2");
    }
}
$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "eliminar") {
    $servicio = new Servicio();
    $servicio->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $servicioActual = ControladorServicio::buscarServicio($servicio);
    if ($servicioActual != null) {
            unlink("../assets/" . $servicioActual['imagen']);                   
    }   
    echo ControladorServicio::eliminarServicio($servicio);           
}