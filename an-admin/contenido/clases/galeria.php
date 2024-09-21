<?php

/**
 * Description of Banner
 * @author CAFFI SAS
 * Andres Nicolas Lopez Robles
 */
require_once "conexion.php";

class Galeria {

    public $identificador;
    public $servicio_url_amigable;
    public $titulo;
    public $imagen;
    public $video;
    public $alt;  
    public $texto; 
    public $estado;            

    static function listarGaleria($tabla,$identificador_pagina) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE servicio_url_amigable = '$identificador_pagina' ORDER BY id DESC  ";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscarGaleria($tabla, $galeria) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE id = '$galeria->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function eliminarGaleria($tabla, $galeria) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "DELETE  FROM $tabla WHERE id = '$galeria->identificador'";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }
    static function crearGaleria($tabla, $galeria) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();       
        $consulta = $stmt->prepare("INSERT INTO $tabla (servicio_url_amigable, imagen,"
                . " video, titulo, texto, estado) "
                . " VALUES ( '$galeria->servicio_url_amigable','$galeria->imagen',"
                . " '$galeria->video', '$galeria->titulo','$galeria->texto','$galeria->estado') ");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return $res;
        }
    }
    static function editarGaleria($tabla, $galeria) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();           
        $consulta = $stmt->prepare("UPDATE $tabla SET servicio_url_amigable='$galeria->servicio_url_amigable',"
                . "imagen='$galeria->imagen',video='$galeria->video',titulo='$galeria->titulo',"
                . "texto='$galeria->texto',estado='$galeria->estado' WHERE"
                . " id = '$galeria->identificador';");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }
}
