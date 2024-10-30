<?php
include '../clases/galeriaNosotros.php';
include '../controlador/controladorNosotrosInicio.php';
include '../clases/ruta.php';

$rutaFinal = Ruta::retornaRutaAdmin();

$rutaFisicaAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "editar") {
    $nosotrosInicio = new galeriaNosotros();
    $nosotrosInicio->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nosotrosInicioActual = ControladorNosotrosInicio::buscarNosotrosInicio($nosotrosInicio);

    if ($nosotrosInicioActual != null) {
        $nosotrosInicio->identificador_pagina = 'inicio';
        $nosotrosInicio->modulo = 127;
        $nosotrosInicio->texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nosotrosInicio->estado = 'activo';
        $nosotrosInicio->idioma = 'es';
        $nosotrosInicio->fecha = date('Y-m-d');

        if (!empty($_FILES['imagen']['name'])) {
            $nosotrosInicio->imagen = basename($_FILES['imagen']['name']);
            $img_rute = $rutaFisicaAssets . $nosotrosInicio->imagen;
            $img_rute_anterior = $rutaFisicaAssets . $nosotrosInicioActual['imagen'];
            unlink($img_rute_anterior);
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
                $nosotrosInicio->alt = basename($_FILES['imagen']['name']);
            } else {
                error_log('Error al subir el archivo: ' . $_FILES['imagen']['name']);
                die('Ocurrió un error al subir la imagen.');
            }
        } else {
            $nosotrosInicio->imagen = $nosotrosInicioActual['imagen'];
            $nosotrosInicio->alt = $nosotrosInicioActual['alt'];
        }
        $respuesta = ControladorNosotrosInicio::editarNosotrosInicio($nosotrosInicio);
        header("Location: " . $rutaFinal . "nosotrosadmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "nosotrosadmin/2");
    }
}
