<?php

/**
 * Description of controladorBanner
 *
 * @author Anbu Business Group SAS
 * Andres Nicolas Lopez Robles
 */
class ControladorUsuario
{

    public static function crearUsuario($usuario)
    {
        $tabla = "admin_users";
        $respuesta = Usuario::crearUsuario($tabla, $usuario);
        return $respuesta;
    }
    public static function editarUsuario($usuario)
    {
        $tabla = "admin_users";
        $respuesta = Usuario::editarUsuario($tabla, $usuario);
        return $respuesta;
    }
    public static function buscarUsuario($usuario)
    {
        $tabla = "admin_users";
        $respuesta = Usuario::buscarUsuario($tabla, $usuario);
        return $respuesta;
    }
    public static function eliminarUsuario($usuario)
    {
        $tabla = "admin_users";
        $respuesta = Usuario::eliminarUsuario($tabla, $usuario);
        return $respuesta;
    }
    public static function encriptarUsuario($usuario)
    {
        $respuesta = Usuario::encriptarUsuario($usuario);
        return $respuesta;
    }
}
