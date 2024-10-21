<?php

include '../clases/galeria.php';
include '../controlador/controladorGaleria.php';
include '../clases/ruta.php';

$rutaFinal = Ruta::retornaRutaAdmin();
$rutaFisicaAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($accion == "crear") {
    $galeria = new Galeria();
    $galeria->identificador_pagina = 'noticia';
    $galeria->modulo = '134';
    $galeria->nombre = filter_input(INPUT_POST, 'noticia', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $galeria->texto = ' ';
    $galeria->orden = '1';
    $galeria->estado = 'activo';
    $galeria->fecha = date('Y-m-d'); 
    $galeria->idioma = 'es';
    // Proceso para múltiples imágenes
    $imagenes = $_FILES['imagenes'];
    $totalImagenes = count($imagenes['name']);

    for ($i = 0; $i < $totalImagenes; $i++) {
        if ($imagenes['name'][$i] != '') {
            $galeria->imagen = basename($imagenes['name'][$i]);
            $galeria->alt = $galeria->imagen;
            $img_rute = $rutaFisicaAssets . $galeria->imagen;
            if (move_uploaded_file($imagenes['tmp_name'][$i], $img_rute)) {
                $respuesta = ControladorGaleria::crearGaleria($galeria);
            }
        }
    }

    header("Location: " . $rutaFinal . "listaregistrosgaleria/" . $respuesta);
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
