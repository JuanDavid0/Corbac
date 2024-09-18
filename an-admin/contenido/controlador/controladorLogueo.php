<?php
include '../clases/logueo.php';
include '../../conexion/bdconexion.php';
include '../../conexion/ruta.php';
$objLog = new logueo();
$objRuta = new ruta();
$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_STRING);
$rutaFinal = $objRuta->retornaRuta();
if($accion == "iniciarSesion"){
    $usuario = filter_input(INPUT_GET, 'usuario', FILTER_SANITIZE_EMAIL);
    $con = filter_input(INPUT_GET, 'contrasena', FILTER_SANITIZE_STRING);        
    $resultado = $objLog->iniciarSesion($usuario, $con);      
    if($resultado == "999"){
        echo $resultado;
    }else{                        
        echo $rutaFinal.$resultado;        
    }
}
if($accion == "cerrarSesion") {
    $usuario = filter_input(INPUT_GET, 'usuario', FILTER_SANITIZE_STRING);
    $fecha = filter_input(INPUT_GET, 'fecha', FILTER_SANITIZE_STRING);       
    $resultado = $objLog->cerrarSesion();   
    header("Location:" . $rutaFinal);     
}