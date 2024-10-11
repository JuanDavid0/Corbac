<?php
include '../clases/banner.php';
include '../controlador/controladorBanner.php';
include '../clases/ruta.php';
$rutaFinal = Ruta::retornaRutaAdmin();
$rutaFisicaAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_STRING);

if ($accion == "crear") {
    $banner = new Banner();
    $banner->identificador_pagina = 'inicio';
    $banner->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $banner->texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING);
    $banner->texto_boton = filter_input(INPUT_POST, 'texto_boton', FILTER_SANITIZE_STRING);
    $banner->fecha_inicio = filter_input(INPUT_POST, 'fecha_inicio', FILTER_SANITIZE_STRING);
    $banner->fecha_final = filter_input(INPUT_POST, 'fecha_final', FILTER_SANITIZE_STRING);
    $banner->orden = filter_input(INPUT_POST, 'orden', FILTER_SANITIZE_STRING);
    $banner->url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_STRING); // Cambiado de url_boton a url
    $banner->disposicion = filter_input(INPUT_POST, 'disposicion', FILTER_SANITIZE_STRING);
    $banner->imagen = basename($_FILES['imagen']['name']);
    $banner->estado = 'activo';
    $banner->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);

    if ($banner->imagen != '') {
        $img_rute = "../assets/" . basename($_FILES['imagen']['name']);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
            $banner->alt = basename($_FILES['imagen']['name']);
            $respuesta = ControladorBanner::crearBanner($banner);
            header("Location: " . $rutaFinal . "banneradmin/" . $respuesta);
        } else {
            header("Location: " . $rutaFinal . "banneradmin/2");
        }
    } else {
        header("Location: " . $rutaFinal . "banneradmin/2");
    }
}
if ($accion == "editar") {
    $banner = new Banner();
    $banner->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_STRING);

    // Buscar el banner actual en la base de datos
    $bannerActual = ControladorBanner::buscarBanner($banner);

    if ($bannerActual != null) {
        // Solo actualizamos los campos que estén en el formulario
        $banner->identificador_pagina = 'inicio'; // Esto podría ser dinámico si lo deseas
        $banner->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING) ?: $bannerActual['titulo'];
        $banner->texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING) ?: $bannerActual['texto'];
        $banner->texto_boton = filter_input(INPUT_POST, 'texto_boton', FILTER_SANITIZE_STRING) ?: $bannerActual['texto_boton'];
        $banner->fecha_inicio = filter_input(INPUT_POST, 'fecha_inicio', FILTER_SANITIZE_STRING) ?: $bannerActual['fecha_inicio'];
        $banner->fecha_final = filter_input(INPUT_POST, 'fecha_final', FILTER_SANITIZE_STRING) ?: $bannerActual['fecha_final'];
        $banner->orden = filter_input(INPUT_POST, 'orden', FILTER_SANITIZE_NUMBER_INT) ?: $bannerActual['orden'];
        $banner->url = filter_input(INPUT_POST, 'url_boton', FILTER_SANITIZE_STRING) ?: $bannerActual['url'];
        $banner->disposicion = filter_input(INPUT_POST, 'disposicion', FILTER_SANITIZE_STRING) ?: $bannerActual['disposicion'];
        $banner->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING) ?: $bannerActual['idioma'];
        $banner->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING) ?: $bannerActual['estado'];


        // Manejo de la imagen
        if (!empty($_FILES['imagen']['name'])) {
            $banner->imagen = basename($_FILES['imagen']['name']);
            $img_rute = $rutaFisicaAssets . $banner->imagen;
            $img_rute_anterior = $rutaFisicaAssets . $bannerActual['imagen'];
            unlink($img_rute_anterior);
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
                $banner->alt = basename($_FILES['imagen']['name']);
            } else {
                error_log('Error al subir el archivo: ' . $_FILES['imagen']['name']);
                die('Ocurrió un error al subir la imagen.');
            }
        } else {
            // Si no se subió una nueva imagen, mantenemos la anterior
            $banner->imagen = $bannerActual['imagen'];
            $banner->alt = $bannerActual['alt'];
        }

        // Editamos el banner con los valores actualizados
        $respuesta = ControladorBanner::editarBanner($banner);
        header("Location: " . $rutaFinal . "banneradmin/");
    } else {
        header("Location: " . $rutaFinal . "banneradmin/2");
    }
}


$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "eliminar") {
    $banner = new Banner();
    $banner->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $bannerActual = ControladorBanner::buscarBanner($banner);

    if ($bannerActual != null) {
        unlink("../assets/" . $bannerActual['imagen']); // Eliminar la imagen asociada
    }

    echo ControladorBanner::eliminarBanner($banner);
}
?>