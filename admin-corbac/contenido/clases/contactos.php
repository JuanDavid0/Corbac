<?php

require_once "conexion.php";

class Contacto
{
    public $identificador;
    public $identificador_modulo;
    public $indice;
    public $contenido;

    static function listaContacto($tabla)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador_modulo = '140' AND indice IN (3, 4, 5, 6, 7, 8)";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscaContacto($tabla, $contacto)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$contacto->identificador' AND identificador_modulo = '140' AND indice in (4, 6, 8)";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function editarContacto($tabla, $contacto)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "UPDATE $tabla SET 
        contenido = :contenido
        WHERE identificador = :identificador
        AND identificador_modulo = :identificador_modulo
        AND indice in (4, 6, 8)";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':contenido', $contacto->contenido);
        $consulta->bindParam(':identificador_modulo', $contacto->identificador_modulo);
        $consulta->bindParam(':identificador', $contacto->identificador);

        if ($consulta->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
