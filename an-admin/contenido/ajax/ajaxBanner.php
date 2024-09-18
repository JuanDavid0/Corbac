<?php
include '../clases/banner.php';
include '../controlador/controladorBanner.php';
include '../clases/ruta.php';
$rutaFinal = Ruta::retornaRutaAdmin();
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
    $banner->url = filter_input(INPUT_POST, 'url_boton', FILTER_SANITIZE_STRING);
    $banner->disposicion = filter_input(INPUT_POST, 'disposicion', FILTER_SANITIZE_STRING);
    $banner->disposicion_imagen_p = filter_input(INPUT_POST, 'disposicion_imagen_p', FILTER_SANITIZE_STRING);
    $banner->imagen = basename($_FILES['imagen']['name']);
    $banner->imagen_p = basename($_FILES['imagen_p']['name']);
    $banner->estado = 'activo';
    $banner->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
    if ($banner->imagen != '') {
        $img_rute = "../assets/" . basename($_FILES['imagen']['name']);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
            $banner->alt = basename($_FILES['imagen']['name']);
            if ($banner->imagen_p != '') {
                $img_rute = "../assets/" . basename($_FILES['imagen_p']['name']);
                if (move_uploaded_file($_FILES['imagen_p']['tmp_name'], $img_rute)) {
                    $banner->alt_p = basename($_FILES['imagen_p']['name']);
                }
                $respuesta = ControladorBanner::crearBanner($banner);
                header("Location: " . $rutaFinal . "banneradmin/" . $respuesta);
            } else {
                $respuesta = ControladorBanner::crearBanner($banner);
                header("Location: " . $rutaFinal . "banneradmin/" . $respuesta);
            }
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
    $banner->identificador_pagina = 'inicio';
    $banner->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $banner->texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING);
    $banner->texto_boton = filter_input(INPUT_POST, 'texto_boton', FILTER_SANITIZE_STRING);
    $banner->fecha_inicio = filter_input(INPUT_POST, 'fecha_inicio', FILTER_SANITIZE_STRING);
    $banner->fecha_final = filter_input(INPUT_POST, 'fecha_final', FILTER_SANITIZE_STRING);
    $banner->orden = filter_input(INPUT_POST, 'orden', FILTER_SANITIZE_STRING);
    $banner->url = filter_input(INPUT_POST, 'url_boton', FILTER_SANITIZE_STRING);
    $banner->disposicion = filter_input(INPUT_POST, 'disposicion', FILTER_SANITIZE_STRING);
    $banner->disposicion_imagen_p = filter_input(INPUT_POST, 'disposicion_imagen_p', FILTER_SANITIZE_STRING);
    $banner->imagen = basename($_FILES['imagen']['name']);
    $banner->imagen_p = basename($_FILES['imagen_p']['name']);
    $banner->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
    $banner->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $bannerActual = ControladorBanner::buscarBanner($banner);
    if ($bannerActual != null) {
        if ($banner->imagen != '') {
            $img_rute = "../assets/" . basename($_FILES['imagen']['name']);
            $img_rute_anterior = "../assets/" . $bannerActual['imagen'];
            unlink($img_rute_anterior);
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
                $banner->alt = basename($_FILES['imagen']['name']);
            }
        } else{
            $banner->imagen = $bannerActual['imagen'];
        }
        if ($banner->imagen_p != '') {
            $img_rute = "../assets/" . basename($_FILES['imagen_p']['name']);
            $img_rute_anterior = "../assets/" . $bannerActual['imagen_p'];
            unlink($img_rute_anterior);
            if (move_uploaded_file($_FILES['imagen_p']['tmp_name'], $img_rute)) {
                $banner->alt_p = basename($_FILES['imagen_p']['name']);
            }
        }else{
            $banner->imagen_p = $bannerActual['imagen_p'];
        }
        $respuesta = ControladorBanner::editarBanner($banner);
        header("Location: " . $rutaFinal . "banneradmin/".$respuesta);
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
            unlink("../assets/" . $bannerActual['imagen']);
             unlink("../assets/" . $bannerActual['imagen_p']);        
    }   
    echo ControladorBanner::eliminarBanner($banner);           
}