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
        $sql = $conexion->prepare("SELECT * FROM oferta_academica WHERE estado = 'activo' AND oferta_padre = :oferta_padre");
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
        $sql = $conexion->prepare("INSERT INTO $tabla (url_amigable, nombre, imagen_p, oferta_padre, fecha, idioma, estado)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (
            $sql->execute([
                $oferta->url_amigable,
                $oferta->nombre,
                $oferta->imagen_p,
                $oferta->oferta_padre,
                $oferta->fecha,
                $oferta->idioma,
                $oferta->estado
            ])
        ) {
            self::crearPagina($oferta);
            self::crearModuloPagina($oferta);
            return 1;
        } else {
            return 0;
        }
    }

    static function crearPagina($oferta)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = $conexion->prepare("INSERT INTO pagina ( identificador, nombre, fecha, categoria, nivel, orden, estado, archivo, destacado, idioma)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (
            $sql->execute([
                $oferta->url_amigable,
                $oferta->nombre,
                $oferta->fecha,
                'oferta',
                1,
                1,
                'activo',
                'inicio',
                0,
                'es'
            ])
        ) {
            return 1;
        } else {
            return 0;
        }
    }

    static function crearModuloPagina($oferta)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();

        $sql = $conexion->prepare("INSERT INTO pagina_modulo (identificador_pagina, identificador_modulo, orden, estado)
            VALUES (?, ?, ?, ?)");
        $success1 = $sql->execute([
            $oferta->url_amigable,
            1,
            1,
            'activo'
        ]);
        $success2 = $sql->execute([
            $oferta->url_amigable,
            129,
            99,
            'activo'
        ]);
        $success3 = $sql->execute([
            $oferta->url_amigable,
            3,
            2,
            'activo'
        ]);
        $success4 = $sql->execute([
            $oferta->url_amigable,
            147,
            3,
            'activo'
        ]);
        $sucess5 = $sql->execute([
            $oferta->url_amigable,
            123,
            10,
            'activo'
        ]);
        if ($success1 && $success2 && $success3 && $success4 && $sucess5) {
            return 1;
        } else {
            return 0;
        }
    }

    static function crearOfertaEspecifica($tabla, $oferta)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "INSERT INTO $tabla (url_amigable, nombre, imagen_p, descripcion, contenido1, contenido_duracion, contenido_modalidad, contenido_aprobado, imagen1, alt1, contenido2, imagen2, alt2, contenido3, plan_enlace, contenido4, contenido5, oferta_padre, fecha, idioma, estado) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $consulta = $conexion->prepare($sql);
        if (
            $consulta->execute([
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
                $oferta->idioma,
                $oferta->estado
            ])
        ) {
            return 1;
        } else {
            return 0;
        }
    }

    static function editarOferta($tabla, $oferta)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();

        $sql = $conexion->prepare("UPDATE $tabla SET 
        nombre = :nombre, 
        imagen_p = :imagen_p, 
        oferta_padre = :oferta_padre, 
        fecha = :fecha, 
        idioma = :idioma, 
        estado = :estado 
        WHERE identificador = :identificador");
        $sql->bindParam(':nombre', $oferta->nombre);
        $sql->bindParam(':imagen_p', $oferta->imagen_p);
        $sql->bindParam(':oferta_padre', $oferta->oferta_padre);
        $sql->bindParam(':fecha', $oferta->fecha);
        $sql->bindParam(':idioma', $oferta->idioma);
        $sql->bindParam(':estado', $oferta->estado);
        $sql->bindParam(':identificador', $oferta->identificador);
        if ($sql->execute()) {
            self::editarPagina($oferta);
            return 1;
        } else {
            return 0;
        }
    }

    static function editarPagina($oferta) {
        $conn = new Conexion();
        $conexion = $conn->connectDB();

        $categoria = 'oferta';
        $nivel = 1;
        $orden = 1;
        $estado = 'activo';
        $archivo = 'inicio';
        $destacado = 0;
        $idioma = 'es';

        $sql = $conexion->prepare("UPDATE pagina SET
        nombre = :nombre,
        fecha = :fecha,
        categoria = :categoria,
        nivel = :nivel,
        orden = :orden,
        estado = :estado,
        archivo = :archivo,
        destacado = :destacado,
        idioma = :idioma
        WHERE identificador = :identificador");
        $sql->bindParam(':nombre', $oferta->nombre);
        $sql->bindParam(':fecha', $oferta->fecha);
        $sql->bindParam(':categoria', $categoria);
        $sql->bindParam(':nivel', $nivel);
        $sql->bindParam(':orden', $orden);
        $sql->bindParam(':estado', $estado);
        $sql->bindParam(':archivo', $archivo);
        $sql->bindParam(':destacado', $destacado);
        $sql->bindParam(':idioma', $idioma);
        $sql->bindParam(':identificador', $oferta->url_amigable);

        if ($sql->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    static function editarOfertaEspecifica($tabla, $oferta)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();

        $sql = $conexion->prepare("UPDATE $tabla SET 
        url_amigable = :url_amigable,
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
        WHERE identificador = :identificador");

        $sql->bindParam(':url_amigable', $oferta->url_amigable);
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
        $sql->bindParam(':identificador', $oferta->identificador);

        if ($sql->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    static function eliminarOfertaEspecifica($tabla, $oferta)
    {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = $conexion->prepare("DELETE FROM $tabla WHERE identificador = :identificador");
        $sql->bindParam(':identificador', $oferta->identificador);
        if ($sql->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}