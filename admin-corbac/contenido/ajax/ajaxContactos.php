<?php
include '../clases/contactos.php';
include '../controlador/controladorContactos.php';
include '../clases/ruta.php';

$rutaFinal = Ruta::retornaRutaAdmin();

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "editar") {
    $contacto = new Contacto();
    $contacto->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contactoActual = ControladorContacto::buscaContacto($contacto);

    if ($contactoActual != null) {
        $contacto->identificador_modulo = 140;
        $contacto->contenido = filter_input(INPUT_POST, 'contenido', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $respuesta = ControladorContacto::editarContacto($contacto);
        header("Location: " . $rutaFinal . "contactosadmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "contactosadmin/2");
    }
}