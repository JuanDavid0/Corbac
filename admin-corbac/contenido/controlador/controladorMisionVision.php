<?php

class ControladorMisionVision {
    public static function editarMisionVision($misionVision) {
        $tabla = "contenido";
        $respuesta = MisionVision::editarMisionVision($tabla, $misionVision);
        return $respuesta;
    }

    public static function buscarMisionVision($misionVision) {
        $tabla = "contenido";
        $respuesta = MisionVision::buscaMisionVision($tabla, $misionVision);
        return $respuesta;
    }
}