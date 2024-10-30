<?php
include '../clases/general.php';
include '../controlador/controladorGeneral.php';
include '../clases/ruta.php';

$rutaFinal = Ruta::retornaRutaAdmin();

$rutaFisicaAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";

$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($accion == "editar") {
    $general = new General();
    $general->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $generalActual = ControladorGeneral::buscarGeneral($general);

    if ($generalActual != null) {
        if ($generalActual['clase'] === 'Logo' && isset($_FILES['variable']) && $_FILES['variable']['error'] === UPLOAD_ERR_OK) {
            $img_rute = $rutaFisicaAssets . basename($_FILES['variable']['name']);
            $img_rute_anterior = $rutaFisicaAssets . $generalActual['variable'];
            unlink($img_rute_anterior);
            if (move_uploaded_file($_FILES['variable']['tmp_name'], $img_rute)) {
                $general->variable = basename($_FILES['variable']['name']);
            } else {
                header("Location: " . $rutaFinal . "generaladmin/2");
                exit;
            }
        } else {
            $general->variable = filter_input(INPUT_POST, 'variable', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        $general->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $resultado = ControladorGeneral::editarGeneral($general);
        header("Location: ".$rutaFinal."generaladmin/".$resultado);
    } else {
        header("Location: ".$rutaFinal."generaladmin/2");
    }
}