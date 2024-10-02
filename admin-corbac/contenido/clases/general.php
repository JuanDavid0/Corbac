<?php
/**
 * Description of Banner
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
require_once "conexion.php";

class General {

    public $identificador;
    public $variable;
    public $estado;

    static function listarGeneral($tabla) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE NOT tipo = 'logof' AND NOT tipo = 'logo'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }
    static function buscarGeneral($tabla, $general) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$general->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }
    static function editarGeneral($tabla, $general) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("UPDATE $tabla SET variable = '$general->variable',"
            ."estado = '$general->estado' WHERE identificador = '$general->identificador';");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 2;
        }
    }

}
