<?php

include '../clases/galeria.php';
include '../controlador/controladorGaleria.php';
include '../clases/ruta.php';

$rutaFinal = Ruta::retornaRutaAdmin();
$rutaFisicaAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($accion == "crear") {
    $galeria = new Galeria();

    $galeria->clase = ' ';
    $galeria->imagen_p = ' ';
    $galeria->alt = ' ';
    $galeria->url = ' ';
    $galeria->texto = ' ';
    $galeria->texto_s = ' ';

    $galeria->identificador_pagina = 'noticia';
    $galeria->modulo = '134';
    $galeria->nombre = filter_input(INPUT_POST, 'noticia', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $galeria->orden = '1';
    $galeria->imagen = basename($_FILES['imagen']['name']);
    $galeria->estado = 'activo';
    $galeria->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $galeria->fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($galeria->imagen != '') {
        $img_rute = $rutaFisicaAssets . basename($_FILES['imagen']['name']);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
            $respuesta = ControladorGaleria::crearGaleria($galeria);
            var_dump($galeria);
            header("Location: " . $rutaFinal . "listaregistrosgaleria/" . $respuesta);
        } else {
            header("Location: " . $rutaFinal . "listaregistrosgaleria/" . 2);
        }
    } else {
        header("Location: " . $rutaFinal . "listaregistrosgaleria/2");
    }
}
$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($accion == "eliminar") {
    $galeria = new Galeria();
    $galeria->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $galeriaActual = ControladorGaleria::buscarGaleria($galeria);
    if ($galeriaActual != null) {
        unlink($rutaFisicaAssets . $galeriaActual['imagen']);
    }
    $respuesta = ControladorGaleria::eliminarGaleria($galeria);
    echo $respuesta;
    header("Location: " . $rutaFinal . "listaregistrosgaleria/" . $respuesta);
}
