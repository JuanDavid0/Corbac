<?php

class ControladorLanding
{

    public static function crearLanding($landing)
    {
        $tabla = "landing";
        $respuesta = Landing::crearLanding($tabla, $landing);
        return $respuesta;
    }

    public static function editarLanding($landing)
    {
        $tabla = "landing";
        $respuesta = Landing::editarLanding($tabla, $landing);
        return $respuesta;
    }

    public static function eliminarLanding($landing)
    {
        $tabla = "landing";
        $respuesta = Landing::eliminarLanding($tabla, $landing);
        return $respuesta;
    }

    public static function buscarLanding($landing)
    {
        $tabla = "landing";
        $respuesta = Landing::buscaLanding($tabla, $landing);
        return $respuesta;
    }

    public static function listarLanding()
    {
        $tabla = "landing";
        $respuesta = Landing::listaLanding($tabla);
        return $respuesta;
    }
}