<?php
/**
 * Description of conexion
 *
 * @author Anbu Business Group SAS
 */
class Conexion {

    private $servidor;
    private $usuario;
    private $pass;
    private $bd;

    
    public function __construct() {
        $this->servidor = "localhost";
        $this->usuario  = "root";
        $this->pass = "1234";        
        $this->bd = "corbacdb";
        //$this->bd = "megaproyectos";   
    }

    // public function __construct()
    // {
    //     $this->servidor = "https://auth-db1526.hstgr.io";
    //     $this->usuario  = "u145597152_ucorbac";
    //     $this->pass = "eK3>zq6*U";
    //     $this->bd = "u145597152_bcorbac";
    // }

    public function connectDB() {
        $codificacion ="SET NAMES \"UTF8\"";
        $cadena = "mysql:host={$this->servidor};dbname={$this->bd};";
        $arreglo = array(PDO::MYSQL_ATTR_INIT_COMMAND=>$codificacion);
        $conn = new PDO($cadena, $this->usuario, $this->pass,$arreglo);
        return $conn;    
    }
// Desconectar
    function disconnectDB(&$conexion) {
        $conexion = null;
    }
}
