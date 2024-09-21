<?php
include '../clases/distribuidores.php';
include '../../conexion/bdconexion.php';
include '../../conexion/ruta.php';
$objRuta = new ruta();
$objDistribuidores = new distribuidores();
$rutaFinal = $objRuta->retornaRuta();
$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "crear") {
    $nombre = filter_input(INPUT_GET, 'nombre');
    $ciudad = filter_input(INPUT_GET, 'ciudad', FILTER_SANITIZE_STRING);
    $ciudadDistint = filter_input(INPUT_GET, 'nuevaCiudad', FILTER_SANITIZE_STRING);
    if ($ciudad == "Vacio") {
        $ciudadFinal = $ciudadDistint;
    } else {
        $ciudadFinal = $ciudad;
    }
    $resultado = $objDistribuidores->registrarDistribuidor($nombre, $ciudadFinal);
    header("Location: " . $rutaFinal . "listadistribuidores/" . $resultado);
}
if ($accion == "editar") {
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING));
    $nombre = filter_input(INPUT_GET, 'nombre');
    $ciudad = filter_input(INPUT_GET, 'ciudad', FILTER_SANITIZE_STRING);
    $ciudadDistint = filter_input(INPUT_GET, 'nuevaCiudad', FILTER_SANITIZE_STRING);
    if ($ciudad == "Vacio") {
        $ciudadFinal = $ciudadDistint;
    } else {
        $ciudadFinal = $ciudad;
    }
    $resultado = $objDistribuidores->editarDistribuidor($id, $nombre, $ciudadFinal);
    header("Location: " . $rutaFinal . "listadistribuidores/" . $resultado);
}
if ($accion == "eliminar") {    
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);    
    $resultado = $objDistribuidores->eliminarDistribuidor($id);
    echo $resultado;
}
if ($accion == "filtrar") {
    $texto = filter_input(INPUT_GET, 'texto', FILTER_SANITIZE_STRING);
    $registros = $objDistribuidores->filtrarDistribuidor($texto);
    $xhtml = "";
    $xhtml .= "<div id=\"contenedor-personas-admin-label\"><div>Informacion</div><div>Ciudad</div><div>Acciones</div></div>";
    foreach ($registros as $indice => $campo) {
        $xhtml .= "<div class=\"contenedor-persona-admin\" >";
        $xhtml .= "<p class=\"tit-persona-admin\">" . $campo['nombre'] . "</p>";
        $xhtml .= "<p class=\"tit-persona-admin\">" . $campo['ciudad'] . "</p>";
        $xhtml .= "<p class=\"tit-persona-admin\">";
        $xhtml .= "<a title=\"Editar\" class=\"log-persona-admin log-persona-ed fa-editar\" href=\"" . $rutaFinal . "editardistribuidor/" . $campo['identificador'] . "\"></a>";
        $xhtml .= "<a class=\"log-persona-admin log-persona-ed fa-eliminar\" onclick=\"mostrarConfirmar('confirmeEliminar'," . $campo['identificador'] . ") \"></a>";
        $xhtml .= "</p>";
        $xhtml .= "</div>";
    }
        echo $xhtml; 
}