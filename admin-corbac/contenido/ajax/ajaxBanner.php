<?php
include '../clases/banner.php';
include '../controlador/controladorBanner.php';
include '../clases/ruta.php';
$rutaFinal = Ruta::retornaRutaAdmin();
$rutaFisicaAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "crear") {
    $banner = new Banner();
    $banner->identificador_pagina = 'inicio';
    $banner->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $banner->texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $banner->texto_boton = filter_input(INPUT_POST, 'texto_boton', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $banner->fecha_inicio = filter_input(INPUT_POST, 'fecha_inicio', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $banner->fecha_final = filter_input(INPUT_POST, 'fecha_final', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $banner->orden = filter_input(INPUT_POST, 'orden', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $banner->url = filter_input(INPUT_POST, 'url_boton', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $banner->disposicion = filter_input(INPUT_POST, 'disposicion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $banner->imagen = basename($_FILES['imagen']['name']);
    $banner->estado = 'activo';
    $banner->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($banner->imagen != '') {
        $img_rute = $rutaFisicaAssets . basename($_FILES['imagen']['name']);
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
    $banner->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $bannerActual = ControladorBanner::buscarBanner($banner);

    if ($bannerActual != null) {
        $banner->identificador_pagina = 'inicio';
        $banner->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $bannerActual['titulo'];
        $banner->texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $bannerActual['texto'];
        $banner->texto_boton = filter_input(INPUT_POST, 'texto_boton', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $bannerActual['texto_boton'];
        $banner->fecha_inicio = filter_input(INPUT_POST, 'fecha_inicio', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $bannerActual['fecha_inicio'];
        $banner->fecha_final = filter_input(INPUT_POST, 'fecha_final', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $bannerActual['fecha_final'];
        $banner->orden = filter_input(INPUT_POST, 'orden', FILTER_SANITIZE_NUMBER_INT) ?: $bannerActual['orden'];
        $banner->url = filter_input(INPUT_POST, 'url_boton', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $bannerActual['url'];
        $banner->disposicion = filter_input(INPUT_POST, 'disposicion', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $bannerActual['disposicion'];
        $banner->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $bannerActual['idioma'];
        $banner->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $bannerActual['estado'];

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
            $banner->imagen = $bannerActual['imagen'];
            $banner->alt = $bannerActual['alt'];
        }
        $respuesta = ControladorBanner::editarBanner($banner);
        header("Location: " . $rutaFinal . "banneradmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "banneradmin/2");
    }
}


$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($accion == "eliminar") {
    $banner = new Banner();
    $banner->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $bannerActual = ControladorBanner::buscarBanner($banner);

    if ($bannerActual != null) {
        unlink($rutaFisicaAssets . $bannerActual['imagen']);
    }
    $respuesta = ControladorBanner::eliminarBanner($banner);

    if ($respuesta === 1) {
        header("Location: " . $rutaFinal . "banneradmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "banneradmin/2");
    }
}
