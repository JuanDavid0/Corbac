<?php
class prueba{
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

public function agregarUsuarioManual() {
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
}


}