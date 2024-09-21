<?php
include '../clases/noticia.php';
include '../controlador/controladorNoticia.php';
include '../clases/ruta.php';
date_default_timezone_set("America/Bogota");
$fehcaServidor = getdate(time());
$rutaFinal = Ruta::retornaRutaAdmin();
$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "crear") {
    $noticia = new Noticia();
    $noticia->url_amigable = filter_input(INPUT_POST, 'url_amigable', FILTER_SANITIZE_STRING);
    $noticia->descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $noticia->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $noticia->presentacion = filter_input(INPUT_POST, 'presentacion', FILTER_SANITIZE_STRING);
    $noticia->contenido = filter_input(INPUT_POST, 'contenido');
    $noticia->video = filter_input(INPUT_POST, 'video');
    $noticia->tvideo = filter_input(INPUT_POST, 'tvideo', FILTER_SANITIZE_STRING);
    $noticia->cvideo = filter_input(INPUT_POST, 'cvideo', FILTER_SANITIZE_STRING);
    $noticia->imagen_p = basename($_FILES['imagen']['name']);
    $noticia->imagen = basename($_FILES['imagen']['name']);
    $noticia->alt = filter_input(INPUT_POST, 'alt', FILTER_SANITIZE_STRING);
    $noticia->fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
    $noticia->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
    $noticia->estado = 'activo';
    if ($noticia->imagen != '') {
        $img_rute = "../assets/".basename($_FILES['imagen']['name']);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
            $testimonio->alt = basename($_FILES['foto']['name']);
            $resultado = ControladorNoticia::crearNoticia($noticia);
            header("Location: ".$rutaFinal."noticiasadmin/".$resultado);
        } else {
            header("Location: ".$rutaFinal."noticiasadmin/2");
        }
    } else {
        header("Location: ".$rutaFinal."noticiasadmin/2");
    }
}
if ($accion == "editar") {
    $noticia = new Noticia();
    $noticia->identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_STRING);
    $noticia->url_amigable = filter_input(INPUT_POST, 'url_amigable', FILTER_SANITIZE_STRING);
    $noticia->descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $noticia->nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $noticia->presentacion = filter_input(INPUT_POST, 'presentacion', FILTER_SANITIZE_STRING);
    $noticia->contenido = filter_input(INPUT_POST, 'contenido');
    $noticia->video = filter_input(INPUT_POST, 'video', FILTER_SANITIZE_STRING);
    $noticia->tvideo = filter_input(INPUT_POST, 'tvideo', FILTER_SANITIZE_STRING);
    $noticia->cvideo = filter_input(INPUT_POST, 'cvideo', FILTER_SANITIZE_STRING);
    $noticia->imagen_p = basename($_FILES['imagen']['name']);
    $noticia->imagen = basename($_FILES['imagen']['name']);
    $noticia->alt = filter_input(INPUT_POST, 'alt', FILTER_SANITIZE_STRING);
    $noticia->fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
    $noticia->idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
    $noticia->estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $noticiaActual = ControladorNoticia::buscarNoticia($noticia);
    if ($noticia->imagen != '') {
        $img_rute = "../assets/".basename($_FILES['imagen']['name']);
        unlink("../assets/".$noticiaActual['imagen']);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_rute)) {
            $noticia->alt = basename($_FILES['foto']['name']);
            $resultado = ControladorNoticia::editarNoticia($noticia);
            header("Location: ".$rutaFinal."noticiasadmin/".$resultado);
        } else {
            header("Location: ".$rutaFinal."noticiasadmin/2");
        }
    } else {        
        $noticia->imagen = $noticiaActual['imagen'];
        $noticia->imagen_p = $noticiaActual['imagen'];
        $noticia->alt = $noticiaActual['imagen'];
        $resultado = ControladorNoticia::editarNoticia($noticia);
        header("Location: ".$rutaFinal."noticiasadmin/".$resultado);
    }
    
}
$accion = filter_input(INPUT_GET, 'accion', FILTER_SANITIZE_STRING);
if ($accion == "eliminar") {
    $noticia = new Noticia();
    $noticia->identificador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $noticiaActual = ControladorNoticia::buscarNoticia($noticia);
    if ($noticiaActual != null) {
        unlink("../assets/".$noticiaActual['imagen']);
    }
    echo ControladorNoticia::eliminarNoticia($noticia);
}