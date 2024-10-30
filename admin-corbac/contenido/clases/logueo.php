<?php
date_default_timezone_set("America/Bogota");
define('METHOD', 'AES-256-CBC');
class logueo {

    public function iniciarSesion($usuario, $contrasena) { 
        $fehcaServidor = getdate(time());
        $fecha = "".$fehcaServidor['year']."-".$fehcaServidor['mon']."-".$fehcaServidor['mday']."-".$fehcaServidor['hours']."-".$fehcaServidor['minutes']."-".$fehcaServidor['seconds'];
        $conn = new conexionBaseDatosPagina();
        $objLogue = new logueo();
        $nuevaContra = $objLogue->encriptar($contrasena."anbu", $contrasena);   
        $conexion = $conn->connectDB();
        $sql = "SELECT tipo FROM admin_users WHERE correo = '" . $usuario . "' AND contrasena = '" . $nuevaContra . "' AND estado = 'Activo'; ";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        $resultados =$consulta->fetch();               
        if ($resultados != false) {        
            $filas = $resultados['tipo'];                                         
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['tipo'] = $filas;
            $_SESSION['fecha'] = $fecha;
            $_SESSION['ultimaHora'] = time();
            return $objLogue->redireccion($filas);            
        } else {
            return "999";
        }
    }
    public function cerrarSesion() {        
        session_start();
        session_destroy();        
    }    
    
    public function encriptar($informacion, $cedula) {
        //para que la salida sean datos hexagecimales
        $output = FALSE;
        $key = hash('sha256', $cedula);
        //devuelve un caracter del string
        $iv = substr(hash('sha256', $cedula), 0, 16);
        //encripta los dato 
        $output = openssl_encrypt($informacion, METHOD, $key, 0, $iv);
        //codificar en base 64 
        $output = base64_encode($output);
        return $output;
    }   
    public function redireccion($texto) {
        $resultado = "";
        switch ($texto) {
            case "": $resultado = "999"; break;
            case "Administrador": $resultado = "inicioadmin"; break;            
            default: $resultado = "999";
        }
        return $resultado;
    }

  // borrar 
  /*public function agregarUsuarioManual() {
    $usuario = "admin@gmail.com";
    $contrasena = "123456";

    $contrasenaEncriptada = $this->encriptar($contrasena . "anbu", $contrasena);
    $conn = new conexionBaseDatosPagina();
    $conexion = $conn->connectDB();

    $sql = "INSERT INTO log_adminx (correo, contrasena, tipo, estado) VALUES (:correo, :contrasena, :tipo, :estado)";
    $consulta = $conexion->prepare($sql);
    $consulta->bindParam(':correo', $usuario);
    $consulta->bindParam(':contrasena', $contrasenaEncriptada);
    $consulta->bindParam(':tipo', $tipo);
    $consulta->bindParam(':estado', $estado);

    $tipo = "Administrador"; // o cualquier otro tipo que necesites
    $estado = "Activo"; // puedes cambiar el estado según tus necesidades

    if ($consulta->execute()) {
        echo "Usuario registrado con éxito.";
    } else {
        echo "Hubo un error al registrar el usuario.";
    }
}*/
}