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
        $sql = "SELECT * FROM $tabla WHERE identificador_pagina = 'inicio'";
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
    $consulta = $stmt->prepare("INSERT INTO $tabla (identificador_pagina, 
        imagen, alt, titulo, texto, 
        texto_boton, url, fecha_inicio, fecha_final, orden,
        disposicion, estado, idioma) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
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
        unset($stmt);
        return 1; 
    } else {
        unset($stmt);
        return 0;
    }
}

    static function editarBanner($tabla, $banner)
    {
        $conn = new Conexion();
        $stmt = $conn->connectDB();
        $consulta = $stmt->prepare("UPDATE $tabla SET 
            imagen = '$banner->imagen',
            alt = '$banner->alt',
            titulo = '$banner->titulo',
            texto = '$banner->texto',
            texto_boton = '$banner->texto_boton',
            url = '$banner->url',
            fecha_inicio = '$banner->fecha_inicio',
            fecha_final = '$banner->fecha_final',
            estado = '$banner->estado',
            idioma = '$banner->idioma'
            WHERE identificador = '$banner->identificador';");
        if ($consulta->execute()) {
            unset($stmt);
            return 1;
        } else {
            unset($stmt);
            return 0;
        }
    }
}