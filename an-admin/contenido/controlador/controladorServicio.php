<?php
/**
 * Description of controladorBanner
 *
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
class ControladorServicio {
    
    public static function crearServicio($servicio) {
        $tabla = "servicio";
        $respuesta = Servicio::crearServicio($tabla, $servicio);
        return $respuesta;   
    }
    public static function editarServicio($servicio) {
        $tabla = "servicio";
        $respuesta = Servicio::editarServicio($tabla, $servicio);
        return $respuesta;   
    }
    public static function buscarServicio($servicio) {
        $tabla = "servicio";
        $respuesta = Servicio::buscarServicio($tabla, $servicio);
        return $respuesta;   
    }
    public static function eliminarServicio($servicio) {
        $tabla = "servicio";
        $respuesta = Servicio::eliminarServicio($tabla, $servicio);
        return $respuesta;   
    }
    public static function listarCategoriaServicio($servicio) {
        $tabla = "pagina";
        $respuesta = Servicio::buscarServicio($tabla, $servicio);
        return $respuesta;   
    }
}
