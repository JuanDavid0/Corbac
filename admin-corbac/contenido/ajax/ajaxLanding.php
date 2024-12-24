<?php
include '../clases/landing.php';
include '../controlador/controladorLanding.php';
include '../clases/ruta.php';

$rutaFinal = Ruta::retornaRutaAdmin();
$rutaFisicaAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "crear") {
    $landing = new Landing();
    $landing->pagina = 'inicio';
    $landing->indice = 1;
    $landing->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->subTitulo = filter_input(INPUT_POST, 'subTitulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->contenido = filter_input(INPUT_POST, 'contenido', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->cta1 = filter_input(INPUT_POST, 'cta1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->cta2 = filter_input(INPUT_POST, 'cta2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($landing->cta2 === 'noticia') {
        $landing->cta2 .= '/' . filter_input(INPUT_POST, 'noticiaSeleccionada', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if ($landing->cta2 === 'oferta') {
        $landing->cta2 .= '/' . filter_input(INPUT_POST, 'ofertaSeleccionada', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    $landing->promesa1 = filter_input(INPUT_POST, 'promesa1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->fecha_inicio = filter_input(INPUT_POST, 'fecha_inicio', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->fecha_fin = filter_input(INPUT_POST, 'fecha_fin', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->idioma = 'es';
    $landing->estado = 'activo';

    $resultado = ControladorLanding::crearLanding($landing);

    if ($resultado == 1) {
        header("Location: " . $rutaFinal . "landingadmin/1");
    } else {
        header("Location: " . $rutaFinal . "landingadmin/2");
    }    
}

if ($accion == "editar") {
    $landing = new Landing();
    $landing->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landingActual = ControladorLanding::buscarLanding($landing);

    if ($landingActual != null) {
        $landing->pagina = 'inicio';
        $landing->indice = 1;
        $landing->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['titulo'];
        $landing->subTitulo = filter_input(INPUT_POST, 'subTitulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['subTitulo'];
        $landing->contenido = filter_input(INPUT_POST, 'contenido', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['contenido'];
        $landing->cta1 = filter_input(INPUT_POST, 'cta1', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['cta1'];

        $landing->cta2 = filter_input(INPUT_POST, 'cta2', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['cta2'];
        if ($landing->cta2 === 'noticia') {
            $landing->cta2 .= '/' . filter_input(INPUT_POST, 'noticiaSeleccionada', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        if ($landing->cta2 === 'oferta') {
            $landing->cta2 .= '/' . filter_input(INPUT_POST, 'ofertaSeleccionada', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        $landing->promesa1 = filter_input(INPUT_POST, 'promesa1', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['promesa1'];
        
        $landing->fecha_inicio = filter_input(INPUT_POST, 'fecha_inicio', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['fecha_inicio'];
        $landing->fecha_fin = filter_input(INPUT_POST, 'fecha_fin', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['fecha_fin'];
        $landing->idioma = 'es';
        $landing->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['estado'];

        $respuesta = ControladorLanding::editarLanding($landing);
        header("Location: " . $rutaFinal . "landingadmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "landingadmin/2");
    }
}

$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "eliminar") {
    $landing = new Landing();
    $landing->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landingActual = ControladorLanding::buscarLanding($landing);

    if ($landingActual != null) {
        unlink($rutaFisicaAssets . $landingActual['logo']);
        unlink($rutaFisicaAssets . $landingActual['image1']);
        unlink($rutaFisicaAssets . $landingActual['image2']);
    }
    $respuesta = ControladorLanding::eliminarLanding($landing);

    if ($respuesta == 1) {
        header("Location: " . $rutaFinal . "landingadmin/" . $respuesta);
    } else {
        header("Location: " . $rutaFinal . "landingadmin/2");
    }
}
