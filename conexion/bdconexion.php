<?php
// Conectar
function connectDB()
{
    /*
    $server = "auth-db805.hstgr.io";
    $user = "u116500482_ucorbac";
    $pass = "5v#BFB;N";
    $bd = "u116500482_corbac";
    */

    $server = "localhost";
    $user = "root";
    $pass = "root";
    $bd = "corbacv2";

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