<?php

require_once "conexion.php";

class Landing
{
    public $identificador;
    public $pagina;
    public $indice;
    public $titulo;
    public $subTitulo;
    public $contenido;
    public $cta1;
    public $cta2;
    public $promesa1;
    public $promesa2;
    public $logo;
    public $image1;
    public $image2;
    public $fecha_inicio;
    public $fecha_fin;
    public $idioma;
    public $estado;

    static function listaLanding($tabla)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    static function buscaLanding($tabla, $landing)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM $tabla WHERE identificador = '$landing->identificador'";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }

    static function editarLanding($tabla, $landing)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "UPDATE $tabla SET pagina = :pagina, indice = :indice, titulo = :titulo, subTitulo = :subTitulo, contenido = :contenido, cta1 = :cta1, 
            cta2 = :cta2, promesa1 = :promesa1, promesa2 = :promesa2, logo = :logo, image1 = :image1, image2 = :image2, fecha_inicio = :fecha_inicio,
            fecha_fin = :fecha_fin, idioma = :idioma, estado = :estado WHERE identificador = :identificador";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':pagina', $landing->pagina);
        $consulta->bindParam(':indice', $landing->indice);
        $consulta->bindParam(':titulo', $landing->titulo);
        $consulta->bindParam(':subTitulo', $landing->subTitulo);
        $consulta->bindParam(':contenido', $landing->contenido);
        $consulta->bindParam(':cta1', $landing->cta1);
        $consulta->bindParam(':cta2', $landing->cta2);
        $consulta->bindParam(':promesa1', $landing->promesa1);
        $consulta->bindParam(':promesa2', $landing->promesa2);
        $consulta->bindParam(':logo', $landing->logo);
        $consulta->bindParam(':image1', $landing->image1);
        $consulta->bindParam(':image2', $landing->image2);
        $consulta->bindParam(':fecha_inicio', $landing->fecha_inicio);
        $consulta->bindParam(':fecha_fin', $landing->fecha_fin);
        $consulta->bindParam(':idioma', $landing->idioma);
        $consulta->bindParam(':estado', $landing->estado);
        $consulta->bindParam(':identificador', $landing->identificador);
        if ($consulta->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    static function crearLanding($tabla, $landing)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "INSERT INTO $tabla (pagina, indice, titulo, subTitulo, contenido, cta1, 
            cta2, promesa1, fecha_inicio,
            fecha_fin, idioma, estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute([
            $landing->pagina,
            $landing->indice,
            $landing->titulo,
            $landing->subTitulo,
            $landing->contenido,
            $landing->cta1,
            $landing->cta2,
            $landing->promesa1,
            $landing->fecha_inicio,
            $landing->fecha_fin,
            $landing->idioma,
            $landing->estado
        ])) {
            return 1;
        } else {
            return 0;
        }
    }

    static function eliminarLanding($tabla, $landing)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "DELETE  FROM $tabla WHERE identificador = '$landing->identificador'";
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {
            unset($conexion);
            return 1;
        } else {
            unset($conexion);
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
