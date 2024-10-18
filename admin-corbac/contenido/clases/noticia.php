<?php
require_once "conexion.php";

class Noticia
{
    public $identificador;
    public $url_amigable;
    public $nombre;
    public $presentacion;
    public $imagen_p;
    public $descripcion;
    public $titulo1;
    public $contenido1;
    public $imagen1;
    public $alt1;
    public $titulo2;
    public $contenido2;
    public $imagen2;
    public $alt2;
    public $video;
    public $tvideo;
    public $cvideo;
    public $fecha;
    public $idioma;
    public $estado;

    static function listarNoticia($tabla)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscarNoticia($tabla, $noticia)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$noticia->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function eliminarNoticia($tabla, $noticia)
    {
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
    static function crearNoticia($tabla, $noticia)
{
    try {
        $conn = new Conexion();
        $stmt = $conn->connectDB();

        // Preparar la consulta con todos los campos de la tabla
        $consulta = $stmt->prepare("
            INSERT INTO $tabla (
                url_amigable, nombre, presentacion, imagen_p, descripcion,
                titulo1, contenido1, imagen1, alt1, 
                titulo2, contenido2, imagen2, alt2, 
                video, tvideo, cvideo, 
                fecha, idioma, estado
            ) 
            VALUES (
                :url_amigable, :nombre, :presentacion, :imagen_p, :descripcion,
                :titulo1, :contenido1, :imagen1, :alt1, 
                :titulo2, :contenido2, :imagen2, :alt2, 
                :video, :tvideo, :cvideo, 
                :fecha, :idioma, :estado
            )
        ");

        // Enlazar los parámetros con los datos del objeto $noticia
        $consulta->bindParam(':url_amigable', $noticia->url_amigable);
        $consulta->bindParam(':nombre', $noticia->nombre);
        $consulta->bindParam(':presentacion', $noticia->presentacion);
        $consulta->bindParam(':imagen_p', $noticia->imagen_p);
        $consulta->bindParam(':descripcion', $noticia->descripcion);
        $consulta->bindParam(':titulo1', $noticia->titulo1);
        $consulta->bindParam(':contenido1', $noticia->contenido1);
        $consulta->bindParam(':imagen1', $noticia->imagen1);
        $consulta->bindParam(':alt1', $noticia->alt1);
        $consulta->bindParam(':titulo2', $noticia->titulo2);
        $consulta->bindParam(':contenido2', $noticia->contenido2);
        $consulta->bindParam(':imagen2', $noticia->imagen2);
        $consulta->bindParam(':alt2', $noticia->alt2);
        $consulta->bindParam(':video', $noticia->video);
        $consulta->bindParam(':tvideo', $noticia->tvideo);
        $consulta->bindParam(':cvideo', $noticia->cvideo);
        $consulta->bindParam(':fecha', $noticia->fecha);
        $consulta->bindParam(':idioma', $noticia->idioma);
        $consulta->bindParam(':estado', $noticia->estado);

        // Ejecutar la consulta
        if ($consulta->execute()) {
            unset($stmt); // Liberar recursos
            return 1; // Éxito
        } else {
            unset($stmt);
            return 0; // Error
        }
    } catch (PDOException $e) {
        // Manejar errores de conexión o ejecución
        error_log("Error al crear noticia: " . $e->getMessage());
        return 0; // Error
    }
}

    static function editarNoticia($tabla, $noticia)
    {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("UPDATE $tabla SET 
            url_amigable = '$noticia->url_amigable',
            nombre = '$noticia->nombre',
            presentacion = '$noticia->presentacion',
            imagen_p = '$noticia->imagen_p',
            descripcion = '$noticia->descripcion',
            titulo1 = '$noticia->titulo1',
            contenido1 = '$noticia->contenido1',
            imagen1 = '$noticia->imagen1',
            alt1 = '$noticia->alt1',
            titulo2 = '$noticia->titulo2',
            contenido2 = '$noticia->contenido2',
            imagen2 = '$noticia->imagen2',
            alt2 = '$noticia->alt2',
            video = '$noticia->video',
            tvideo = '$noticia->tvideo',
            cvideo = '$noticia->cvideo',
            fecha = '$noticia->fecha',
            idioma = '$noticia->idioma',
            estado = '$noticia->estado'
            WHERE identificador = '$noticia->identificador';");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }
}