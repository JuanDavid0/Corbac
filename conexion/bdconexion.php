<?php
// Conectar
function connectDB()
{
    
    // $server = "auth-db1526.hstgr.io";
    // $user = "u145597152_ucorbac";
    // $pass = "eK3>zq6*U";
    // $bd = "u145597152_bcorbac";
    

    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "corbac";

    $conexion = mysqli_connect($server, $user, $pass, $bd);

    if (!$conexion) {
        die("Ha sucedido un error en la conexion de la base de datos: " . mysqli_connect_error());
    }

    return $conexion;
}

// Desconectar
function disconnectDB($conexion)
{
    $close = mysqli_close($conexion);
    if (!$close) {
        die("Ha sucedido un error en la desconexion de la base de datos");
    }
    return $close;
}
