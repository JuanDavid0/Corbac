<?php
class distribuidores {
    public function listar() {
        $conn = new conexionBaseDatosPagina();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM socio ORDER BY ciudad";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }
    public function buscarCiudades() {
        $conn = new conexionBaseDatosPagina();
        $conexion = $conn->connectDB();
        $sql = "SELECT DISTINCT ciudad FROM socio";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    } 
    public function buscarDistribuidor($id) {
        $conn = new conexionBaseDatosPagina();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM socio WHERE identificador = ".$id."";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch();
    }      
    public function filtrarDistribuidor($texto) {
        $conn = new conexionBaseDatosPagina();
        $conexion = $conn->connectDB();
        $sql = "SELECT * FROM socio WHERE ciudad like  '%".$texto."%'  OR nombre Like '%".$texto."%' ";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }  
    public function registrarDistribuidor($nombre, $ciudadFinal) {
        $conn = new conexionBaseDatosPagina();
        $conexion = $conn->connectDB();
        $sql = "INSERT INTO socio (nombre, ciudad)"
                . " VALUES ('".$nombre."','".$ciudadFinal."')";                
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {return 1;} else { return 2;}
    } 
    public function editarDistribuidor($id,$nombre, $ciudadFinal) {
        $conn = new conexionBaseDatosPagina();
        $conexion = $conn->connectDB();
        $sql = "UPDATE socio SET nombre = '".$nombre."', ciudad = '".$ciudadFinal."' WHERE identificador = '".$id."'";                
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {return 1;} else { return 2;}
    }
    public function eliminarDistribuidor($id) {
        $conn = new conexionBaseDatosPagina();
        $conexion = $conn->connectDB();
        $sql = "DELETE FROM socio WHERE identificador = '".$id."'";                
        $consulta = $conexion->prepare($sql);
        if ($consulta->execute()) {return 1;} else { return 2;}
    }                 
}