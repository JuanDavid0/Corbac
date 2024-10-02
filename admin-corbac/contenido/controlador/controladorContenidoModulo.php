<?php
/**
 * Description of controladorGaleria
 *
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
class ControladorContenidoModulo {
        
    public static function editarContenido($galeria) {
        $tabla = "galeria";
        $respuesta = ContenidoModulo::editarContenido($tabla, $galeria);
        return $respuesta;   
    }
    public static function buscarContenido($galeria) {
        $tabla = "galeria";
        $respuesta = ContenidoModulo::buscarContenido($tabla, $galeria);
        return $respuesta;   
    }
    public static function eliminarContenido($galeria) {
        $tabla = "galeria";
        $respuesta = ContenidoModulo::eliminarContenido($tabla, $galeria);
        return $respuesta;   
    }
}
