<?php

include '../clases/oferta.php';
include '../controlador/controladorOferta.php';
include '../clases/ruta.php';

$rutaFinalAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

date_default_timezone_set("America/Bogota");

$rutaFinal = Ruta::retornaRutaAdmin();

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "crearA") {
    $oferta = new oferta();
    $oferta->url_amigable = filter_input(INPUT_POST, 'url_amigable', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->imagen_p = basename($_FILES['imagen_p']['name']);
    $oferta->oferta_padre = null;
    $oferta->fecha = date('Y-m-d');
    $oferta->idioma = 'es';
    $oferta->estado = 'activo';

    if (!empty($oferta->imagen_p)) {
        $img_rute_p = $rutaFinalAssets . $oferta->imagen_p;
        move_uploaded_file($_FILES['imagen_p']['tmp_name'], $img_rute_p);
    }

    $respuesta = ControladorOferta::crearOfertaAcademica($oferta);

    if ($respuesta == 1) {
        header("Location: " . $rutaFinal . "ofertaacademicaadmin/1");
    } else {
        header("Location: " . $rutaFinal . "ofertaacademicaadmin/2");
    }
}

if ($accion == "editarA") {
    $oferta = new oferta();
    $oferta->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ofertaActual = ControladorOferta::buscarOferta($oferta);

    if ($ofertaActual != null) {
        $oferta->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->url_amigable = filter_input(INPUT_POST, 'url_amigable', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->oferta_padre = null;
        $oferta->fecha = date('Y-m-d') ?: $ofertaActual['fecha'];
        $oferta->idioma = 'es';
        $oferta->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!empty($_FILES['imagen_p']['name'])) {
            $oferta->imagen_p = basename($_FILES['imagen_p']['name']);
            $img_rute_p = $rutaFinalAssets . $oferta->imagen_p;
            $img_rute_anterior_p = $rutaFinalAssets . $ofertaActual['imagen_p'];
            unlink($img_rute_anterior_p);
            move_uploaded_file($_FILES['imagen_p']['tmp_name'], $img_rute_p);
        } else {
            $oferta->imagen_p = $ofertaActual['imagen_p'];
        }

        $respuesta = ControladorOferta::editarOfertaAcademica($oferta);
        header("Location: " . $rutaFinal . "ofertaacademicaadmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "ofertaacademicaadmin/2");
    }
}
