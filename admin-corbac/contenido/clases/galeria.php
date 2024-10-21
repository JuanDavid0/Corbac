<?php

/**
 * Description of Banner
 * @author CAFFI SAS
 * Andres Nicolas Lopez Robles
 */
require_once "conexion.php";

class Galeria
{
    public $identificador;
    public $identificador_pagina;
    public $modulo;
    public $nombre;
    public $clase;
    public $imagen;
    public $imagen_p;
    public $alt;
    public $url;
    public $texto;
    public $texto_s;
    public $orden;
    public $estado;
    public $idioma;
    public $fecha;

    static function listarGaleria($tabla, $identificador_pagina)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador_pagina = '$identificador_pagina' ORDER BY orden DESC  ";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscarGaleria($tabla, $galeria)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$galeria->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function eliminarGaleria($tabla, $galeria)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "DELETE  FROM $tabla WHERE identificador = '$galeria->identificador'";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }
    static function crearGaleria($tabla, $galeria)
    {
        try {
            $conn = new Conexion();
            $stmt = $conn->connectDB();
            $consulta = $stmt->prepare("
                INSERT INTO $tabla (
                    identificador_pagina, modulo, nombre, clase, imagen, imagen_p, alt, 
                    url, texto, texto_s, orden, estado, idioma, fecha
                ) 
                VALUES (
                    :identificador_pagina, :modulo, :nombre, :clase, :imagen, :imagen_p, :alt, 
                    :url, :texto, :texto_s, :orden, :estado, :idioma, :fecha
                )
            ");
            $consulta->bindParam(':identificador_pagina', $galeria->identificador_pagina);
            $consulta->bindParam(':modulo', $galeria->modulo);
            $consulta->bindParam(':nombre', $galeria->nombre);
            $consulta->bindParam(':clase', $galeria->clase);
            $consulta->bindParam(':imagen', $galeria->imagen);
            $consulta->bindParam(':imagen_p', $galeria->imagen_p);
            $consulta->bindParam(':alt', $galeria->alt);
            $consulta->bindParam(':url', $galeria->url);
            $consulta->bindParam(':texto', $galeria->texto);
            $consulta->bindParam(':texto_s', $galeria->texto_s);
            $consulta->bindParam(':orden', $galeria->orden);
            $consulta->bindParam(':estado', $galeria->estado);
            $consulta->bindParam(':idioma', $galeria->idioma);
            $consulta->bindParam(':fecha', $galeria->fecha);
    
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
            error_log("Error al crear galería: " . $e->getMessage());
            return 0; // Error
        }
    }
    

    static function noticiasDisponibles($tabla)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT url_amigable, nombre FROM $tabla WHERE estado = 'activo'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }
}
