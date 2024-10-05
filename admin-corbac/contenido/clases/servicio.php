<?php

/**
 * Description of Banner
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
require_once "conexion.php";

class Servicio {

    public $identificador;
    public $titulo;
    public $subtitulo;
    public $ciudad;
    public $descripcion_corta;
    public $descripcion_larga;
    public $imagen;
    public $icono;
    public $video;
    public $url_amigable;
    public $texto_boton;
    public $enlace;
    public $nivel;
    public $categoria_pagina;
    public $estado;
    public $idioma;

    static function listarServcio($tabla) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE tipo = 'Proyecto'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }
    static function listarProductos($tabla) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE tipo = 'Producto'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function listarCategoriaServcio($tabla) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE NOT categoria_padre = ' ' AND estado = 'activo' AND nivel = 1; ";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscarServicio($tabla, $servicio) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$servicio->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function eliminarServicio($tabla, $servicio) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "DELETE  FROM $tabla WHERE identificador = '$servicio->identificador'";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }

    static function crearServicio($tabla, $servicio) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("INSERT INTO $tabla ( `titulo`, `subtitulo`, `ciudad`, `descripcion_corta`,"
                . " `descripcion_larga`, `imagen`, `icono`, `video`, `url_amigable`, `texto_boton`, `enlace`,"
                . " `nivel`, `categoria_pagina`, `idioma`, `estado`) "
                . " VALUES ('$servicio->titulo','$servicio->subtitulo','$servicio->ciudad','$servicio->descripcion_corta',"
                . "'$servicio->descripcion_larga','$servicio->imagen', '$servicio->icono','$servicio->video',"
                . "'$servicio->url_amigable','$servicio->texto_boton', '$servicio->enlace', '$servicio->nivel', "
                . "'$servicio->categoria_pagina' ,'$servicio->idioma', '$servicio->estado'); ");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }

    static function editarServicio($tabla, $servicio) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("UPDATE $tabla SET titulo='$servicio->titulo',"
                . "subtitulo='$servicio->subtitulo', ciudad='$servicio->ciudad', descripcion_corta='$servicio->descripcion_corta',"
                . "descripcion_Larga='$servicio->descripcion_larga',imagen='$servicio->imagen',"
                . "icono='$servicio->icono', video='$servicio->video',url_amigable='$servicio->url_amigable',"
                . "texto_boton='$servicio->texto_boton', enlace='$servicio->enlace', nivel='$servicio->nivel',categoria_pagina='$servicio->categoria_pagina',"
                . "idioma='$servicio->idioma',estado='$servicio->estado' WHERE identificador = '$servicio->identificador';");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }

}
