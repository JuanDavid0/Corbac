<?php

require_once "conexion.php";

class Convenio
{
    public $identificador;
    public $nombre;
    public $imagen;
    public $vigencia;
    public $contacto;
    public $email;
    public $url;
    public $estado;

    static function listaConvenio($tabla)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscaConvenio($tabla, $convenio) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$convenio->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function editarConvenio($tabla, $convenio) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "UPDATE $tabla SET nombre = '$convenio->nombre', imagen = '$convenio->imagen', vigencia = '$convenio->vigencia', contacto = '$convenio->contacto', email = '$convenio->email', url = '$convenio->url', estado = '$convenio->estado' WHERE identificador = '$convenio->identificador'";
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
