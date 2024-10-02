<?php

include '../clases/contenidoModulo.php';
include '../controlador/controladorContenidoModulo.php';
include '../clases/ruta.php';
date_default_timezone_set("America/Bogota");
$rutaFinal = Ruta::retornaRutaAdmin();
$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "editar") {
    $contenido = new ContenidoModulo();
    $contenido->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_STRING);
    $contenido->identificador_pagina = filter_input(INPUT_POST, 'identificador_pagina', FILTER_SANITIZE_STRING);
    $contenido->modulo = filter_input(INPUT_POST, 'modulo', FILTER_SANITIZE_STRING);
    $contenido->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $contenido->subtitulo = filter_input(INPUT_POST, 'subtitulo', FILTER_SANITIZE_STRING);
    $contenido->clase = filter_input(INPUT_POST, 'clase', FILTER_SANITIZE_STRING);
    $contenido->imagen = basename($_FILES['imagen']['name']);
    $contenido->imagen_p = basename($_FILES['imagen']['name']);
    $contenido->alt = basename($_FILES['imagen']['name']);
    $contenido->url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_STRING);
    $contenido->texto = filter_input(INPUT_POST, 'texto');
    $contenido->texto_s = filter_input(INPUT_POST, 'texto_s');    
    $contenido->texto_boton = filter_input(INPUT_POST, 'texto_boton', FILTER_SANITIZE_STRING);
    $contenido->ciudad = filter_input(INPUT_POST, 'ciudad', FILTER_SANITIZE_STRING);
    $contenido->video = filter_input(INPUT_POST, 'video');
    $contenido->orden = filter_input(INPUT_POST, 'orden', FILTER_SANITIZE_STRING);
    $contenido->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $contenido->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
    $contenido->fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
    $contenido->tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
    $retorno = filter_input(INPUT_POST, 'retorno', FILTER_SANITIZE_STRING);
    $contenido->imagen = basename($_FILES['imagen']['name']);
    $contenidoActual = ControladorContenidoModulo::buscarContenido($contenido);
    if ($contenidoActual != null) {
        if ($contenido->imagen != '') {
            $img_rute = "../assets/" . basename($_FILES['imagen']['name']);
            $img_rute_anterior = "../assets/" . $contenidoActual['imagen_p'];
            unlink($img_rute_anterior);
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
                
            }
        } else {
            $contenido->imagen = $contenidoActual['imagen'];
        }
        $respuesta = ControladorContenidoModulo::editarContenido($contenido);
        header("Location: " . $rutaFinal . $retorno . '/' . $contenido->identificador_pagina . '---' . $respuesta);
    } else {
        $respuesta = 2;
        header("Location: " . $rutaFinal . $retorno . '/' . $contenido->identificador_pagina . '---' . $respuesta);
    }
}
$accionGet = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_STRING);
if ($accionGet == "eliminar") {
    $contenido = new ContenidoModulo();
    $contenido->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $contenidoActual = ControladorContenidoModulo::buscarContenido($contenido);
    if ($contenidoActual != null) {
        unlink("../assets/" . $contenidoActual['imagen']);
        unlink("../assets/" . $contenidoActual['imagen_p']);
    }
    echo ControladorContenidoModulo::eliminarContenido($contenido);
}