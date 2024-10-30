<?php
include '../clases/faq.php';
include '../controlador/controladorFaq.php';
include '../clases/ruta.php';

$rutaFinal = Ruta::retornaRutaAdmin();

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "crear") {
    $faq = new Faq();
    $faq->pregunta = filter_input(INPUT_POST, 'pregunta', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $faq->respuesta = filter_input(INPUT_POST, 'respuesta', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $faq->estado = 'activo';

    $respuesta = ControladorFaq::crearFaq($faq);

    if ($respuesta == 1) {
        header("Location: " . $rutaFinal . "faqadmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "faqadmin/2");
    }
}

if ($accion == "editar") {
    $faq = new Faq();
    $faq->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $faqActual = ControladorFaq::buscarFaq($faq);

    if ($faqActual != null) {
        $faq->pregunta = filter_input(INPUT_POST, 'pregunta', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $faq->respuesta = filter_input(INPUT_POST, 'respuesta', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $faq->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $respuesta = ControladorFaq::editarFaq($faq);

        if ($respuesta == 1) {
            header("Location: " . $rutaFinal . "faqadmin/" . $respuesta);
        } else {
            header("Location: " . $rutaFinal . "faqadmin/2");
        }
    } else {
        header("Location: " . $rutaFinal . "faqadmin/2");
    }
}

$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($accion == "eliminar") {
    $faq = new Faq();
    $faq->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $respuesta = ControladorFaq::eliminarFaq($faq);

    if ($respuesta == 1) {
        header("Location: " . $rutaFinal . "faqadmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "faqadmin/2");
    }
}