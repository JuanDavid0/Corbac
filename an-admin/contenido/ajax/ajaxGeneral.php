<?php
include '../clases/general.php';
include '../controlador/controladorGeneral.php';
include '../clases/ruta.php';
$rutaFinal = Ruta::retornaRutaAdmin();
$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "editar") {
    $general = new General();
    $general->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_STRING);
    $general->variable = filter_input(INPUT_POST, 'variable', FILTER_SANITIZE_STRING);
    $general->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $resultado = ControladorGeneral::editarGeneral($general);
    header("Location: ".$rutaFinal."generaladmin/".$resultado);
}