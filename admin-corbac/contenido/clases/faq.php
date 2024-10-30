<?php

require_once "conexion.php";

class Faq
{
    public $identificador;
    public $pregunta;
    public $respuesta;
    public $estado;

    static function listaFaq($tabla)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscarFaq($tabla, $faq)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$faq->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function crearFaq($tabla, $faq)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "INSERT INTO $tabla (pregunta, respuesta, estado) VALUES (?, ?, ?)";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute([
            $faq->pregunta,
            $faq->respuesta,
            $faq->estado
        ])) {
            return 1;
        } else {
            return 0;
        }
    }

    static function editarFaq($tabla, $faq) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "UPDATE $tabla SET
        pregunta = :pregunta,
        respuesta = :respuesta,
        estado = :estado
        WHERE identificador = :identificador";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':pregunta', $faq->pregunta);
        $consulta->bindParam(':respuesta', $faq->respuesta);
        $consulta->bindParam(':estado', $faq->estado);
        $consulta->bindParam(':identificador', $faq->identificador);

        if ($consulta->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    static function eliminarFaq($tabla, $faq)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "DELETE  FROM $tabla WHERE identificador = '$faq->identificador'";
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
