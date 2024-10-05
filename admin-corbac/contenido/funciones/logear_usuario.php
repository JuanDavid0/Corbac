<?php
require_once ("../../conexion/bdconexion.php");
require_once ("../funciones/encriptacion.php");
$usuario = filter_input(INPUT_GET, 'usuario', FILTER_SANITIZE_STRING);
$con = filter_input(INPUT_GET, 'contrasena', FILTER_SANITIZE_STRING);
$objEncriptar = 
$conEncript = encriptar(4, $con);
consultaLogear($usuario, $conEncript);
function consultaLogear($usuario, $con){    
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT id FROM usuario WHERE usuario = '".$usuario."' AND contra = '".$con."' ";    
    $result = mysqli_query($conexion, $sql);
    if (($result->num_rows) == 1) {        
        session_start();
        ini_set("session.cookie_lifetime","900");
        ini_set("session.gc_maxlifetime","900");
        echo  "1";                               
        $_SESSION['nomina'] = $usuario;
    } else {
        echo "999";
    }
    disconnectDB($conexion);    
}