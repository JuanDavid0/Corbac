<?php

include '../clases/convenio.php';
include '../controlador/controladorConvenio.php';
include '../clases/ruta.php';

$rutaFinal = Ruta::retornaRutaAdmin();
$rutaFisicaAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "editar") {
    $convenio = new Convenio();
    $convenio->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $convenioActual = ControladorConvenio::buscarConvenio($convenio);

    if ($convenioActual != null) {
        $convenio->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $convenioActual['nombre'];
        $convenio->vigencia = filter_input(INPUT_POST, 'vigencia', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $convenioActual['vigencia'];
        $convenio->contacto = filter_input(INPUT_POST, 'contacto', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $convenioActual['contacto'];
        $convenio->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $convenioActual['email'];
        $convenio->url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $convenioActual['url'];
        $convenio->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $convenioActual['estado'];

        if (!empty($_FILES['imagen']['name'])) {
            $convenio->imagen = basename($_FILES['imagen']['name']);
            $img_rute = $rutaFisicaAssets . $convenio->imagen;
            $img_rute_anterior = $rutaFisicaAssets . $convenioActual['imagen'];
            unlink($img_rute_anterior);

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
                $respuesta = ControladorConvenio::editarConvenio($convenio);
                header("Location: " . $rutaFinal . "conveniosadmin/" . $respuesta);
            } else {
                header("Location: " . $rutaFinal . "conveniosadmin/2");
            }
        } else {
            $convenio->imagen = $convenioActual['imagen'];
            $respuesta = ControladorConvenio::editarConvenio($convenio);
            header("Location: " . $rutaFinal . "conveniosadmin/" . $respuesta);
        }
    }
}
