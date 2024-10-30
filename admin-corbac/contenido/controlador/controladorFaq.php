<?php

class ControladorFaq {
    public static function crearFaq($faq) {
        $tabla = "preguntas_frecuentes";
        $respuesta = Faq::crearFaq($tabla, $faq);
        return $respuesta;
    }

    public static function editarFaq($faq) {
        $tabla = "preguntas_frecuentes";
        $respuesta = Faq::editarFaq($tabla, $faq);
        return $respuesta;
    }

    public static function eliminarFaq($faq) {
        $tabla = "preguntas_frecuentes";
        $respuesta = Faq::eliminarFaq($tabla, $faq);
        return $respuesta;
    }

    public static function buscarFaq($faq) {
        $tabla = "preguntas_frecuentes";
        $respuesta = Faq::buscarFaq($tabla, $faq);
        return $respuesta;
    }
}