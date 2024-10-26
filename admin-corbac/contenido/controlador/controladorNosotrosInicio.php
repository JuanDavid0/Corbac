<?php

class ControladorNosotrosInicio
{
    public static function editarNosotrosInicio($nosotrosInicio)
    {
        $tabla = "galeria";
        $respuesta = galeriaNosotros::editarNosotrosInicio($tabla, $nosotrosInicio);
        return $respuesta;
    }

    public static function buscarNosotrosInicio($nosotrosInicio)
    {
        $tabla = "galeria";
        $respuesta = galeriaNosotros::buscaNosotrosInicio($tabla, $nosotrosInicio);
        return $respuesta;
    }
}
