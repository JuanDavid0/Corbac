<?php
/**
 * Description of controladorGaleria
 *
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
class ControladorGaleria {
    
    public static function crearGaleria($galeria) {
        $tabla = "galeria_producto_servicio";        
        $respuesta = Galeria::crearGaleria($tabla, $galeria);
        return $respuesta;   
    }
    public static function editarGaleria($galeria) {
        $tabla = "galeria_producto_servicio";
        $respuesta = Galeria::editarGaleria($tabla, $galeria);
        return $respuesta;   
    }
    public static function buscarGaleria($galeria) {
        $tabla = "galeria_producto_servicio";
        $respuesta = Galeria::buscarGaleria($tabla, $galeria);
        return $respuesta;   
    }
    public static function eliminarGaleria($galeria) {
        $tabla = "galeria_producto_servicio";
        $respuesta = Galeria::eliminarGaleria($tabla, $galeria);
        return $respuesta;   
    }
}
