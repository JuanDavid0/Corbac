<?php

require_once "conexion.php";

class GaleriaNosotros
{
    public $identificador;
    public $identificador_pagina;
    public $modulo;
    public $imagen;
    public $alt;
    public $texto;
    public $estado;
    public $idioma;
    public $fecha;

    static function listaNosotrosInicio($tabla)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador_pagina = 'inicio' AND modulo = '127'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscaNosotrosInicio($tabla, $nosotrosInicio)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$nosotrosInicio->identificador' AND identificador_pagina = 'inicio' AND modulo = '127'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function editarNosotrosInicio($tabla, $nosotrosInicio)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "UPDATE $tabla SET imagen = '$nosotrosInicio->imagen', alt = '$nosotrosInicio->alt', texto = '$nosotrosInicio->texto', estado = '$nosotrosInicio->estado', idioma = '$nosotrosInicio->idioma', fecha = '$nosotrosInicio->fecha' WHERE identificador = '$nosotrosInicio->identificador' AND identificador_pagina = 'inicio' AND modulo = '127'";
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
