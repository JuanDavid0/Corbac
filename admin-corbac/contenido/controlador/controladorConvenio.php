<?php

class ControladorConvenio {
    public static function editarConvenio($convenio) {
        $tabla = "convenio";
        $respuesta = Convenio::editarConvenio($tabla, $convenio);
        return $respuesta;
    }

    public static function buscarConvenio($convenio) {
        $tabla = "convenio";
        $respuesta = Convenio::buscaConvenio($tabla, $convenio);
        return $respuesta;
    }
}