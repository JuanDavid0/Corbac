<?php

/**
 * Description of Banner
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
require_once "conexion.php";
define('METHOD', 'AES-256-CBC');
class Usuario
{

    public $correo;
    public $correo_p;
    public $contrasena;
    public $estado;
    public $tipo;

    static function listarUsuario($tabla)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }
    static function buscarUsuario($tabla, $correo)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE correo_p = '$correo->correo_p'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }


    static function eliminarUsuario($tabla, $usuario)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "DELETE FROM $tabla WHERE correo_p = '$usuario->correo_p'";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 2;
        }
    }
    static function crearUsuario($tabla, $usuario)
    {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("INSERT INTO $tabla (correo, "
            . "correo_p, contrasena, estado, tipo) VALUES ('$usuario->correo',"
            . "'$usuario->correo_p','$usuario->contrasena','Activo','Administrador'); ");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 2;
        }
    }
    static function editarUsuario($tabla, $usuario)
    {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("UPDATE $tabla SET contrasena = '$usuario->contrasena',"
            . "estado = '$usuario->estado' WHERE correo_p = '$usuario->correo_p';");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 2;
        }
    }
    static function encriptarUsuario($informacion)
    {
        //para que la salida sean datos hexagecimales
        $keyC = $informacion;
        $output = FALSE;
        $key = hash('sha256', $keyC);
        //devuelve un caracter del string
        $iv = substr(hash('sha256', $keyC), 0, 16);
        //encripta los dato 
        $output = openssl_encrypt($informacion . "anbu", METHOD, $key, 0, $iv);
        //codificar en base 64 
        $output = base64_encode($output);
        return $output;
    }
}
