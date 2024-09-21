<?php
define('METHOD', 'AES-256-CBC');
 function encriptar($informacion) {
        //para que la salida sean datos hexagecimales
        $output = FALSE;
        $key = hash('sha256', 'megaproyectos.com.co');
        //devuelve un caracter del string
        $iv = substr(hash('sha256', 'megaproyectos.com.co'), 0, 16);
        //encripta los dato 
        $output = openssl_encrypt($informacion, METHOD, $key, 0, $iv);
        //codificar en base 64 
        $output = base64_encode($output);
        return $output;
    }