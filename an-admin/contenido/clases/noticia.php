<?php

/**
 * Description of Banner
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
require_once "conexion.php";

class Noticia {

    public $identificador;
    public $url_amigable;
    public $descripcion;
    public $nombre;
    public $presentacion;
    public $contenido;
    public $video;
    public $tvideo;
    public $cvideo;
    public $imagen_p;
    public $imagen;
    public $alt;
    public $fecha;
    public $idioma;    
    public $estado;

    static function listarNoticia($tabla) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscarNoticia($tabla, $noticia) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$noticia->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function eliminarNoticia($tabla, $noticia) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "DELETE  FROM $tabla WHERE identificador = '$noticia->identificador'";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }
    static function crearNoticia($tabla, $noticia) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("INSERT INTO $tabla ( url_amigable, descripcion,"
                . " titulo, presentacion, contenido, video, tvideo, cvideo,"
                . " imagen_p, imagen, alt, fecha, idioma, estado) "
                . " VALUES ('$noticia->url_amigable','$noticia->descripcion','$noticia->nombre',"
                . "'$noticia->presentacion', '$noticia->contenido', '$noticia->video', '$noticia->tvideo', "
                . "'$noticia->cvideo' ,'$noticia->imagen_p', '$noticia->imagen', "
                . "'$noticia->alt', '$noticia->fecha', '$noticia->idioma', "
                . "'$noticia->estado'); ");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }

    static function editarNoticia($tabla, $noticia) {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("UPDATE $tabla SET url_amigable = '$noticia->url_amigable',"
                . "descripcion = '$noticia->descripcion', titulo = '$noticia->nombre', "
                . "presentacion = '$noticia->presentacion', contenido = '$noticia->contenido',"
                . "cvideo = '$noticia->cvideo', imagen_p = '$noticia->imagen_p',"
                . "imagen = '$noticia->imagen', alt = '$noticia->alt',"
                . "fecha = '$noticia->fecha', idioma = '$noticia->idioma',"
                . "estado = '$noticia->estado' WHERE identificador = '$noticia->identificador';");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }
}