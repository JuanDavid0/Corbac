<?php
class conexionBaseDatosPagina {
    private $servidor;
    private $usuario;
    private $pass;
    private $bd;
    public function __construct(){
        $this->servidor = "localhost";
        $this->usuario  = "root";
        $this->pass = "root";        
        // $this->bd = "megapro";   
        $this->bd = "corbac";
    }    
    public function connectDB() {
        $codificacion ="SET NAMES \"UTF8\"";
        $cadena = "mysql:host={$this->servidor};dbname={$this->bd};";
        $arreglo = array(PDO::MYSQL_ATTR_INIT_COMMAND=>$codificacion);
        $conn = new PDO($cadena, $this->usuario, $this->pass,$arreglo);
        return $conn;    
    }
    function disconnectDB(&$conexion) {
       $conexion = null;
    }    
}