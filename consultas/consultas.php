<?php

// reseteo de zona horaria del servidor
date_default_timezone_set('America/Bogota');
//========================================================
require_once("conexion/bdconexion.php");

function paginasNivel($nivel, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT identificador, categoria FROM pagina WHERE nivel = '" . $nivel . "'  AND idioma = '" . $idioma . "'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
function paginasCategoria($categoria, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT identificador, categoria FROM pagina WHERE categoria = '" . $categoria . "'  AND idioma = '" . $idioma . "'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
function blogNivel($categoria, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT identificador FROM pagina WHERE categoria = '" . $categoria . "'  AND idioma = '" . $idioma . "'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

//NivelOferta
function ofertaNivel($categoria, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT identificador FROM pagina WHERE categoria = '" . $categoria . "'  AND idioma = '" . $idioma . "'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

function noticiaNivel($categoria, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT identificador FROM pagina WHERE categoria = '" . $categoria . "'  AND idioma = '" . $idioma . "'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
function idiomas($url)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT url FROM idioma WHERE url = '" . $url . "' ";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return  $result;
}

// Funcion para retornar el menu de nivel 1 
function consultaMenu($idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM pagina WHERE estado = 'activo' AND idioma = '" . $idioma . "' AND categoria = '' AND nivel = '1' ORDER BY orden ASC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
// Funcion para verificar si una opcion tiene hijos, esto sirve para poder crear el submenu
function consultaExistenciaHijos($idpadre, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM pagina WHERE categoria_padre = '" . $idpadre . "' AND estado != 'inactivo' AND idioma = '" . $idioma . "' ORDER BY orden ASC";
    // $sql = "SELECT * FROM servicio WHERE nivel = 0 AND estado ='activo' ";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    $rowcount = mysqli_num_rows($result);
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $rowcount;
}
// Funcion para retornar los hijos de una categoria
function consultaMenuHijos($idpadre, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM pagina WHERE estado = 'activo' AND categoria_padre = '" . $idpadre . "' AND idioma = '" . $idioma . "' ORDER BY orden ASC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
// Funcion para consultar los modulos presentes en cada una de las paginas que forman el sitio web, esta función cumple el trabajo de traer los includes en orden ASC y traer el nombre de cada uno de los archivos css correspondientes al modulo.
function consultaModulos($pagina)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT modulo.nombre,js,pagina_modulo.identificador,modulo.identificador FROM pagina_modulo INNER JOIN modulo ON pagina_modulo.identificador_modulo = modulo.identificador WHERE pagina_modulo.identificador_pagina = '" . $pagina . "' AND pagina_modulo.estado = 'activo' ORDER BY pagina_modulo.orden ASC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

// Funcion para traer los meta tags de cada una de las paginas que componen el sitio web
function consultaMetaTags($pagina)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM metatag WHERE id_pagina = '" . $pagina . "'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

function consultaMetaTagsser($pagina)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM metatags WHERE id_pagina = '" . $pagina . "'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}


// Consulta de variables de la tabla general
// Se realiza una consulta completa de todos los datos de general
// 
function consultaGeneral($variable, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    if ($variable == '' || $variable == null) {
        $varsql = '';
    } else {
        $varsql = " AND tipo = '" . $variable . "' ";
    }
    $sql = "SELECT * FROM general WHERE idioma = '" . $idioma . "' AND estado = 'activo'" . $varsql;
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
function consultaGeneralSinIdioma($variable)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    if ($variable == '' || $variable == null) {
        $varsql = '';
    } else {
        $varsql = " AND tipo = '" . $variable . "'";
    }
    $sql = "SELECT * FROM general WHERE  estado = 'activo'" . $varsql;
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
// Funcion para consultar los banner activos de manera aleatoria y validados por fecha.
function consultaBanner($fecha, $pagina, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT imagen, titulo, texto, url, disposicion, texto_boton  FROM banner WHERE idioma = '" . $idioma . "' AND estado = 'activo' AND identificador_pagina = '" . $pagina . "' AND '" . $fecha . "' "
        . "between fecha_inicio and fecha_final ORDER BY orden LIMIT 0,12; ";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    disconnectDB($conexion);
    return $result;
}

function consultarNombrePagina($pagina)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT nombre from pagina where identificador = '" . $pagina . "'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    disconnectDB($conexion);
    return $result;
}

function consultaBanner1($pagina, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM banner WHERE  estado = 'activo' AND identificador_pagina = '" . $pagina . "' AND idioma = '" . $idioma . "' ORDER BY orden LIMIT 0,10; ";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    disconnectDB($conexion);
    return $result;
}
function consultaBullets1($pagina)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT identificador, imagen FROM banner WHERE  estado = 'activo' AND identificador_pagina = '" . $pagina . "' ORDER BY orden LIMIT 0,10; ";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    disconnectDB($conexion);
    return $result;
}

// Funcion para consultar los banner activos de manera aleatoria y validados por fecha
function consultaValidarBanner($fecha)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql1 = "UPDATE banner SET estado = 'activo' WHERE '" . $fecha . "' between fecha_inicio and fecha_final";
    $sql = "UPDATE banner SET estado = 'inactivo' WHERE '" . $fecha . "' NOT between fecha_inicio and fecha_final;";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    if (!$result = mysqli_query($conexion, $sql1)) {
        die(mysqli_error($conexion));
    }
    disconnectDB($conexion);
    return $result;
}

// Funcion para consultar el modulo exacto
function consultaModulo($modulo)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT identificador FROM modulo WHERE nombre = '" . $modulo . "'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    } else {
        $result = mysqli_fetch_array($result);
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result[0];
}

// Funcion para consultar el contenido para cada uno de los modulos
function consultaInfoModulo($modulo, $pagina, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT contenido FROM contenido WHERE identificador_modulo = " . $modulo . " AND  pagina = '" . $pagina . "' AND idioma = '" . $idioma . "' ORDER BY indice ASC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

function consultaInfoModuloGolbal($modulo, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT contenido FROM contenido WHERE identificador_modulo = " . $modulo . " AND idioma = '" . $idioma . "' ORDER BY indice ASC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

// Funcion para traer un testimonio aleatorio para include de testimonio
function consultaTestimonio()
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM testimonio WHERE estado = 'activo' ORDER BY RAND() LIMIT 1";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
//Funcion para consultar las redes soociales por medio de la consulta de la tabla general
function consultaRedes($idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM general WHERE tipo = 'redes' AND idioma = '" . $idioma . "'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
// Funcion para validar si la pagina existe
// si existe el valor de retorno sera 1
// en caso contrario sera 0
// al ser 0 en la plantilla se hara un location a la 404
function consultaExistencia($pagina)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT identificador FROM pagina WHERE identificador = '" . $pagina . "' AND estado = 'activo'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    $rowcount = mysqli_num_rows($result);
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $rowcount;
}

// Funcion para validar si la noticia existe
// si existe el valor de retorno sera 1
// en caso contrario sera 0
// al ser 0 en la plantilla se hara un location a la 404
function consultaExistenciaNoticia($pagina)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT identificador FROM noticia WHERE identificador = '" . $pagina . "' AND estado = 'activo'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    $rowcount = mysqli_num_rows($result);
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $rowcount;
}

// Funcion para consultar las noticias del include de noticias
// esta funcion recibe un parametro de limite para consultar el limite
// maximo de noticias
function consultaNoticiasLim($limite, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM noticia WHERE estado = 'activo' AND idioma = '" . $idioma . "' ORDER BY fecha DESC LIMIT 0," . $limite;
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

// Funcion para consultar las ofertas del include de oferta academica
// esta funcion recibe un parametro de limite para consultar el limite
// maximo de ofertas
function consultaOfertaLim($limite, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM oferta_academica WHERE estado = 'activo' AND idioma = '" . $idioma . "' ORDER BY fecha DESC LIMIT 0," . $limite;
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

// Funcion para consultar las ultimas noticias excepto la noticia en la que 
// se esta en ese momento leyendo. 
// esta funcion recibe dos parametros, uno de identificador de la noticia especifica, otro del limite de las noticias que se van a consultar para mostrar
function consultaOtrasNoticias($identificador, $limite, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM noticia WHERE identificador != '" . $identificador . "' AND estado = 'activo' AND idioma = '" . $idioma . "' ORDER BY fecha DESC LIMIT 0," . $limite;
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

// Funcion para consultar la galeria de cualquier include
// esta funcion recibe un parametro que es la pagina a la cual pertenece la galeria, estado = activo
function consultaGaleria($modulo, $pagina, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM galeria WHERE estado = 'activo' AND identificador_pagina = '" . $pagina . "' AND modulo = '" . $modulo . "' AND idioma = '" . $idioma . "' ORDER BY orden ASC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

function consultaGaleriaNoticias($modulo, $pagina, $nombreNoticia, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM galeria WHERE estado = 'activo' AND identificador_pagina = '" . $pagina . "' AND modulo = '" . $modulo . "' AND idioma = '" . $idioma . "' AND nombre = '" . $nombreNoticia . "'ORDER BY orden ASC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
// --------------------------------------------------------
function consultaGaleriaP($pagina)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM galeria WHERE estado = 'activo' AND identificador_pagina = '" . $pagina . "' ORDER BY orden ASC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
function consultaGaleriaPIdioma($pagina, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM galeria WHERE estado = 'activo' AND identificador_pagina = '" . $pagina . "' AND idioma = '" . $idioma . "' ORDER BY orden ASC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
// Funcion para consultar las sub paginas que contiene una pagina principal
// un landing llamando a sus productos hijos
// esta funcion recibe un parametro que es el identificador de pagina padre 
// para poder realizar la consulta
function consultaLanding($pagina)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM pagina WHERE estado = 'activo' AND categoria = '" . $pagina . "' ORDER BY orden ASC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

function consultaServicios($nivel)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM servicio WHERE nivel = " . $nivel . " AND estado != 'inactivo'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

function consultaUrlEspecifico($url, $tabla)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM " . $tabla . " WHERE url_amigable = '" . $url . "' ";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    } else {
        $result = mysqli_fetch_array($result);
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

//Funcion para consultar las noticias segun la ciudad en la que se encuentre el dispositivo. se tomara un maximo de 5 noticias de la ciudad de sesion, 4 noticias globales y N noticias de la ciudad de tunja, un maximo de 9
function consultaNoticias()
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    // Selecciona 5 noticias por ciudad seleccionada ordenadas por la fecha de creacion
    $sql = "SELECT nombre, presentacion, imagen_p, fecha, url_amigable FROM noticia WHERE  estado = 'activo' ORDER BY fecha DESC LIMIT 20";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    disconnectDB($conexion);
    return $result;
}

function consultaNotiRela($url)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    // Selecciona 5 noticias por ciudad seleccionada ordenadas por la fecha de creacion
    $sql = "SELECT * FROM noticia WHERE  estado = 'activo' AND url_amigable != '" . $url . "' ORDER BY fecha DESC LIMIT 5";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    disconnectDB($conexion);
    return $result;
}
function consultaSubServicios($categoria, $limite)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM servicio WHERE estado = 'activo' AND categoria_pagina = '" . $categoria . "' LIMIT 0," . $limite;
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
function obtenerCategoria($url)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT titulo FROM servicio WHERE url_amigable = '" . $url . "' ";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    } else {
        $result = mysqli_fetch_array($result);
    }
    disconnectDB($conexion);
    return $result[0];
}
function consultaCiudadDistribuidores()
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT DISTINCT ciudad FROM socio ORDER BY ciudad ASC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
function consultaDistribuidores($ciudad)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM socio  WHERE ciudad = '" . $ciudad . "' ORDER BY ciudad DESC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}
function consultaServiciosP($pagina, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    // $sql = "SELECT * FROM servicio WHERE estado = 'activo' AND categoria = '" . $pagina ."' AND idioma = '". $idioma ."'";
    $sql = "SELECT * FROM servicio WHERE estado = 'activo' AND categoria_pagina = '" . $pagina . "' AND idioma = '" . $idioma . "'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}


function consultaPago($pagina, $idioma)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM pago WHERE estado = 'activo' AND id_servicio = '" . $pagina . "' AND idioma = '" . $idioma . "' ORDER BY orden ASC";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}


function consultaConvenios()
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM convenio WHERE estado = 'activo'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

function consultaInfoLanding($pagina, $idioma, $fecha)
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM landing WHERE estado = 'activo' and fecha_fin > '" . $fecha . "' and pagina = '" . $pagina . "' and idioma = '" . $idioma . "'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

function consultaInfoEstudiantes()
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM estudiantes WHERE estado = 'activo'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

function consultaInfoNormativas()
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM normativas";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

function consultaInfoAulas()
{
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM aulas_virtuales WHERE estado = 'activo'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    //desconectamos la base de datos
    disconnectDB($conexion);
    return $result;
}

function consultaInfoCorporativa() {
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM infromacion_corporativa WHERE estado = 'activo'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    disconnectDB($conexion);
    return $result;
}

function consultaPreguntasFrecuentes() {
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    $sql = "SELECT * FROM preguntas_frecuentes WHERE estado = 'activo'";
    if (!$result = mysqli_query($conexion, $sql)) {
        die(mysqli_error($conexion));
    }
    disconnectDB($conexion);
    return $result;
}
