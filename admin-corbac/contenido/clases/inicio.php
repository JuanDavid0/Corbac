<?php

/**
 * Description of Banner
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
require_once "conexion.php";

class Inicio {

    static function listarVisitantesXMes() {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT COUNT( * ) AS cantidad , MONTH( fecha ) AS mes , YEAR( fecha ) AS anio FROM `visitas` GROUP BY MONTH( fecha) ORDER BY fecha ASC Limit 12;";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }
    static function listarCiudades() {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT COUNT( * ) AS cantidad , ciudad FROM `visitas` GROUP BY ciudad ORDER BY cantidad DESC Limit 5;";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }
    static function totalVisitas() {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT COUNT( * ) AS cantidad  FROM visitas ";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }
    static function totalRegistros() {
        $conn = new Conexion();
        $conexion = $conn->connectDB();
        $sql = "SELECT COUNT( * ) AS cantidad  FROM correo WHERE estado = 'suscrito'; ";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }
}
