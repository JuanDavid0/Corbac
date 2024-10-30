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
    $oferta->url_amigable = filter_input(INPUT_POST, 'url_amigable', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->imagen_p = basename($_FILES['imagen_p']['name']);
    $oferta->descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->contenido1 = filter_input(INPUT_POST, 'contenido1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->contenido_duracion = filter_input(INPUT_POST, 'contenido_duracion');
    $oferta->contenido_modalidad = filter_input(INPUT_POST, 'contenido_modalidad', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->contenido_aprobado = filter_input(INPUT_POST, 'contenido_aprobado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->imagen1 = basename($_FILES['imagen1']['name']);
    $oferta->alt1 = $oferta->imagen1;
    $oferta->contenido2 = filter_input(INPUT_POST, 'contenido2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->imagen2 = basename($_FILES['imagen2']['name']);
    $oferta->alt2 = $oferta->imagen2;
    $oferta->contenido3 = filter_input(INPUT_POST, 'contenido3', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (isset($_FILES['archivo_pdf']) && $_FILES['archivo_pdf']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivoPlan = basename($_FILES['archivo_pdf']['name']);
        $rutaArchivoPlan = $rutaFinalAssets . "docs/" . $nombreArchivoPlan;

        if (move_uploaded_file($_FILES['archivo_pdf']['tmp_name'], $rutaArchivoPlan)) {
            $oferta->plan_enlace = "docs/" . $nombreArchivoPlan;
        } else {
            header("Location: " . $rutaFinal . "ofertaacademicaadmin/2");
            exit;
        }
    } else {
        $oferta->plan_enlace = filter_input(INPUT_POST, 'plan_enlace', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    $oferta->contenido4 = filter_input(INPUT_POST, 'contenido4');
    $oferta->contenido5 = filter_input(INPUT_POST, 'contenido5');
    $oferta->oferta_padre = filter_input(INPUT_POST, 'oferta_padre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $oferta->fecha = date('Y-m-d');
    $oferta->idioma = 'es';
    $oferta->estado = 'activo';

    if (!empty($oferta->imagen_p)) {
        $img_rute_p = $rutaFinalAssets . $oferta->imagen_p;
        move_uploaded_file($_FILES['imagen_p']['tmp_name'], $img_rute_p);
    }

    if (!empty($oferta->imagen1)) {
        $img_rute_1 = $rutaFinalAssets . $oferta->imagen1;
        move_uploaded_file($_FILES['imagen1']['tmp_name'], $img_rute_1);
    }

    if (!empty($oferta->imagen2)) {
        $img_rute_2 = $rutaFinalAssets . $oferta->imagen2;
        move_uploaded_file($_FILES['imagen2']['tmp_name'], $img_rute_2);
    }

    $respuesta = ControladorOferta::crearOfertaEspecifica($oferta);

    if ($respuesta == 1) {
        header("Location: " . $rutaFinal . "ofertaacademicaadmin/1");
    } else {
        header("Location: " . $rutaFinal . "ofertaacademicaadmin/2");
    }
}

if ($accion == "editarE") {
    $oferta = new oferta();
    $oferta->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ofertaActual = ControladorOferta::buscarOferta($oferta);

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

        if (isset($_FILES['archivo_pdf']) && $_FILES['archivo_pdf']['error'] === UPLOAD_ERR_OK) {
            $nombreArchivoPlan = basename($_FILES['archivo_pdf']['name']);
            $rutaArchivoPlan = $rutaFinalAssets . "docs/" . $nombreArchivoPlan;

            if (move_uploaded_file($_FILES['archivo_pdf']['tmp_name'], $rutaArchivoPlan)) {
                if (!empty($ofertaActual['plan_enlace']) && file_exists($rutaFinalAssets . $ofertaActual['plan_enlace'])) {
                    unlink($rutaFinalAssets . $ofertaActual['plan_enlace']);
                }
                $oferta->plan_enlace = "docs/" . $nombreArchivoPlan;
            } else {
                header("Location: " . $rutaFinal . "ofertaacademicaadmin/2");
                exit;
            }
        } else {
            $oferta->plan_enlace = filter_input(INPUT_POST, 'plan_enlace', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        $oferta->contenido4 = filter_input(INPUT_POST, 'contenido4');
        $oferta->contenido5 = filter_input(INPUT_POST, 'contenido5');
        $oferta->oferta_padre = filter_input(INPUT_POST, 'oferta_padre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $oferta->fecha = date('Y-m-d');
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

        if (!empty($_FILES['imagen1']['name'])) {
            $oferta->imagen1 = basename($_FILES['imagen1']['name']);
            $oferta->alt1 = $oferta->imagen1;
            $img_rute_1 = $rutaFinalAssets . $oferta->imagen1;
            $img_rute_anterior_1 = $rutaFinalAssets . $ofertaActual['imagen1'];
            unlink($img_rute_anterior_1);
            move_uploaded_file($_FILES['imagen1']['tmp_name'], $img_rute_1);
        } else {
            $oferta->imagen1 = $ofertaActual['imagen1'];
            $oferta->alt1 = $ofertaActual['imagen1'];
        }

        if (!empty($_FILES['imagen2']['name'])) {
            $oferta->imagen2 = basename($_FILES['imagen2']['name']);
            $oferta->alt2 = $oferta->imagen2;
            $img_rute_2 = $rutaFinalAssets . $oferta->imagen2;
            $img_rute_anterior_2 = $rutaFinalAssets . $ofertaActual['imagen2'];
            unlink($img_rute_anterior_2);
            move_uploaded_file($_FILES['imagen2']['tmp_name'], $img_rute_2);
        } else {
            $oferta->imagen2 = $ofertaActual['imagen2'];
            $oferta->alt2 = $ofertaActual['imagen2'];
        }

        $respuesta = ControladorOferta::editarOfertaEspecifica($oferta);
        header("Location: " . $rutaFinal . "ofertaacademicaadmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "ofertaacademicaadmin/2");
    }
}

$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($accion == "eliminarE") {
    $oferta = new Oferta();
    $oferta->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ofertaActual = ControladorOferta::buscarOferta($oferta);

    if ($ofertaActual != null) {
        $rutaArchivoPlan = $rutaFinalAssets . $ofertaActual['plan_enlace'];
        $img_rute_p = $rutaFinalAssets . $ofertaActual['imagen_p'];
        $img_rute_1 = $rutaFinalAssets . $ofertaActual['imagen1'];
        $img_rute_2 = $rutaFinalAssets . $ofertaActual['imagen2'];

        if (!empty($ofertaActual['plan_enlace']) && file_exists($rutaArchivoPlan)) {
            unlink($rutaArchivoPlan);
        }
        if (!empty($ofertaActual['imagen_p']) && file_exists($img_rute_p)) {
            unlink($img_rute_p);
        }
        if (!empty($ofertaActual['imagen1']) && file_exists($img_rute_1)) {
            unlink($img_rute_1);
        }
        if (!empty($ofertaActual['imagen2']) && file_exists($img_rute_2)) {
            unlink($img_rute_2);
        }

        $respuesta = ControladorOferta::eliminarOfertaEspecifica($oferta);

        if ($respuesta) {
            header("Location: " . $rutaFinal . "ofertaacademicaadmin/3"); // Redirigir a éxito
        } else {
            header("Location: " . $rutaFinal . "ofertaacademicaadmin/2"); // Redirigir a error
        }
    } else {
        header("Location: " . $rutaFinal . "ofertaacademicaadmin/2"); // Redirigir a error
    }
}
