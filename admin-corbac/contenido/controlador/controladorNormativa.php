<?php

class ControladorNormativa {
    public static function crearNormativa($normativa) {
        $tabla = "normativas";
        $respuesta = Normativa::crearNormativa($tabla, $normativa);
        return $respuesta;
    }

    public static function editarNormativa($normativa) {
        $tabla = "normativas";
        $respuesta = Normativa::editarNormativa($tabla, $normativa);
        return $respuesta;
    }

    public static function eliminarNormativa($normativa) {
        $tabla = "normativas";
        $respuesta = Normativa::eliminarNormativa($tabla, $normativa);
        return $respuesta;
    }

    public static function buscarNormativa($normativa) {
        $tabla = "normativas";
        $respuesta = Normativa::buscarNormativa($tabla, $normativa);
        return $respuesta;
    }
}