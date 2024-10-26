<?php
include '../clases/misionvision.php';
include '../controlador/controladorMisionVision.php';
include '../clases/ruta.php';

$rutaFinal = Ruta::retornaRutaAdmin();

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "editar") {
    $misionVision = new MisionVision();
    $misionVision->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $misionVision->identificador_modulo = 138;
    $misionVision->contenido = filter_input(INPUT_POST, 'contenido');

    $misionVisionActual = ControladorMisionVision::buscarMisionVision($misionVision);

    if ($misionVisionActual != null) {
        $respuesta = ControladorMisionVision::editarMisionVision($misionVision);
        header("Location: " . $rutaFinal . "misionvisionadmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "misionvisionadmin/2");
    }
}