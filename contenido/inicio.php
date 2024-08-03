<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

// Funcion para traer los meta tags de esta pagina
$consultametatags = consultaMetaTags($con);
$resmetatag = mysqli_fetch_array($consultametatags);
if ($con == 'servicio') {
    $consultametatags_ser = consultaMetaTagsser($varEspecifico['url_amigable']);
    $resmetatag_ser = mysqli_fetch_array($consultametatags_ser);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- Metatags -->
    <title> CORBAC </title>

    <!-- <meta name="description" content="<?php if (($varEspecifico != null) && ($con != 'servicio')) {
        echo $varEspecifico['descripcion'];
    } else if (($varEspecifico != null) && ($con == 'servicio')) {
        echo $varEspecifico['descripcion_Corta'];
    } else {
        echo $resmetatag['descripcion'];
    } ?>">
    <meta name="theme-color" content="#<?php if ($con == 'servicio') {
        echo $resmetatag_ser['color_movil'];
    } else {
        echo $resmetatag['color_movil'];
    } ?>"> 
    -->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo $rutaFinal ?>contenido/assets/favicon.png">
    <!--<link rel="shortcut icon" type="image/x-icon" href="<?php echo $rutaFinal ?>contenido/assets/favicon.ico">-->


    <!-- og tags Facebook -->
    <meta property="og:url" content="<?php if ($varEspecifico != null) {
        echo $ruta . $con . "/" . $varEspecifico['url_amigable'];
    } else {
        echo $ruta . $con;
    } ?>" />

    <meta property="og:type" content="<?php if ($con == 'servicio') {
        echo $resmetatag_ser['typefb'];
    } else {
        echo $resmetatag['typefb'];
    } ?>" />

    <meta property="og:title" content="<?php if (($varEspecifico != null) && ($con != 'servicio')) {
        echo $varEspecifico['nombre'] . $resmetatag['titulo'];
    } else if (($varEspecifico != null) && ($con == 'servicio')) {
        echo $resmetatag_ser['titulo'];
    } else {
        echo $resmetatag['titulo'];
    } ?>" />

    <meta property="og:description" content="<?php if (($varEspecifico != null) && ($con != 'servicio')) {
        echo $varEspecifico['descripcion'];
    } else if (($varEspecifico != null) && ($con == 'servicio')) {
        echo $varEspecifico['descripcion_Corta'];
    } else {
        echo $resmetatag['descripcion'];
    } ?>" />

    <meta property="og:image" content="<?php
    if ($varEspecifico != null) {
        if ($con != "noticia") {
            echo $rutaFinal . "contenido/assets/" . $varEspecifico['imagen'];
        } else {
            echo $rutaFinalNoticias . "contenido/assets/" . $varEspecifico['imagen'] . ".jpg";
        }
    } else {
        echo $rutaFinal . "contenido/assets/" . $resmetatag['imagen'] . ".jpg";
    } ?>" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    
    <meta name="twitter:site" content="<?php if ($varEspecifico != null) {
        echo $ruta . $con . "/" . $varEspecifico['url_amigable'];
    } else {
        echo $ruta . $con;
    } ?>" />

    <meta name="twitter:title" content="<?php if (($varEspecifico != null) && ($con != 'servicio')) {
        echo $varEspecifico['nombre'] . $resmetatag['titulo'];
    } else if (($varEspecifico != null) && ($con == 'servicio')) {
        echo $resmetatag_ser['titulo'];
    } else {
        echo $resmetatag['titulo'];
    } ?>" />

    <meta name="twitter:description" content="<?php if (($varEspecifico != null) && ($con != 'servicio')) {
        echo $varEspecifico['descripcion'];
    } else if (($varEspecifico != null) && ($con == 'servicio')) {
        echo $varEspecifico['descripcion_Corta'];
    } else {
        echo $resmetatag['descripcion'];
    } ?>" />

    <meta name="twitter:creator" content="<?php
    if ($varEspecifico != null) {
        if ($con != "noticia") {
            echo $resmetatag_ser['creatortw'];
        } else {
            echo $resmetatag['creatortw'];
        }
    } else {
        echo $resmetatag['creatortw'];
    }
    ?>" />

    <meta name="twitter:image:src" content="<?php
    if ($varEspecifico != null) {
        if ($con != "noticia") {
            echo $rutaFinal . "contenido/assets/" . $varEspecifico['imagen'];
        } else {
            echo $rutaFinalNoticias . "contenido/assets/" . $varEspecifico['imagen'] . ".jpg";
        }
    } else {
        echo $rutaFinal . "contenido/assets/" . $resmetatag['imagen'] . ".jpg";
    } ?>" />

    <meta name="twitter:domain" content="<?php
    if ($varEspecifico != null) {
        if ($con != "noticia") {
            echo $resmetatag_ser['domaintw'];
        } else {
            echo $resmetatag['domaintw'];
        }
    } else {
        echo $resmetatag['domaintw'];
    }
    ?>" />

    <!-- canonical 
    <link rel="canonical" href="<?php echo $ruta . $con . "/" . $varEspecifico['url_amigable']; ?>" />
    -->

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo $rutaFinal ?>contenido/css/general.css">
    <?php
    // Consulta de estilos necesarios de los modulos llamados
    $consultaCssModulo = consultaModulos($con);
    while ($resmod = mysqli_fetch_array($consultaCssModulo)) {
        if ($resmod[0] !== "") {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $rutaFinal ?>contenido/css/<?php echo $resmod[0]; ?>.css">
        <?php }
    } ?>
    
    <!-- JS -->
    <?php
    // Consulta de estilos necesarios de los modulos llamados
    $consultaJsModulo = consultaModulos($con);
    while ($resmod = mysqli_fetch_array($consultaJsModulo)) {
        if ($resmod[1] != "") {
            ?>
            <script src="<?php echo $rutaFinal ?>contenido/js/<?php echo $resmod[1]; ?>.js" type="text/javascript"></script>
            <?php
        }
    } ?>
</head>

<body>
    <?php
    // Llamado de modulos que conforman la pagina
    $consultamodulo1 = consultaModulos($con);
    while ($resmod1 = mysqli_fetch_array($consultamodulo1)) {
        include ("modulos/" . $resmod1[0] . ".php");
    }
    ?>
</body>

</html>