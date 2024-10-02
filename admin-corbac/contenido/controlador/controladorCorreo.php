<?php
/**
 * Description of controladorBanner
 *
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
class ControladorCorreo {
    
    public static function crearCorreo($correo) {
        $tabla = "correo";
        $respuesta = Correo::crearCorreo($tabla, $correo);
        return $respuesta;   
    }
    public static function editarCorreo($correo) {
        $tabla = "correo";
        $respuesta = Correo::editarCorreo($tabla, $correo);
        return $respuesta;   
    }
    public static function buscarCorreo($correo) {
        $tabla = "correo";
        $respuesta = Correo::buscarCorreo($tabla, $correo);
        return $respuesta;   
    }
    public static function eliminarCorreo($correo) {
        $tabla = "correo";
        $respuesta = Correo::eliminarCorreo($tabla, $correo);
        return $respuesta;   
    }
}
