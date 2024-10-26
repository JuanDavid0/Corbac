<?php
require_once "conexion.php";

class Banner
{

    public $identificador;
    public $identificador_pagina;
    public $imagen;
    public $alt;
    public $titulo;
    public $texto;
    public $texto_boton;
    public $url;
    public $fecha_inicio;
    public $fecha_final;
    public $orden;
    public $disposicion;
    public $estado;
    public $idioma;

    static function listarBanner($tabla)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador_pagina = 'inicio' order by orden";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscarBanner($tabla, $banner)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$banner->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function eliminarBanner($tabla, $banner)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "DELETE  FROM $tabla WHERE identificador = '$banner->identificador'";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }
    static function crearBanner($tabla, $banner)
    {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $sql = "INSERT INTO $tabla (identificador_pagina, imagen, alt, titulo, texto, 
            texto_boton, url, fecha_inicio, fecha_final, orden, disposicion, estado, idioma) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $consulta = $stmt->prepare($sql);
        if ($consulta->execute([
            $banner->identificador_pagina,
            $banner->imagen,
            $banner->alt,
            $banner->titulo,
            $banner->texto,
            $banner->texto_boton,
            $banner->url,
            $banner->fecha_inicio,
            $banner->fecha_final,
            $banner->orden,
            $banner->disposicion,
            $banner->estado,
            $banner->idioma
        ])) {
            return 1;
        } else {
            return 0;
        }
    }

    // Editar un Banner existente
    static function editarBanner($tabla, $banner)
    {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $sql = "UPDATE $tabla SET 
            imagen = :imagen,
            alt = :alt,
            titulo = :titulo,
            texto = :texto,
            texto_boton = :texto_boton,
            url = :url,
            fecha_inicio = :fecha_inicio,
            fecha_final = :fecha_final,
            disposicion = :disposicion,
            orden = :orden,
            estado = :estado,
            idioma = :idioma
            WHERE identificador = :identificador";
        $consulta = $stmt->prepare($sql);
        $consulta->bindParam(':imagen', $banner->imagen);
        $consulta->bindParam(':alt', $banner->alt);
        $consulta->bindParam(':titulo', $banner->titulo);
        $consulta->bindParam(':texto', $banner->texto);
        $consulta->bindParam(':texto_boton', $banner->texto_boton);
        $consulta->bindParam(':url', $banner->url);
        $consulta->bindParam(':fecha_inicio', $banner->fecha_inicio);
        $consulta->bindParam(':fecha_final', $banner->fecha_final);
        $consulta->bindParam(':disposicion', $banner->disposicion);
        $consulta->bindParam(':orden', $banner->orden);
        $consulta->bindParam(':estado', $banner->estado);
        $consulta->bindParam(':idioma', $banner->idioma);
        $consulta->bindParam(':identificador', $banner->identificador, PDO::PARAM_INT);

        if ($consulta->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    static function paginasDisponibles()
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT identificador, nombre 
                FROM pagina
                WHERE ARCHIVO IN ('index', 'inicio') 
                OR CATEGORIA = 'servicio'
                AND estado = 'activo'
                order by nombre";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function noticiasDisponibles()
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT url_amigable, nombre FROM noticia WHERE estado = 'activo' order by nombre";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function ofertasDisponibles()
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT url_amigable, nombre FROM oferta_academica WHERE estado = 'activo' order by nombre";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }


}
