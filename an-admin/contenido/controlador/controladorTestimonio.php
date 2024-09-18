<?php
/**
 * Description of controladorBanner
 *
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
class ControladorTestimonio {
    
    public static function CrearTestimonio($testimonio) {
        $tabla = "testimonio";
        $respuesta = Testimonio::crearTestimonio($tabla, $testimonio);
        return $respuesta;   
    }
    public static function editarTestimonio($testimonio) {
        $tabla = "testimonio";
        $respuesta = Testimonio::editarTestimonio($tabla, $testimonio);
        return $respuesta;   
    }
    public static function buscarTestimonio($testimonio) {
        $tabla = "testimonio";
        $respuesta = Testimonio::buscarTestimonio($tabla, $testimonio);
        return $respuesta;   
    }
    public static function eliminaresTimonio($testimonio) {
        $tabla = "testimonio";
        $respuesta = Testimonio::eliminarTestimonio($tabla, $testimonio);
        return $respuesta;   
    }
}
