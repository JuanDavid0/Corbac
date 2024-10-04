<?php

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set("America/Bogota");
if ($con != "ingreso") {
    session_start();
    $fechaGuardada = $_SESSION["ultimaHora"];
    $ahora = time();
    $tiempo_transcurrido = $ahora - $fechaGuardada;
    if ($tiempo_transcurrido >= 900) {
        header("Location:" . $rutaFinal . "contenido/controlador/controladorLogueo.php?accion=cerrarSesion");
        session_destroy();
        die();
    } else {
        $_SESSION["ultimaHora"] = $ahora;
    }
    if ($_SESSION['usuario'] == null || $_SESSION['tipo'] == null) {
        header("Location: ".$rutaFinal);
        session_destroy();
        die();
    }
    require_once './conexion/bdconexion.php';
    require_once './contenido/clases/pagina.php';    
}
$resmetatag = $objCms->consultaMetaTags($con);
?>
<!DOCTYPE html>
<html lang="es"> 
    <head>        
        <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $rutaFinal ?>contenido/assets/favicon.ico">
        <title>Anbu Admin</title>
        <link rel="stylesheet" type="text/css" href="<?php echo $rutaFinal ?>contenido/css/general.css">        
<?php
// Consulta de estilos necesarios de los modulos llamados
$consultaCssModulo = $objCms->consultaModulos($con);
foreach ($consultaCssModulo as $indice => $campo) {
    if ($campo[0] !== "") {
        ?>
                <link rel="stylesheet" type="text/css" href="<?php echo $rutaFinal ?>contenido/css/<?php echo $campo[0]; ?>.css">
    <?php }
} ?>
<?php
$consultaJsModulo = $objCms->consultaModulos($con);
foreach ($consultaJsModulo as $indice => $campo) {
    if ($campo[1] != "") {
        ?>                
                <script src="<?php echo $rutaFinal ?>contenido/js/<?php echo $campo[1]; ?>.js" type="text/javascript"></script>            
    <?php }
} ?>
    </head>
    <body>
    <input id="rutaOculta" value="<?php echo $rutaFinal; ?>" type="hidden">        
<?php
$consultamodulo1 = $objCms->consultaModulos($con);
foreach ($consultamodulo1 as $indice => $campo) {
    include("modulos/" . $campo[0] . ".php");
}
?>   
    </body>
</html>