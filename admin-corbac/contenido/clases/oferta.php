<?php
require_once "conexion.php";

class oferta
{
    public $identificador;
    public $url_amigable;
    public $nombre;
    public $imagen_p;
    public $descripcion;
    public $contenido1;
    public $contenido_duracion;
    public $contenido_modalidad;
    public $contenido_aprobado;
    public $imagen1;
    public $alt1;
    public $contenido2;
    public $imagen2;
    public $alt2;
    public $contenido3;
    public $plan_enlace;
    public $contenido4;
    public $contenido5;
    public $oferta_padre;
    public $fecha;
    public $idioma;
    public $estado;

    static function cargarOfertaPadre()
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = $conexion->prepare("SELECT * FROM oferta_academica WHERE estado = 'activo' AND oferta_padre IS NULL");
        $sql->execute();
        return $sql->fetchAll();
    }

    static function cargarOfertaHija($oferta_padre)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        // Utilizamos un placeholder en la consulta para evitar errores y posibles inyecciones SQL
        $sql = $conexion->prepare("SELECT * FROM oferta_academica WHERE estado = 'activo' AND oferta_padre = :oferta_padre");
        // Enlazamos el parámetro de manera segura
        $sql->bindParam(':oferta_padre', $oferta_padre, PDO::PARAM_STR);
        $sql->execute();
        return $sql->fetchAll();
    }

    static function buscarOferta($tabla, $oferta)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = $conexion->prepare("SELECT * FROM $tabla WHERE identificador = '$oferta->identificador'");
        $sql->execute();
        return $sql->fetch();
    }

    static function crearOferta($tabla, $oferta)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = $conexion->prepare("INSERT INTO $tabla (url_amigable, nombre, imagen_p, oferta_padre, fecha, estado)
        VALUES (?, ?, ?, ?, ?, ?)");
        if (
            $sql->execute([
                $oferta->url_amigable,
                $oferta->nombre,
                $oferta->imagen_p,
                $oferta->oferta_padre,
                $oferta->fecha,
                $oferta->estado
            ])
        ) {
            unset($conexion);
            return 1;
        } else {
            unset($conexion);
            return 0;
        }
    }

    static function crearOfertaEspecifica($tabla, $oferta)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = $conexion->prepare("INSERT INTO $tabla (url_amigable, nombre, imagen_p, descripcion, contenido1, contenido_duracion, contenido_modalidad, contenido_aprobado, imagen1, alt1, contenido2, imagen2, alt2, contenido3, plan_enlace, contenido4, contenido5, oferta_padre, fecha, estado) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (
            $sql->execute([
                $oferta->url_amigable,
                $oferta->nombre,
                $oferta->imagen_p,
                $oferta->descripcion,
                $oferta->contenido1,
                $oferta->contenido_duracion,
                $oferta->contenido_modalidad,
                $oferta->contenido_aprobado,
                $oferta->imagen1,
                $oferta->alt1,
                $oferta->contenido2,
                $oferta->imagen2,
                $oferta->alt2,
                $oferta->contenido3,
                $oferta->plan_enlace,
                $oferta->contenido4,
                $oferta->contenido5,
                $oferta->oferta_padre,
                $oferta->fecha,
                $oferta->estado
            ])
        ) {
            unset($conexion);
            return 1;
        } else {
            unset($conexion);
            return 0;
        }
    }

    static function editarOferta($tabla, $oferta)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();

        $sql = $conexion->prepare("UPDATE $tabla SET nombre = :nombre, imagen_p = :imagen_p, oferta_padre = :oferta_padre, fecha = :fecha, estado = :estado WHERE url_amigable = :url_amigable");

        $sql->bindParam(':nombre', $oferta->nombre, PDO::PARAM_STR);
        $sql->bindParam(':imagen_p', $oferta->imagen_p, PDO::PARAM_STR);
        $sql->bindParam(':oferta_padre', $oferta->oferta_padre, PDO::PARAM_STR);
        $sql->bindParam(':fecha', $oferta->fecha, PDO::PARAM_STR);
        $sql->bindParam(':estado', $oferta->estado, PDO::PARAM_STR);
        $sql->bindParam(':url_amigable', $oferta->url_amigable, PDO::PARAM_STR);

        if ($sql->execute()) {
            unset($conexion);
            return 1;
        } else {
            unset($conexion);
            return 0;
        }
    }


    static function editarOfertaEspecifica($tabla, $oferta)
{
    $conn = new Conexion();
    $conexion = $conn->connectDB();

    $sql = $conexion->prepare("UPDATE $tabla SET 
        nombre = :nombre, 
        imagen_p = :imagen_p, 
        descripcion = :descripcion, 
        contenido1 = :contenido1, 
        contenido_duracion = :contenido_duracion, 
        contenido_modalidad = :contenido_modalidad, 
        contenido_aprobado = :contenido_aprobado, 
        imagen1 = :imagen1, 
        alt1 = :alt1, 
        contenido2 = :contenido2, 
        imagen2 = :imagen2, 
        alt2 = :alt2, 
        contenido3 = :contenido3, 
        plan_enlace = :plan_enlace, 
        contenido4 = :contenido4, 
        contenido5 = :contenido5, 
        oferta_padre = :oferta_padre, 
        fecha = :fecha, 
        estado = :estado 
        WHERE url_amigable = :url_amigable");

    $sql->bindParam(':nombre', $oferta->nombre);
    $sql->bindParam(':imagen_p', $oferta->imagen_p);
    $sql->bindParam(':descripcion', $oferta->descripcion);
    $sql->bindParam(':contenido1', $oferta->contenido1);
    $sql->bindParam(':contenido_duracion', $oferta->contenido_duracion);
    $sql->bindParam(':contenido_modalidad', $oferta->contenido_modalidad);
    $sql->bindParam(':contenido_aprobado', $oferta->contenido_aprobado);
    $sql->bindParam(':imagen1', $oferta->imagen1);
    $sql->bindParam(':alt1', $oferta->alt1);
    $sql->bindParam(':contenido2', $oferta->contenido2);
    $sql->bindParam(':imagen2', $oferta->imagen2);
    $sql->bindParam(':alt2', $oferta->alt2);
    $sql->bindParam(':contenido3', $oferta->contenido3);
    $sql->bindParam(':plan_enlace', $oferta->plan_enlace);
    $sql->bindParam(':contenido4', $oferta->contenido4);
    $sql->bindParam(':contenido5', $oferta->contenido5);
    $sql->bindParam(':oferta_padre', $oferta->oferta_padre);
    $sql->bindParam(':fecha', $oferta->fecha);
    $sql->bindParam(':estado', $oferta->estado);
    $sql->bindParam(':url_amigable', $oferta->url_amigable);

    if ($sql->execute()) {
        unset($conexion);
        return 1;
    } else {
        unset($conexion);
        return 0;
    }
}

    static function eliminarOfertaEspecifica($tabla, $oferta)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = $conexion->prepare("DELETE FROM $tabla WHERE identificador = '$oferta'->identificador");
        if ($sql->execute()) {
            unset($conexion);
            return 1;
        } else {
            unset($conexion);
            return 0;
        }
    }
}
