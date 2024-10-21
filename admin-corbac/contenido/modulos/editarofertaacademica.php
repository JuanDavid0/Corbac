<?php
require_once './contenido/clases/oferta.php';
$testimonio = new Oferta(); // Se crea un objeto de la clase banner
$testimonio->identificador = $msg; // Se le asigna el valor de la variable $msg al atributo identificador del objeto banner

$ofertaF = Oferta::buscarOferta('oferta_academica',$testimonio); // se trae toda la infomacion del banner que se va a editar, filtrandolo por el identificador del banner, que en este caso corresponde a un numero entero que se almacena en la variable $msg
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR OFERTA</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxOferta.php"
            enctype="multipart/form-data">
            <label class="label-form-act-admin">Imagen de fondo:</label>
            <input id="inputBannerImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />

            <img id="previsua" src="<?php echo $rutaFinalAssets.'contenido/assets/'.$ofertaF['imagen']; ?>"
                style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;" />

            <label class="label-form-act-admin">Nombre:</label>
            <input name="nombre" class="input-form-act-admin" type="text" required
                value="<?php echo $ofertaF['nombre']; ?>">

            <label class="label-form-act-admin">url :</label>
            <input name="url_amigable" class="input-form-act-admin" type="text" required
                value="<?php echo $ofertaF['url_amigable']; ?>">

            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $ofertaF['identificador']; ?>" type="hidden" readonly
                required>
            <button class="inputSubmitForm" type="submit">Editar</button>
        </form>
