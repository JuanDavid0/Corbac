<?php
// Conexion con la bd
include './conexion/ruta.php';
include("consultas/consultas.php");
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
// Conexion con la bd
$comHeader = filter_input(INPUT_GET, 'h', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nuevaCadena = explode("/", $comHeader);
$rutaFinal = retornaRuta();

$rutaFinalNoticias = retornaRutaNoticias();
//LISTA BLANCA URL'S AMIGABLES
// Lista Blanca con una variable
if (count($nuevaCadena) == 1) {
    $idiomas = idiomas($nuevaCadena[0]);
    $idioma = "";
    $con = "";
    while ($resultados = mysqli_fetch_array($idiomas)) {
        if ($nuevaCadena[0] == $resultados['url']) {
            $idioma = $resultados['url'];
            break;
        }
    }
    if ($idioma == "es" || $idioma == "en") {
        $ruta = $rutaFinal . $idioma . "/";
        header("Location: " . $ruta . ($idioma == "en" ? "home" : "inicio"));
    } else {
        $idioma = "es";
        $ruta = $rutaFinal . $idioma . "/";
        header("Location: " . $ruta . "inicio");
    }
} else if (count($nuevaCadena) == 2) {
    echo '<script>console.log(" 2  variables"); </script>';
    $idiomas = idiomas($nuevaCadena[0]);
    $con = "";
    $idioma = "";
    while ($resultadosIdioma = mysqli_fetch_array($idiomas)) {
        if ($nuevaCadena[0] == $resultadosIdioma['url']) {
            $idioma = $resultadosIdioma['url'];
            break;
        }
    }
    if ($idioma == "") {
        $idioma = "es";
    }
    $paginas = paginasNivel(1, $idioma);
    $ruta = $rutaFinal . $idioma . "/";
    while ($resultados = mysqli_fetch_array($paginas)) {
        if ($nuevaCadena[1] == $resultados['identificador']) {
            $con = $resultados['identificador'];
            break;
        }
    }
    //con = thanichiy
    if ($con != "") {
        $con = $resultados['identificador'];
        include './contenido/inicio.php';
    } else {
        if ($idioma == "en") {
            $ruta = $rutaFinal . $idioma . "/";
            header("Location: " . $ruta . "home");
        } else {
            $idioma = "es";
            $ruta = $rutaFinal . $idioma . "/";
            header("Location: " . $ruta . "inicio");
        }
    }
    // Lista Blanca con dos variables
    // [es,inicio,carro]
} else if (count($nuevaCadena) == 3) {
    echo '<script>console.log(" 3  variables"); </script>';
    $idiomas = idiomas($nuevaCadena[0]);
    $con = "";
    $url = $nuevaCadena[2];
    $idioma = "";
    while ($resultadosIdioma = mysqli_fetch_array($idiomas)) {
        if ($nuevaCadena[0] == $resultadosIdioma['url']) {
            $idioma = $resultadosIdioma['url'];
            break;
        }
    }
    if ($idioma == "") {
        $idioma = "es";
    }
    $paginas = paginasNivel(1, $idioma);
    $ruta = $rutaFinal . $idioma . "/";
    while ($resultados = mysqli_fetch_array($paginas)) {
        if ($nuevaCadena[1] == $resultados['identificador']) {
            $con1 = $resultados['categoria'];
            //con1 = servicio (thanichi es una categoria de servicios)
            if ($con1 == "servicio") {
                $con = "servicio";
            } else {
                $con = $resultados['identificador'];
            }
            break;
        }
    }
    if ($url == "") {
        //renova.com/es/inicio/servicio (thanichi)
        header("Location: " . $ruta . $con);
    }
    if ($con != "") {
        $varEspecifico = consultaUrlEspecifico($url, $con1);
        if ($varEspecifico != NULL) {
            include './contenido/inicio.php';
        }
        $ruta = $rutaFinal . $idioma . "/";
    } else {
        header("Location: " . $ruta . "inicio");
    }
} else if (count($nuevaCadena) >= 4) {
    header("Location: " . $rutaFinal);
}
