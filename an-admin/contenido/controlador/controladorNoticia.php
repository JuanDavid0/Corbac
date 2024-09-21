<?php
/**
 * Description of controladorBanner
 *
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
class ControladorNoticia {
    
    public static function crearNoticia($noticia) {
        $tabla = "noticia";
        $respuesta = Noticia::crearNoticia($tabla, $noticia);
        return $respuesta;   
    }
    public static function editarNoticia($noticia) {
        $tabla = "noticia";
        $respuesta = Noticia::editarNoticia($tabla, $noticia);
        return $respuesta;   
    }
    public static function buscarNoticia($noticia) {
        $tabla = "noticia";
        $respuesta = Noticia::buscarNoticia($tabla, $noticia);
        return $respuesta;   
    }
    public static function eliminarNoticia($noticia) {
        $tabla = "noticia";
        $respuesta = Noticia::eliminarNoticia($tabla, $noticia);
        return $respuesta;   
    }
}
