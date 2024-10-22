<?php
include '../clases/landing.php';
include '../controlador/controladorLanding.php';
include '../clases/ruta.php';

$rutaFinal = Ruta::retornaRutaAdmin();
$rutaFisicaAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "crear") {
    $landing = new Landing();
    $landing->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->subTitulo = filter_input(INPUT_POST, 'subTitulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->contenido = filter_input(INPUT_POST, 'contenido', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->cta1 = filter_input(INPUT_POST, 'cta1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->cta2 = filter_input(INPUT_POST, 'cta2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->promesa1 = filter_input(INPUT_POST, 'promesa1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->promesa2 = filter_input(INPUT_POST, 'promesa2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->logo = basename($_FILES['logo']['name']);
    $landing->image1 = basename($_FILES['image1']['name']);
    $landing->image2 = basename($_FILES['image2']['name']);
    $landing->fecha_inicio = filter_input(INPUT_POST, 'fecha_inicio', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->fecha_fin = filter_input(INPUT_POST, 'fecha_fin', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landing->estado = 'activo';

    if ($landing->logo != '' && $landing->image1 != '' && $landing->image2 != '') {
        $img_rute_logo = $rutaFisicaAssets . basename($_FILES['logo']['name']);
        $img_rute_image1 = $rutaFisicaAssets . basename($_FILES['image1']['name']);
        $img_rute_image2 = $rutaFisicaAssets . basename($_FILES['image2']['name']);
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $img_rute_logo) && move_uploaded_file($_FILES['image1']['tmp_name'], $img_rute_image1) && move_uploaded_file($_FILES['image2']['tmp_name'], $img_rute_image2)) {
            $respuesta = ControladorLanding::crearLanding($landing);
            header("Location: " . $rutaFinal . "landingadmin/" . $respuesta);
        } else {
            header("Location: " . $rutaFinal . "landingadmin/2");
        }
    } else {
        header("Location: " . $rutaFinal . "landingadmin/2");
    }
}

if ($accion == "editar") {
    $landing = new Landing();
    $landing->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $landingActual = ControladorLanding::buscarLanding($landing);

    if ($landingActual != null) {
        $landing->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['titulo'];
        $landing->subTitulo = filter_input(INPUT_POST, 'subTitulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['subTitulo'];
        $landing->contenido = filter_input(INPUT_POST, 'contenido', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['contenido'];
        $landing->cta1 = filter_input(INPUT_POST, 'cta1', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['cta1'];
        $landing->cta2 = filter_input(INPUT_POST, 'cta2', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['cta2'];
        $landing->promesa1 = filter_input(INPUT_POST, 'promesa1', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['promesa1'];
        $landing->promesa2 = filter_input(INPUT_POST, 'promesa2', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['promesa2'];
        $landing->fecha_inicio = filter_input(INPUT_POST, 'fecha_inicio', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['fecha_inicio'];
        $landing->fecha_fin = filter_input(INPUT_POST, 'fecha_fin', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['fecha_fin'];
        $landing->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['idioma'];
        $landing->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $landingActual['estado'];

        if (!empty($_FILES['logo']['name'])) {
            $landing->logo = basename($_FILES['logo']['name']);
            $img_rute_logo = $rutaFisicaAssets . $landing->logo;
            $img_rute_anterior_logo = $rutaFisicaAssets . $landingActual['logo'];
            unlink($img_rute_anterior_logo);
            move_uploaded_file($_FILES['logo']['tmp_name'], $img_rute_logo);
        } else {
            $landing->logo = $landingActual['logo'];
        }

        if (!empty($_FILES['image1']['name'])) {
            $landing->image1 = basename($_FILES['image1']['name']);
            $img_rute_image1 = $rutaFisicaAssets . $landing->image1;
            $img_rute_anterior_image1 = $rutaFisicaAssets . $landingActual['image1'];
            unlink($img_rute_anterior_image1);
            move_uploaded_file($_FILES['image1']['tmp_name'], $img_rute_image1);
        } else {
            $landing->image1 = $landingActual['image1'];
        }

        if (!empty($_FILES['image2']['name'])) {
            $landing->image2 = basename($_FILES['image2']['name']);
            $img_rute_image2 = $rutaFisicaAssets . $landing->image2;
            $img_rute_anterior_image2 = $rutaFisicaAssets . $landingActual['image2'];
            unlink($img_rute_anterior_image2);
            move_uploaded_file($_FILES['image2']['tmp_name'], $img_rute_image2);
        } else {
            $landing->image2 = $landingActual['image2'];
        }

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
