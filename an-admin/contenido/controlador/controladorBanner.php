<?php
/**
 * Description of controladorBanner
 *
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
class ControladorBanner {
    
    public static function crearBanner($banner) {
        $tabla = "banner";
        $respuesta = Banner::crearBanner($tabla, $banner);
        return $respuesta;   
    }
    public static function editarBanner($banner) {
        $tabla = "banner";
        $respuesta = Banner::editarBanner($tabla, $banner);
        return $respuesta;   
    }
    public static function buscarBanner($banner) {
        $tabla = "banner";
        $respuesta = Banner::buscarBanner($tabla, $banner);
        return $respuesta;   
    }
    public static function eliminarBanner($banner) {
        $tabla = "banner";
        $respuesta = Banner::eliminarBanner($tabla, $banner);
        return $respuesta;   
    }
}
