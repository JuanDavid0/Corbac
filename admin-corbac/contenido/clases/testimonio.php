<?php

/**
 * Description of Banner
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
require_once "conexion.php";

class Testimonio {

    public $identificador;
    public $nombre;
    public $testimonio;
    public $foto;
    public $alt;
    public $estado;

    static function listarTestimonio($tabla) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscarTestimonio($tabla, $banner) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$banner->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function eliminarTestimonio($tabla, $banner) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "DELETE  FROM $tabla WHERE identificador = '$banner->identificador'";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 2;
        }
    }
    static function crearTestimonio($tabla, $banner) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("INSERT INTO $tabla (nombre, "
                . "testimonio, foto, alt, estado, fecha) VALUES ('$banner->nombre',"
                . "'$banner->testimonio','$banner->foto','$banner->alt', "
                . "'$banner->estado', '$banner->fecha' ); ");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 2;
        }
    }
    static function editarTestimonio($tabla, $banner) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("UPDATE $tabla SET nombre = '$banner->nombre',"
                . "testimonio = '$banner->testimonio', alt = '$banner->alt', "
                . "estado = '$banner->estado', foto = '$banner->foto' "
                . "WHERE identificador = '$banner->identificador';");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 2;
        }
    }

}
