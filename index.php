<?php
// Conexion con la bd
include './conexion/ruta.php';
include("consultas/consultas.php");

header('Content-Type: text/html; charset=utf-8');

error_reporting(E_ALL ^ E_NOTICE);

$comHeader = filter_input(INPUT_GET, 'h', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nuevaCadena = explode("/", $comHeader);
$rutaFinal = retornaRuta();
$varEspecifico = null;
$rutaFinalNoticias = retornaRutaNoticias();

//Caso 1
if (count($nuevaCadena) == 1) {
    $idioma = "es";
    $ruta = $rutaFinal . $idioma . "/";
    header("Location: " . $ruta . "inicio");
}

// Caso 2
else if (count($nuevaCadena) == 2) {
    $idioma = "es";
    $paginas = paginasNivel(1, $idioma);
    $ruta = $rutaFinal . $idioma . "/";
    $con = "";
    if ($nuevaCadena[1] == 'noticia') {
        header("Location: " . $ruta . "inicio");
    }
    while ($resultados = mysqli_fetch_array($paginas)) {
        if ($nuevaCadena[1] == $resultados['identificador']) {
            $con = $resultados['identificador'];
            break;
        }
    }

    if ($con != "") {
        include './contenido/inicio.php';
    } else {
        header("Location: " . $ruta . "inicio");
    }

    // Caso 3
} else if (count($nuevaCadena) == 3) {
    $idioma = "es";
    $paginas = paginasNivel(1, $idioma);
    $ruta = $rutaFinal . $idioma . "/";
    $con = "";
    $url = $nuevaCadena[2];

    while ($resultados = mysqli_fetch_array($paginas)) {
        if ($nuevaCadena[1] == $resultados['identificador']) {
            $con1 = $resultados['categoria']; // info-noticia
            $con = ($con1 == "servicio") ? "servicio" : $resultados['identificador']; //noticia
            break;
        }
    }

    if ($url == "") {
        header("Location: " . $ruta . $con);
    }

    if ($con != "") {
        //noticia-n1, info-noticia
        $varEspecifico = consultaUrlEspecifico($url, $con1);
        if ($varEspecifico != NULL) {
            include './contenido/inicio.php';
        } else {
            header("Location: " . $ruta . "inicio");
        }
    } else {
        header("Location: " . $ruta . "inicio");
    }

    // Caso 4
} else if (count($nuevaCadena) >= 4) {
    header("Location: " . $rutaFinal);
}
