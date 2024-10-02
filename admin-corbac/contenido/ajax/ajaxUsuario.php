<?php
include '../clases/usuario.php';
include '../controlador/controladorUsuarios.php';
include '../clases/ruta.php';
$rutaFinal = Ruta::retornaRutaAdmin();
$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "crear") {
    $usuario = new Usuario();
    $usuario->correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $contrasena_aux = filter_input(INPUT_POST, 'contrasena',FILTER_SANITIZE_STRING);   
    $correo_p_aux = ControladorUsuario::encriptarUsuario($usuario->correo);
    $usuario->contrasena = ControladorUsuario::encriptarUsuario($contrasena_aux);
    $usuario->correo_p = str_replace('=','',$correo_p_aux);    
    $resultado = ControladorUsuario::crearUsuario($usuario);
    header("Location: ".$rutaFinal."usuariosadmin/".$resultado);
}
if ($accion == "editar") {
    $usuario = new Usuario();    
    $usuario->correo_p = filter_input(INPUT_POST, 'correo_p', FILTER_SANITIZE_STRING);    
    $contrasena_p_aux = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_STRING);
    $usuario->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    if($contrasena_p_aux == ''){
        $usuario_aux = ControladorUsuario::buscarUsuario($usuario);
        $usuario->contrasena = $usuario_aux['contrasena'];
    }else{
        $usuario->contrasena = ControladorUsuario::encriptarUsuario($contrasena_p_aux);
    }        
    $resultado = ControladorUsuario::editarUsuario($usuario);
    header("Location: ".$rutaFinal."usuariosadmin/".$resultado);
}
$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "eliminar") {
    $usuario = new Usuario();
    $usuario->correo_p = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    echo ControladorUsuario::eliminarUsuario($usuario);
}