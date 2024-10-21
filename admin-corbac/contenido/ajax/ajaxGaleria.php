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

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($accion == "filtrar") {
    $noticiaSeleccionada = filter_input(INPUT_POST, 'noticia', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Llamar a la función que lista la galería filtrada por noticia
    $registros = Galeria::listarGaleria('galeria', $noticiaSeleccionada);

    // Generar el contenido de la tabla con las imágenes filtradas
    $xhtml = "<div id=\"contenedor-personas-admin-label\"><div>Imagen</div><div>Noticia</div><div>Acciones</div></div>";
    if ($registros) {
        foreach ($registros as $campo) {
            $xhtml .= "<div class=\"contenedor-persona-admin\">";
            $xhtml .= "<p class=\"tit-persona-admin img-banner-admin\" style=\"background-image:url('/contenido/assets/" . htmlspecialchars($campo['imagen']) . "');\"></p>";
            $xhtml .= "<p class=\"tit-persona-admin\">" . htmlspecialchars($campo['nombre']) . "</p>";
            $xhtml .= "<p class=\"tit-persona-admin\">";
            $xhtml .= "<a class=\"log-persona-admin log-persona-ed fa-eliminar\" onclick=\"mostrarConfirmar('confirmeEliminar'," . $campo['identificador'] . ") \"></a>";
            $xhtml .= "</p>";
            $xhtml .= "</div>";
        }
    } else {
        $xhtml .= "<p>No hay imágenes disponibles.</p>";
    }

    echo $xhtml;
}