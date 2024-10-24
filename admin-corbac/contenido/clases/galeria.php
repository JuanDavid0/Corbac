<?php
require_once "conexion.php";

class Galeria
{
    public $identificador;
    public $identificador_pagina;
    public $modulo;
    public $nombre;
    public $imagen;
    public $alt;
    public $texto;
    public $orden;
    public $estado;
    public $idioma;
    public $fecha;

    static function listarGaleria($tabla, $noticia = null)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();

        // Modificar la consulta para filtrar correctamente por noticia si se pasa una
        if ($noticia) {
            $sql = "SELECT * FROM $tabla WHERE estado = 'activo' AND nombre = :noticia AND identificador_pagina = 'noticia' ORDER BY orden DESC";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':noticia', $noticia, PDO::PARAM_STR);
        } else {
            $sql = "SELECT * FROM $tabla WHERE estado = 'activo' AND identificador_pagina = 'noticia' ORDER BY orden DESC";
            $consulta = $conexion->prepare($sql);
        }

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
                    identificador_pagina, modulo, nombre, imagen, alt, texto, orden, estado, fecha, idioma
                ) 
                VALUES (
                    :identificador_pagina, :modulo, :nombre, :imagen, :alt, 
                     :texto, :orden, :estado, :fecha, :idioma
                )
            ");
            $consulta->bindParam(':identificador_pagina', $galeria->identificador_pagina);
            $consulta->bindParam(':modulo', $galeria->modulo);
            $consulta->bindParam(':nombre', $galeria->nombre);
            $consulta->bindParam(':imagen', $galeria->imagen);
            $consulta->bindParam(':alt', $galeria->alt);
            $consulta->bindParam(':texto', $galeria->texto);
            $consulta->bindParam(':orden', $galeria->orden);
            $consulta->bindParam(':estado', $galeria->estado);
            $consulta->bindParam(':fecha', $galeria->fecha);
            $consulta->bindParam(':idioma', $galeria->idioma);

            // Ejecutar la consulta
            if ($consulta->execute()) {
                unset($stmt); // Liberar recursos
                return 1; // Éxito
            } else {
                unset($stmt);
                return 2; // Error
            }
        } catch (PDOException $e) {
            // Manejar errores de conexión o ejecución
            error_log("Error al crear galería: " . $e->getMessage());
            return 2; // Error
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
