<?php

include '../clases/oferta.php';
include '../controlador/controladorOferta.php';
include '../clases/ruta.php';

$rutaFinalAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

date_default_timezone_set("America/Bogota");

$rutaFinal = Ruta::retornaRutaAdmin();

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "crearE") {
    $oferta = new oferta();
    $oferta->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->url_amigable = filter_input(INPUT_POST, 'url_amigable', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->imagen_p = basename($_FILES['imagen_p']['name']);
    $oferta->descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->contenido1 = filter_input(INPUT_POST, 'contenido1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->contenido_duracion = filter_input(INPUT_POST, 'contenido_duracion');
    $oferta->contenido_modalidad = filter_input(INPUT_POST, 'contenido_modalidad', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->contenido_aprobado = filter_input(INPUT_POST, 'contenido_aprobado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->imagen1 = basename($_FILES['imagen1']['name']);
    $oferta->alt1 = basename($_FILES['imagen1']['name']);
    $oferta->contenido2 = filter_input(INPUT_POST, 'contenido2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->imagen2 = basename($_FILES['imagen2']['name']);
    $oferta->alt2 = basename($_FILES['imagen2']['name']);
    $oferta->contenido3 = filter_input(INPUT_POST, 'contenido3', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->plan_enlace = filter_input(INPUT_POST, 'plan_enlace', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->contenido4 = filter_input(INPUT_POST, 'contenido4');
    $oferta->contenido5 = filter_input(INPUT_POST, 'contenido5');
    $oferta->oferta_padre = filter_input(INPUT_POST, 'oferta_padre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->fecha = date('Y-m-d');
    $oferta->estado = 'activo';

    if ($oferta->imagen_p != '') {
        $img_rute = $rutaFinalAssets . basename($_FILES['imagen_p']['name']);
        if (move_uploaded_file($_FILES['imagen_p']['tmp_name'], $img_rute)) {
            $oferta->imagen_p = basename($_FILES['imagen_p']['name']);
            $respuesta = ControladorOferta::crearOfertaEspecifica($oferta);
            header("Location: " . $rutaFinal . "ofertaacademicaadmin/" . $respuesta);
        } else {
            header("Location: " . $rutaFinal . "ofertaacademicaadmin/2");
        }
    } else {
        header("Location: " . $rutaFinal . "ofertaacademicaadmin/2");
    }

    if ($oferta->imagen1 != '') {
        $img_rute = "../assets/" . basename($_FILES['imagen1']['name']);
        if (move_uploaded_file($_FILES['imagen1']['tmp_name'], $img_rute)) {
            $oferta->imagen1 = basename($_FILES['imagen1']['name']);
            $oferta->alt1 = basename($_FILES['imagen1']['name']);
        }
    } else {
        $oferta->imagen1 = '';
    }

    if ($oferta->imagen2 != '') {
        $img_rute = "../assets/" . basename($_FILES['imagen2']['name']);
        if (move_uploaded_file($_FILES['imagen2']['tmp_name'], $img_rute)) {
            $oferta->imagen2 = basename($_FILES['imagen2']['name']);
            $oferta->alt2 = basename($_FILES['imagen2']['name']);
        }
    } else {
        $oferta->imagen2 = '';
    }
}

if ($accion == "editarE") {
    $oferta = new oferta();
    $oferta->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ofertaActual = ControladorOferta::buscarOferta($oferta);

    //imprime en el navegador el valor de $ofertaActuAL
    var_dump($ofertaActual);

    if ($ofertaActual != null) {
        $oferta->url_amigable = filter_input(INPUT_POST, 'url_amigable', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->contenido1 = filter_input(INPUT_POST, 'contenido1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->contenido_duracion = filter_input(INPUT_POST, 'contenido_duracion');
        $oferta->contenido_modalidad = filter_input(INPUT_POST, 'contenido_modalidad', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->contenido_aprobado = filter_input(INPUT_POST, 'contenido_aprobado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->contenido2 = filter_input(INPUT_POST, 'contenido2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->contenido3 = filter_input(INPUT_POST, 'contenido3', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->plan_enlace = filter_input(INPUT_POST, 'plan_enlace', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->contenido4 = filter_input(INPUT_POST, 'contenido4');
        $oferta->contenido5 = filter_input(INPUT_POST, 'contenido5');
        $oferta->oferta_padre = filter_input(INPUT_POST, 'oferta_padre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->fecha = date('Y-m-d');
        $oferta->idioma = 'es';
        $oferta->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $oferta->imagen_p = isset($_FILES['imagen_p']) ? basename($_FILES['imagen_p']['name']) : '';
        $oferta->imagen1 = isset($_FILES['imagen1']) ? basename($_FILES['imagen1']['name']) : '';
        $oferta->imagen2 = isset($_FILES['imagen2']) ? basename($_FILES['imagen2']['name']) : '';

        if ($oferta->imagen_p != '') {
            $img_rute_p = $rutaFinalAssets . $oferta->imagen_p;
            $img_rute_p_anterior = $rutaFinalAssets . $ofertaActual['imagen_p'];

            if (mime_content_type($_FILES['imagen_p']['tmp_name']) === 'image/jpeg' || mime_content_type($_FILES['imagen_p']['tmp_name']) === 'image/png') {
                unlink($img_rute_p_anterior);
                move_uploaded_file($_FILES['imagen_p']['tmp_name'], $img_rute_p);
            } else {
                die('Error: El archivo de imagen principal no es válido.');
            }
        } else {
            $oferta->imagen_p = $ofertaActual['imagen_p'];
        }

        // Procesar imagen 1
        if ($oferta->imagen1 != '') {
            $img_rute_1 = $rutaFinalAssets . $oferta->imagen1;
            $img_rute_1_anterior = $rutaFinalAssets . $ofertaActual['imagen1'];

            if (mime_content_type($_FILES['imagen1']['tmp_name']) === 'image/jpeg' || mime_content_type($_FILES['imagen1']['tmp_name']) === 'image/png') {
                unlink($img_rute_1_anterior);
                if (move_uploaded_file($_FILES['imagen1']['tmp_name'], $img_rute_1)) {
                    $oferta->alt1 = $oferta->imagen1;
                }
            } else {
                die('Error: El archivo de imagen 1 no es válido.');
            }
        } else {
            $oferta->imagen1 = $ofertaActual['imagen1'];
            $oferta->alt1 = $ofertaActual['imagen1'];
        }

        // Procesar imagen 2
        if ($oferta->imagen2 != '') {
            $img_rute_2 = $rutaFinalAssets . $oferta->imagen2;
            $img_rute_2_anterior = $rutaFinalAssets . $ofertaActual['imagen2'];

            if (mime_content_type($_FILES['imagen2']['tmp_name']) === 'image/jpeg' || mime_content_type($_FILES['imagen2']['tmp_name']) === 'image/png') {
                unlink($img_rute_2_anterior);
                if (move_uploaded_file($_FILES['imagen2']['tmp_name'], $img_rute_2)) {
                    $oferta->alt2 = $oferta->imagen2;
                }
            } else {
                die('Error: El archivo de imagen 2 no es válido.');
            }
        } else {
            $oferta->imagen2 = $ofertaActual['imagen2'];
            $oferta->alt2 = $ofertaActual['imagen2'];
        }

        // Editar oferta
        $respuesta = ControladorOferta::editarOfertaEspecifica($oferta);
        header("Location: " . $rutaFinal . "ofertaacademicaadmin/" . $respuesta);
    } else {
        $respuesta = 2;
        header("Location: " . $rutaFinal . "ofertaacademicaadmin/" . $respuesta);
    }
}

$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($accion == "eliminarE") {
    $oferta = new Oferta();
    $oferta->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ofertaActual = ControladorOferta::buscarOferta($oferta);

    if ($ofertaActual != null) {
        unlink($rutaFinalAssets . $ofertaActual['imagen_p']);
        unlink($rutaFinalAssets . $ofertaActual['imagen1']);
        unlink($rutaFinalAssets . $ofertaActual['imagen2']);
    }

    echo ControladorOferta::eliminarOfertaEspecifica($oferta);
}
