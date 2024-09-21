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
    $galeria->identificador_pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_STRING);
    $galeria->modulo = filter_input(INPUT_POST, 'modulo', FILTER_SANITIZE_STRING);
    $galeria->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $retorno = filter_input(INPUT_POST, 'retorno', FILTER_SANITIZE_STRING);
    $galeria->clase = filter_input(INPUT_POST, 'clase', FILTER_SANITIZE_STRING);
    $galeria->imagen = basename($_FILES['imagen']['name']);
    $galeria->imagen_p = basename($_FILES['imagen']['name']);
    $galeria->alt = basename($_FILES['imagen']['name']);
    $galeria->url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
    $galeria->texto = filter_input(INPUT_POST, 'texto');
    $galeria->texto_s = filter_input(INPUT_POST, 'texto_s', FILTER_SANITIZE_STRING);
    $galeria->orden = filter_input(INPUT_POST, 'orden', FILTER_SANITIZE_STRING);
    $galeria->estado = 'activo';
    $galeria->idioma = 'es';
    $galeria->fecha = $fecha;
    $galeria->video = filter_input(INPUT_POST, 'video');
    foreach ($galeria as $clave => $valor) {
        if ($galeria->$clave == NULL) {
            $galeria->$clave = '';
        }
    }
    if ($galeria->video != NULL || $galeria->video != '') {
        $galeria->imagen = $galeria->video;
    }
    if ($galeria->imagen_p != '') {
        $img_rute = "../assets/" . basename($_FILES['imagen']['name']);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
            $respuesta = ControladorGaleria::crearGaleria($galeria);
            header("Location: " . $rutaFinal . $retorno . '/' . $respuesta);
        } else {
            header("Location: " . $rutaFinal . $retorno . "/2");
        }
    } else {
        header("Location: " . $rutaFinal . $retorno . "/2");
    }
}
if ($accion == "editar") {
    $galeria = new Galeria();
    $galeria->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_NUMBER_INT);
    $galeria->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $retorno = filter_input(INPUT_POST, 'retorno', FILTER_SANITIZE_STRING);
    $galeria->clase = filter_input(INPUT_POST, 'clase', FILTER_SANITIZE_STRING);
    $galeria->imagen = basename($_FILES['imagen']['name']);
    $galeria->imagen_p = basename($_FILES['imagen']['name']);
    $galeria->alt = basename($_FILES['imagen']['name']);
    $galeria->url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
    $galeria->texto = filter_input(INPUT_POST, 'texto');
    $galeria->texto_s = filter_input(INPUT_POST, 'texto_s');
    $galeria->orden = filter_input(INPUT_POST, 'orden', FILTER_SANITIZE_STRING);
    $galeria->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $galeria->idioma = 'es';
    $galeria->fecha = $fecha;
    $galeria->video = filter_input(INPUT_POST, 'video');
    if ($galeria->video != NULL || $galeria->video != '') {
        $galeria->imagen = $galeria->video;
    }
    foreach ($galeria as $clave => $valor) {
        if ($galeria->$clave == NULL) {
            $galeria->$clave = '';
        }
    }
    $galeriaActual = ControladorGaleria::buscarGaleria($galeria);    
    if ($galeriaActual != null) {
        if ($galeria->imagen_p != '') {
            $img_rute = "../assets/" . basename($_FILES['imagen']['name']);
            $img_rute_anterior = "../assets/" . $galeriaActual['imagen_p'];
            unlink($img_rute_anterior);
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
                $galeria->alt_p = basename($_FILES['imagen']['name']);
            }
        } else {
            if ($galeria->video != NULL || $galeria->video != '') {
                $galeria->imagen = $galeria->video;
            } else {
                $galeria->imagen = $galeriaActual['imagen'];
            }
            $galeria->imagen_p = $galeriaActual['imagen_p'];
            $galeria->alt = $galeriaActual['alt'];
        }
        $respuesta = ControladorGaleria::editarGaleria($galeria);
        header("Location: " . $rutaFinal . $retorno . "/" . $respuesta);
    } else {
       header("Location: " . $rutaFinal . $retorno . "/2");
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