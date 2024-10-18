<?php
include '../clases/noticia.php';
include '../controlador/controladorNoticia.php';
include '../clases/ruta.php';
date_default_timezone_set("America/Bogota");
$fehcaServidor = getdate(time());
$rutaFinal = Ruta::retornaRutaAdmin();
$rutaFisicaAssets = $_SERVER['DOCUMENT_ROOT'] . "/contenido/assets/";
$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($accion == "crear") {
    $noticia = new Noticia();
    $noticia->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $noticia->url_amigable = filter_input(INPUT_POST, 'url_amigable', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $noticia->presentacion = filter_input(INPUT_POST, 'presentacion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $noticia->imagen_p = basename($_FILES['imagen-presentacion']['name']);
    $noticia->descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $noticia->titulo1 = filter_input(INPUT_POST, 'titulo1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $noticia->contenido1 = filter_input(INPUT_POST, 'contenido1');
    $noticia->imagen1 = basename($_FILES['imagen-contenido1']['name']);
    //! ESTOY REVISANDO LOS ALT
    $noticia->alt1 = $noticia->imagen1;
    $noticia->titulo2 = filter_input(INPUT_POST, 'titulo2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $noticia->contenido2 = filter_input(INPUT_POST, 'contenido2');
    $noticia->imagen2 = basename($_FILES['imagen-contenido2']['name']);
    $noticia->alt2 = $noticia->imagen2;

    $noticia->video = filter_input(INPUT_POST, 'video', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $noticia->tvideo = filter_input(INPUT_POST, 'tvideo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $noticia->cvideo = filter_input(INPUT_POST, 'cvideo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $noticia->fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $noticia->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $noticia->estado = 'activo';

    if (!empty($noticia->imagen_p)) {
        $img_rute = $rutaFisicaAssets . $noticia->imagen_p;
        move_uploaded_file($_FILES['imagen-presentacion']['tmp_name'], $img_rute);
    }

    if (!empty($noticia->imagen1)) {
        $img_rute = $rutaFisicaAssets . $noticia->imagen1;
        move_uploaded_file($_FILES['imagen-contenido1']['tmp_name'], $img_rute);
    }

    if (!empty($noticia->imagen2)) {
        $img_rute = $rutaFisicaAssets . $noticia->imagen2;
        move_uploaded_file($_FILES['imagen-contenido2']['tmp_name'], $img_rute);
    }

    $resultado = ControladorNoticia::crearNoticia($noticia);

    if ($resultado == 1) {
        header("Location: " . $rutaFinal . "noticiasadmin/1");
    } else {
        header("Location: " . $rutaFinal . "noticiasadmin/2");
    }
}
if ($accion == "editar") {
    $noticia = new Noticia();
    $noticia->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $noticiaActual = ControladorNoticia::buscarNoticia($noticia);
    
    if ($noticiaActual != null) {
        $noticia->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $noticiaActual['identificador'];
        $noticia->url_amigable = filter_input(INPUT_POST, 'url_amigable', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $noticiaActual['url_amigable'];
        $noticia->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $noticiaActual['nombre'];
        $noticia->presentacion = filter_input(INPUT_POST, 'presentacion', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $noticiaActual['presentacion'];
        
        // Manejo de imagen de presentación
        if (isset($_FILES['imagen-presentacion']['name']) && !empty($_FILES['imagen-presentacion']['name'])) {
            $noticia->imagen_p = basename($_FILES['imagen-presentacion']['name']);
        } else {
            $noticia->imagen_p = $noticiaActual['imagen_p'];
        }

        $noticia->descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $noticiaActual['descripcion'];
        $noticia->titulo1 = filter_input(INPUT_POST, 'titulo1', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $noticiaActual['titulo1'];
        $noticia->contenido1 = filter_input(INPUT_POST, 'contenido1') ?: $noticiaActual['contenido1'];

        // Manejo de imagen 1
        if (isset($_FILES['imagen-contenido1']['name']) && !empty($_FILES['imagen-contenido1']['name'])) {
            $noticia->imagen1 = basename($_FILES['imagen-contenido1']['name']);
        } else {
            $noticia->imagen1 = $noticiaActual['imagen1'];
        }

        $noticia->titulo2 = filter_input(INPUT_POST, 'titulo2', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $noticiaActual['titulo2'];
        $noticia->contenido2 = filter_input(INPUT_POST, 'contenido2') ?: $noticiaActual['contenido2'];

        // Manejo de imagen 2
        if (isset($_FILES['imagen-contenido2']['name']) && !empty($_FILES['imagen-contenido2']['name'])) {
            $noticia->imagen2 = basename($_FILES['imagen-contenido2']['name']);
        } else {
            $noticia->imagen2 = $noticiaActual['imagen2'];
        }

        // Manejo de video
        $noticia->video = filter_input(INPUT_POST, 'video', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $noticia->tvideo = filter_input(INPUT_POST, 'tvideo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $noticia->cvideo = filter_input(INPUT_POST, 'cvideo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $noticia->fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $noticia->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $noticia->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Subir imagen 1 si es que se seleccionó
        if (!empty($noticia->imagen_p)) {
            $img_rute = $rutaFisicaAssets . $noticia->imagen_p;
            $img_rute_anterior = $rutaFisicaAssets . $noticiaActual['imagen_p'];
            
            // Verificar si la nueva imagen ya existe
            if (!file_exists($img_rute)) {
                // Si existe una imagen anterior, se elimina
                if (file_exists($img_rute_anterior)) {
                    unlink($img_rute_anterior);
                }
                // Mover la nueva imagen
                move_uploaded_file($_FILES['imagen-presentacion']['tmp_name'], $img_rute);
            }
        }
        
        // Subir imagen 1 si es que se seleccionó y no existe
        if (!empty($noticia->imagen1)) {
            $img_rute = $rutaFisicaAssets . $noticia->imagen1;
            $img_rute_anterior = $rutaFisicaAssets . $noticiaActual['imagen1'];
            
            // Verificar si la nueva imagen ya existe
            if (!file_exists($img_rute)) {
                // Si existe una imagen anterior, se elimina
                if (file_exists($img_rute_anterior)) {
                    unlink($img_rute_anterior);
                }
                // Mover la nueva imagen
                move_uploaded_file($_FILES['imagen-contenido1']['tmp_name'], $img_rute);
            }
        }
        
        // Subir imagen 2 si es que se seleccionó y no existe
        if (!empty($noticia->imagen2)) {
            $img_rute2 = $rutaFisicaAssets . $noticia->imagen2;
            $img_rute_anterior2 = $rutaFisicaAssets . $noticiaActual['imagen2'];
            
            // Verificar si la nueva imagen ya existe
            if (!file_exists($img_rute2)) {
                // Si existe una imagen anterior, se elimina
                if (file_exists($img_rute_anterior2)) {
                    unlink($img_rute_anterior2);
                }
                // Mover la nueva imagen
                move_uploaded_file($_FILES['imagen-contenido2']['tmp_name'], $img_rute2);
            }
        }

        $resultado = ControladorNoticia::editarNoticia($noticia);
        header("Location: " . $rutaFinal . "noticiasadmin/" . $resultado);
    } else {
        header("Location: " . $rutaFinal . "noticiasadmin/2");
    }
}

$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($accion == "eliminar") {
    $noticia = new Noticia();
    $noticia->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $noticiaActual = ControladorNoticia::buscarNoticia($noticia);
    if ($noticiaActual != null) {
        unlink("../assets/".$noticiaActual['imagen']);
    }
    echo ControladorNoticia::eliminarNoticia($noticia);
}