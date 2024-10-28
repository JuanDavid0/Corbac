<?php

class ControladorContacto {
    public static function editarContacto($contacto) {
        $tabla = "contenido";
        $respuesta = Contacto::editarContacto($tabla, $contacto);
        return $respuesta;
    }

    public static function listaContacto() {
        $tabla = "contenido";
        $respuesta = Contacto::listaContacto($tabla);
        return $respuesta;
    }

    public static function buscaContacto($contacto) {
        $tabla = "contenido";
        $respuesta = Contacto::buscaContacto($tabla, $contacto);
        return $respuesta;
    }
}