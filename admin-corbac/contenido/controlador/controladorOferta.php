<?php

class ControladorOferta
{

    public static function crearOferta($oferta)
    {
        $tabla = "oferta_academica";
        $respuesta = Oferta::crearOferta($tabla, $oferta);
        return $respuesta;
    }

    public static function crearofertaespecifica($oferta)
    {
        $tabla = "oferta_academica";
        $respuesta = Oferta::crearOfertaEspecifica($tabla, $oferta);
        return $respuesta;
    }

    public static function editarOferta($oferta)
    {
        $tabla = "oferta_academica";
        $respuesta = Oferta::editarOferta($tabla, $oferta);
        return $respuesta;
    }

    public static Function editarOfertaEspecifica($oferta)
    {
        $tabla = "oferta_academica";
        $respuesta = Oferta::editarOfertaEspecifica($tabla, $oferta);
        return $respuesta;
    }

    public static function eliminarOfertaEspecifica($oferta)
    {
        $tabla = "oferta_academica";
        $respuesta = Oferta::eliminarOfertaEspecifica($tabla, $oferta);
        return $respuesta;
    }

    public static function buscarOferta($oferta)
    {
        $tabla = "oferta_academica";
        $respuesta = Oferta::buscarOferta($tabla, $oferta);
        return $respuesta;
    }
}
