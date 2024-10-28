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
        $sql = "SELECT * FROM $tabla";
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
        $conexion = $conn->connectDB();
        $sql = "UPDATE $tabla SET 
        variable = :variable,
        estado = :estado 
        WHERE identificador = :identificador";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':variable', $general->variable);
        $consulta->bindParam(':estado', $general->estado);
        $consulta->bindParam(':identificador', $general->identificador);
        
        if ($consulta->execute()) {
            return 1;
        } else {
            return 2;
        }
    }

}
