<?php
/**
 * Description of controladorBanner
 *
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
class ControladorGeneral {

    public static function editarGeneral($general) {
        $tabla = "general";
        $respuesta = General::editarGeneral($tabla, $general);
        return $respuesta;   
    }
}
