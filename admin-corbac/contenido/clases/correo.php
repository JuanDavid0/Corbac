<?php

/**
 * Description of Banner
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
require_once "conexion.php";

class Correo {

    public $id;
    public $nombre;
    public $correo;
    public $telefono;
    public $estado;
    public $fecha;

    static function listarCorreo($tabla) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscarCorreo($tabla, $correo) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE id = '$correo->id'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function eliminarCorreo($tabla, $correo) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "DELETE FROM $tabla WHERE id = '$correo->id'";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 2;
        }
    }
    static function crearCorreo($tabla, $correo) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("INSERT INTO $tabla (nombre, "
                . "correo, telefono,estado) VALUES ('$correo->nombre',"
                . "'$correo->correo','$correo->telefono','suscrito'); ");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 2;
        }
    }
    static function editarCorreo($tabla, $correo) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("UPDATE $tabla SET nombre = '$correo->nombre',"
                . "correo = '$correo->correo', telefono = '$correo->telefono', "
                . "estado = '$correo->estado' WHERE id = '$correo->id';");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 2;
        }
    }

}
