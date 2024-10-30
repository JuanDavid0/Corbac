<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
$consultametatags = consultaMetaTags($con);
$resmetatag = mysqli_fetch_array($consultametatags);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- Metatags -->
    <title>
        <?php
        if ($varEspecifico != null) {
            echo $varEspecifico['nombre'] . ' | Corbac';
        } else {
            echo $resmetatag['titulo'] . ' | Corbac';
        }
        ?>
    </title>
    <meta name="description" content="<?php if ($varEspecifico != null) {
                                            if ($con == 'noticia') {
                                                echo $varEspecifico['presentacion'];
                                            } else if ($con == 'oferta') {
                                                echo $varEspecifico['contenido3'];
                                            }
                                        } else {
                                            echo $resmetatag['descripcion'];
                                        } ?>">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo $rutaFinal ?>contenido/assets/favicon.png">

    <!-- og tags Facebook -->
    <meta property="og:url" content="<?php if ($varEspecifico != null) {
                                            echo $ruta . $con . "/" . $varEspecifico['url_amigable'];
                                        } else {
                                            echo $ruta . $con;
                                        } ?>" />

    <meta property="og:type" content="<?php
                                        if ($varEspecifico != null) {
                                            echo 'website';
                                        } else {
                                            echo $resmetatag['typefb'];
                                        }
                                        ?>" />

    <meta property="og:title" content="<?php
                                        if ($varEspecifico != null) {
                                            echo $varEspecifico['nombre'] . ' | Corbac';
                                        } else {
                                            echo $resmetatag['titulo'] . ' | Corbac';
                                        }
                                        ?>" />

    <meta property="og:description" content="<?php if ($varEspecifico != null) {
                                                    if ($con == 'noticia') {
                                                        echo $varEspecifico['descripcion'];
                                                    } else if ($con == 'oferta') {
                                                        echo $varEspecifico['contenido2'];
                                                    }
                                                } else {
                                                    echo $resmetatag['descripcion'];
                                                } ?>">
    <meta property="og:image" content="<?php
                                        if ($varEspecifico != null) {
                                            echo $rutaFinal . "contenido/assets/" . $varEspecifico['imagen_p'];
                                        } else {
                                            echo $rutaFinal . "contenido/assets/" . $resmetatag['imagen'];
                                        } ?>" />
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />

    <meta name="twitter:site" content="<?php if ($varEspecifico != null) {
                                            echo $ruta . $con . "/" . $varEspecifico['url_amigable'];
                                        } else {
                                            echo $ruta . $con;
                                        } ?>" />

    <meta name="twitter:title" content="<?php
                                        if ($varEspecifico != null) {
                                            echo $varEspecifico['nombre'] . ' | Corbac';
                                        } else {
                                            echo $resmetatag['titulo'] . ' | Corbac';
                                        }
                                        ?>" />

    <meta name="twitter:description" content="<?php if ($varEspecifico != null) {
                                                    if ($con == 'noticia') {
                                                        echo $varEspecifico['descripcion'];
                                                    } else if ($con == 'oferta') {
                                                        echo $varEspecifico['contenido2'];
                                                    }
                                                } else {
                                                    echo $resmetatag['descripcion'];
                                                } ?>">

    <meta name="twitter:creator" content="<?php echo $resmetatag['creatortw']; ?>" />

    <meta name="twitter:image:src" content="<?php
                                        if ($varEspecifico != null) {
                                            echo $rutaFinal . "contenido/assets/" . $varEspecifico['imagen_p'];
                                        } else {
                                            echo $rutaFinal . "contenido/assets/" . $resmetatag['imagen'];
                                        } ?>" />

    <meta name="twitter:domain" content="<?php echo $resmetatag['domaintw']; ?>" />


    <!-- canonical
    <link rel="canonical" href="<?php // echo $ruta . $con . "/" . $varEspecifico['url_amigable']; ?>" />
    -->

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo $rutaFinal ?>contenido/css/general.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
    <?php
    $consultaCssModulo = consultaModulos($con);
    while ($resmod = mysqli_fetch_array($consultaCssModulo)) {
        if ($resmod[0] !== "") {
    ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $rutaFinal ?>contenido/css/<?php echo $resmod[0]; ?>.css">
    <?php }
    } ?>

    <!-- JS -->
    <?php
    $consultaJsModulo = consultaModulos($con);
    while ($resmod = mysqli_fetch_array($consultaJsModulo)) {
        if ($resmod[1] != "") {
    ?>
            <script src="<?php echo $rutaFinal ?>contenido/js/<?php echo $resmod[1]; ?>.js" type="text/javascript"></script>
    <?php
        }
    } ?>
    <script src="../contenido/js/landing-1.js"></script>
</head>

<body>
    <?php
    $consultamodulo1 = consultaModulos($con);
    while ($resmod1 = mysqli_fetch_array($consultamodulo1)) {
        include("modulos/" . $resmod1[0] . ".php");
    }
    ?>
</body>

</html>