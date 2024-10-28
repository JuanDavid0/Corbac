<?php
include '../clases/normativa.php';
include '../controlador/controladorNormativa.php';
include '../clases/ruta.php';

$rutaFinal = Ruta::retornaRutaAdmin();

$rutaFisicaAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "crear") {
    $normativa = new Normativa();
    $normativa->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $normativa->url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $normativa->imagen = basename($_FILES['imagen']['name']);
    
    if ($normativa->imagen != '') {
        $img_rute = $rutaFisicaAssets . basename($_FILES['imagen']['name']);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
            $respuesta = ControladorNormativa::crearNormativa($normativa);
            header("Location: " . $rutaFinal . "normativasadmin/" . $respuesta);
        } else {
            header("Location: " . $rutaFinal . "normativasadmin/2");
        }
    } else {
        header("Location: " . $rutaFinal . "normativasadmin/2");
    }
}

if ($accion == "editar") {
    $normativa = new Normativa();
    $normativa->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $normativaActual = ControladorNormativa::buscarNormativa($normativa);

    if ($normativaActual != null) {
        $normativa->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $normativa->url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!empty($_FILES['imagen']['name'])) {
            $normativa->imagen = basename($_FILES['imagen']['name']);
            $img_rute = $rutaFisicaAssets . $normativa->imagen;
            $img_rute_anterior = $rutaFisicaAssets . $normativaActual['imagen'];
            unlink($img_rute_anterior);
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
                $respuesta = ControladorNormativa::editarNormativa($normativa);
                header("Location: " . $rutaFinal . "normativasadmin/" . $respuesta);
            } else {
                header("Location: " . $rutaFinal . "normativasadmin/2");
            }
        } else {
            $normativa->imagen = $normativaActual['imagen'];
            $respuesta = ControladorNormativa::editarNormativa($normativa);
            header("Location: " . $rutaFinal . "normativasadmin/" . $respuesta);
        }
    } else {
        header("Location: " . $rutaFinal . "normativasadmin/2");
    }
}

$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "eliminar") {
    $normativa = new Normativa();
    $normativa->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $normativaActual = ControladorNormativa::buscarNormativa($normativa);

    if ($normativaActual != null) {
        unlink($rutaFisicaAssets . $normativaActual['imagen']);
    }
    $respuesta = ControladorNormativa::eliminarNormativa($normativa);

    if ($respuesta == 1) {
        header("Location: " . $rutaFinal . "normativasadmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "normativasadmin/2");
    }
}
