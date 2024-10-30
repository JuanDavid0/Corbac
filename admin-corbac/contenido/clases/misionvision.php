<?php

require_once "conexion.php";

class MisionVision
{
    public $identificador;
    public $identificador_modulo;
    public $indice;
    public $contenido;

    static function listaMisionVision($tabla)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador_modulo = '138' AND indice in (1, 2, 3, 4)";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscaMisionVision($tabla, $misionVision) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$misionVision->identificador' AND identificador_modulo = '138' AND indice in (2, 4)";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function editarMisionVision($tabla, $misionVision) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "UPDATE $tabla SET contenido = '$misionVision->contenido' WHERE identificador = '$misionVision->identificador' AND identificador_modulo = '138' AND indice in (2, 4)";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {
            unset($conexion);
            return 1;
        } else {
            unset($conexion);
            return 0;
        }
    }
}
