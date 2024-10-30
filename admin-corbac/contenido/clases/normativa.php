<?php

require_once "conexion.php";

class Normativa
{
    public $identificador;
    public $nombre;
    public $url;
    public $imagen;

    static function listaNormativa($tabla)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscarNormativa($tabla, $normativa)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$normativa->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function editarNormativa($tabla, $normativa)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "UPDATE $tabla SET
        nombre = :nombre,
        url = :url,
        imagen = :imagen
        WHERE identificador = :identificador";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':nombre', $normativa->nombre);
        $consulta->bindParam(':url', $normativa->url);
        $consulta->bindParam(':imagen', $normativa->imagen);
        $consulta->bindParam(':identificador', $normativa->identificador);
        if ($consulta->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    static function crearNormativa($tabla, $normativa)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "INSERT INTO $tabla (nombre, url, imagen) VALUES (?, ?, ?)";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute([
            $normativa->nombre,
            $normativa->url,
            $normativa->imagen
        ])) {
            return 1;
        } else {
            return 0;
        }
    }

    static function eliminarNormativa($tabla, $normativa)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "DELETE FROM $tabla WHERE identificador = '$normativa->identificador'";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}