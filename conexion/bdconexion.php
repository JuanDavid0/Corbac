<?php
// Conectar
function connectDB(){
    $server = "localhost";
    $user = "root";
    $pass = "root";
    $bd = "renova";
    $conexion = mysqli_connect($server, $user, $pass, $bd) 
        or die("Ha sucedido un error en la conexion de la base de datos");
    return $conexion;
} 
// Desconectar
function disconnectDB($conexion){
    $close = mysqli_close($conexion) 
        or die("Ha sucedido un error en la desconexion de la base de datos");
    return $close;
}