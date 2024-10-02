<?php

// reseteo de zona horaria del servidor
date_default_timezone_set('America/Bogota');

//========================================================
class pagina {

    function paginasNivel($nivel) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT identificador FROM pagina WHERE nivel = '" . $nivel . "'");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetchAll();
    }

    function usuariosPagina($con) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT tipo_usuario  FROM pagina WHERE identificador = '" . $con . "'");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetch();
    }

    function categoriaPagina($pagina) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT categoria FROM pagina WHERE identificador = '" . $pagina . "'");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetch(0);
    }

// Funcion para retornar el menu de nivel 1 
    function consultaMenu() {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT identificador, nombre, imagen_p, categoria FROM pagina WHERE estado = 'activo' AND gerarquia = 1 AND nivel = 0 ORDER BY orden");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetchAll();
    }

// Funcion para consultar los modulos presentes en cada una de las paginas que forman el sitio web, esta función cumple el trabajo de traer los includes en orden ASC y traer el nombre de cada uno de los archivos css correspondientes al modulo.
    function consultaModulos($pagina) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT modulo.nombre,js,pagina_modulo.identificador,modulo.identificador FROM pagina_modulo INNER JOIN modulo ON pagina_modulo.identificador_modulo = modulo.identificador WHERE pagina_modulo.identificador_pagina = '" . $pagina . "' AND pagina_modulo.estado = 'activo' ORDER BY pagina_modulo.orden ASC");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetchAll();
    }

// Funcion para traer los meta tags de cada una de las paginas que componen el sitio web
    function consultaMetaTags($pagina) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT * FROM metatag WHERE id_pagina = '" . $pagina . "'");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetch();
    }

// Consulta de variables de la tabla general
    function consultaGeneral($variable) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        if ($variable == '' || $variable == null) {
            $varsql = '';
        } else {
            $varsql = " AND tipo = '" . $variable . "'";
        }
        $sql = $conexion->prepare("SELECT * FROM general WHERE estado = 'activo'" . $varsql);
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetchAll();
    }

// Funcion para consultar el modulo exacto
    function consultaModulo($modulo) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT identificador FROM modulo WHERE nombre = '" . $modulo . "'");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetch();
    }

// Funcion para consultar el contenido para cada uno de los modulos
    function consultaInfoModulo($modulo, $pagina) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT contenido FROM contenido WHERE identificador_modulo = " . $modulo . " AND  pagina = '" . $pagina . "' ORDER BY indice ASC");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetchAll();
    }

    function consultaInfoModuloGolbal($modulo) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT contenido FROM contenido WHERE identificador_modulo = " . $modulo . " ORDER BY indice ASC");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetchAll();
    }

// Funcion para validar si la pagina existe
// si existe el valor de retorno sera 1
// en caso contrario sera 0 -> al ser 0 en la plantilla se hara un location a la 404
    function consultaExistencia($pagina) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT identificador FROM pagina WHERE identificador = '" . $pagina . "' AND estado = 'activo'");
        $sql->execute();
        $rowcount = $sql->rowCount();
        $objConexion->disconnectDB($conexion);
        return $rowcount;
    }

// Funcion para consultar la galeria de cualquier include
// esta funcion recibe un parametro que es la pagina a la cual pertenece la galeria, estado = activo
    function consultaGaleria($modulo, $pagina) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT * FROM galeria WHERE estado = 'activo' AND identificador_pagina = '" . $pagina . "' AND modulo = '" . $modulo . "' ORDER BY orden ASC");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetchAll();
    }

    function consultaUrlEspecifico($url, $tabla) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT * FROM " . $tabla . " WHERE url_amigable = '" . $url . "' ");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetch();
    }
    /**
    CLASES PARA CRUD DE PAGINAS MODIFICACION DE CONTENIDO Y DEMAS    
    */    
    static function paginasNivel1($tabla) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT * FROM $tabla WHERE estado = 'activo' AND gerarquia = 0 AND nivel = '1' ORDER BY orden ASC");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetchAll();
    }
    static function modulosPaginaNivel1($tabla, $pagina) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT * FROM $tabla WHERE estado = 'activo' AND identificador_pagina = '$pagina'"
                . "AND NOT orden = 99 AND NOT orden = 0 AND NOT identificador_modulo = 182 ORDER BY orden ASC");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetchAll();
    }
    static function contenidoModulosPaginaNivel1($tabla, $pagina, $id_modulo) {
        $objConexion = new conexionBaseDatosPagina();
        $conexion = $objConexion->connectDB();
        $sql = $conexion->prepare("SELECT * FROM $tabla WHERE estado = 'activo' AND identificador_pagina = '$pagina' AND modulo = '$id_modulo' ORDER BY orden ASC");
        $sql->execute();
        $objConexion->disconnectDB($conexion);
        return $sql->fetchAll();
    }
}