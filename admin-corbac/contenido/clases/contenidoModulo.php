<?php

/**
 * @author CAFFI SAS
 * Andres Nicolas Lopez Robles
 */
require_once "conexion.php";

class ContenidoModulo {

    public $identificador;
    public $identificador_pagina;
    public $modulo;
    public $nombre;
    public $subtitulo;
    public $clase;
    public $imagen;
    public $imagen_p;
    public $alt;
    public $url;
    public $texto;
    public $texto_s;
    public $texto_boton;
    public $ciudad;
    public $video;
    public $orden;
    public $estado;
    public $idioma;
    public $fecha;
    public $tipo;

    static function buscarContenido($tabla, $galeria) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$galeria->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function editarContenido($tabla, $galeria) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        echo "UPDATE $tabla SET "
                . "nombre='$galeria->nombre',"
                . "subtitulo='$galeria->subtitulo',"
                . "clase='$galeria->clase',"
                . "imagen='$galeria->imagen',"
                . "imagen_p='$galeria->imagen_p',"
                . "alt='$galeria->alt',"
                . "url='$galeria->url',"
                . "texto='$galeria->texto',"
                . "texto_s='$galeria->texto_s',"
                . "texto_boton='$galeria->texto_boton',"
                . "ciudad='$galeria->ciudad',"
                . "video='$galeria->video',"
                . "orden='$galeria->orden',"
                . "estado='$galeria->estado',"
                . "idioma='$galeria->idioma',"
                . "fecha='$galeria->fecha', "
                . "tipo='$galeria->tipo' "
                . "WHERE identificador = '$galeria->identificador';";
        $consulta = $stmt->prepare("UPDATE $tabla SET "
                . "nombre='$galeria->nombre',"
                . "subtitulo='$galeria->subtitulo',"
                . "clase='$galeria->clase',"
                . "imagen='$galeria->imagen',"
                . "imagen_p='$galeria->imagen_p',"
                . "alt='$galeria->alt',"
                . "url='$galeria->url',"
                . "texto='$galeria->texto',"
                . "texto_s='$galeria->texto_s',"
                . "texto_boton='$galeria->texto_boton',"
                . "ciudad='$galeria->ciudad',"
                . "video='$galeria->video',"
                . "orden='$galeria->orden',"
                . "estado='$galeria->estado',"
                . "idioma='$galeria->idioma',"
                . "fecha='$galeria->fecha', "
                . "tipo='$galeria->tipo' "
                . "WHERE identificador = '$galeria->identificador';");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 2;
        }
    }
    static function eliminarContenido($tabla, $galeria) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("DELETE FROM $tabla WHERE identificador = '$galeria->identificador' ");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }
}