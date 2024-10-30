<?php
include '../clases/normativa.php';
include '../controlador/controladorNormativa.php';
include '../clases/ruta.php';

$rutaFinal = Ruta::retornaRutaAdmin();
$rutaFisicaAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "crear") {
    $normativa = new Normativa();
    $normativa = new Normativa();
    $normativa->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (isset($_FILES['archivo_pdf']) && $_FILES['archivo_pdf']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivoPDF = basename($_FILES['archivo_pdf']['name']);
        $rutaArchivoPDF = $rutaFisicaAssets . "docs/" . $nombreArchivoPDF;

        if (move_uploaded_file($_FILES['archivo_pdf']['tmp_name'], $rutaArchivoPDF)) {
            $normativa->url = "docs/" . $nombreArchivoPDF;
        } else {
            header("Location: " . $rutaFinal . "normativasadmin/2");
            exit;
        }
    } else {
        $normativa->url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    
    if (!empty($_FILES['imagen']['name'])) {
        $normativa->imagen = basename($_FILES['imagen']['name']);
        $img_rute = $rutaFisicaAssets . $normativa->imagen;

        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
            header("Location: " . $rutaFinal . "normativasadmin/2");
            exit;
        }
    }

    $respuesta = ControladorNormativa::crearNormativa($normativa);
    if ($respuesta == 1) {
        header("Location: " . $rutaFinal . "normativasadmin/" . $respuesta);
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

        if (isset($_FILES['archivo_pdf']) && $_FILES['archivo_pdf']['error'] === UPLOAD_ERR_OK) {
            $nombreArchivoPDF = basename($_FILES['archivo_pdf']['name']);
            $rutaArchivoPDF = $rutaFisicaAssets . "docs/" . $nombreArchivoPDF;

            if (move_uploaded_file($_FILES['archivo_pdf']['tmp_name'], $rutaArchivoPDF)) {
                if (!empty($normativaActual['url']) && file_exists($rutaFisicaAssets . $normativaActual['url'])) {
                    unlink($rutaFisicaAssets . $normativaActual['url']);
                }
                $normativa->url = "docs/" . $nombreArchivoPDF;
            } else {
                header("Location: " . $rutaFinal . "normativasadmin/2");
                exit;
            }
        } else {
            $normativa->url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        if (!empty($_FILES['imagen']['name'])) {
            $normativa->imagen = basename($_FILES['imagen']['name']);
            $img_rute = $rutaFisicaAssets . $normativa->imagen;

            if (!empty($normativaActual['imagen']) && file_exists($rutaFisicaAssets . $normativaActual['imagen'])) {
                unlink($rutaFisicaAssets . $normativaActual['imagen']);
            }

            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
                header("Location: " . $rutaFinal . "normativasadmin/2");
                exit;
            }
        } else {
            $normativa->imagen = $normativaActual['imagen'];
        }

        $respuesta = ControladorNormativa::editarNormativa($normativa);
        header("Location: " . $rutaFinal . "normativasadmin/" . $respuesta);
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
        if (!empty($normativaActual['imagen']) && file_exists($rutaFisicaAssets . $normativaActual['imagen'])) {
            unlink($rutaFisicaAssets . $normativaActual['imagen']);
        }
        
        if (!empty($normativaActual['url']) && file_exists($rutaFisicaAssets . $normativaActual['url'])) {
            unlink($rutaFisicaAssets . $normativaActual['url']);
        }
    }
    $respuesta = ControladorNormativa::eliminarNormativa($normativa);

    if ($respuesta == 1) {
        header("Location: " . $rutaFinal . "normativasadmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "normativasadmin/2");
    }
}
