<?php
include '../clases/correo.php';
include '../controlador/controladorCorreo.php';
include '../clases/ruta.php';
$rutaFinal = Ruta::retornaRutaAdmin();
$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "crear") {
    $correo = new Correo();
    $correo->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $correo->correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $correo->telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    $resultado = ControladorCorreo::crearCorreo($correo);
    header("Location: ".$rutaFinal."correosadmin/".$resultado);
}
if ($accion == "editar") {
    $correo = new Correo();
    $correo->id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $correo->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $correo->correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $correo->telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    $correo->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $resultado = ControladorCorreo::editarCorreo($correo);
    header("Location: ".$rutaFinal."correosadmin/".$resultado);
}
$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "eliminar") {
    $correo = new Correo();
    $correo->id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    echo ControladorCorreo::eliminarCorreo($correo);
}