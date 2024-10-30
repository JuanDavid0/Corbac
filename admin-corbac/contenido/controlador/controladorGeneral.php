<?php
/**
 * Description of controladorBanner
 *
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
class ControladorGeneral {

    public static function listarGeneral($tabla) {
        $respuesta = General::listarGeneral($tabla);
        return $respuesta;
    }

    public static function buscarGeneral($general) {
        $tabla = "general";
        $respuesta = General::buscarGeneral($tabla, $general);
        return $respuesta;
    }

    public static function editarGeneral($general) {
        $tabla = "general";
        $respuesta = General::editarGeneral($tabla, $general);
        return $respuesta;   
    }
}
