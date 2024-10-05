<?php
// Conexion con la bd
include './conexion/ruta.php';
include './conexion/bdconexion.php';
include './contenido/clases/pagina.php';
header('Content-Type: text/html; charset=utf-8');

// Conexion con la bd
$comHeader = filter_input(INPUT_GET, 'h', FILTER_SANITIZE_STRING);
$nuevaCadena = explode("/", $comHeader);
$objRuta = new ruta();
$rutaFinal = $objRuta->retornaRuta();
$rutaFinalAssets = $objRuta->retornaRutaAssets();
$objCms = new pagina();
//LISTA BLANCA URL'S AMIGABLES
// Lista Blanca con una variable
if (count($nuevaCadena) == 1) {
    $paginas = $objCms->paginasNivel(0);
    $con = "";
    foreach ($paginas as $indice => $campo) {
        if ($comHeader == $campo['identificador']) {
            $con = $campo['identificador'];            
            break;
        }
    }
    if ($con != "") {
        $con = $campo['identificador'];        
        include './contenido/inicio.php';
    } else {
        header("Location: " . $rutaFinal . "ingreso");
    }
    // Lista Blanca con dos variables
} else if (count($nuevaCadena) == 2) {
    $paginas = $objCms->paginasNivel(0);
    $con = "";
    $msg = $nuevaCadena[1];    
    foreach ($paginas as $indice => $campo) {
        if ($nuevaCadena[0] == $campo['identificador']) {
            $con = $campo['identificador'];                
            break;
        }
    }
    if ($con != "") {
        $con = $campo['identificador'];                 
        include './contenido/inicio.php';
    } else {
        header("Location: " . $rutaFinal . "ingreso");
    }
} else if (count($nuevaCadena) >= 3) {
    header("Location: " . $rutaFinal . "ingreso");
}