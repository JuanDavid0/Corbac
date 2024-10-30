<?php
require_once './contenido/clases/galeriaNosotros.php';
$nosotrosInicio = new galeriaNosotros(); // Se crea un objeto de la clase banner
$nosotrosInicio->identificador = $msg; // Se le asigna el valor de la variable $msg al atributo identificador del objeto banner

$nosotrosF = galeriaNosotros::buscaNosotrosInicio('galeria', $nosotrosInicio); // se trae toda la infomacion del banner que se va a editar, filtrandolo por el identificador del banner, que en este caso corresponde a un numero entero que se almacena en la variable $msg
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR "NOSOTROS"</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxNosotrosInicio.php" enctype="multipart/form-data">
            <label class="label-form-act-admin">Imagen de fondo:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 600px</label>
            <input id="inputNoticiaImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />
            <img id="previsua" src="<?php echo $rutaFinalAssets . '/contenido/assets/' . $nosotrosF['imagen']; ?>" style="display: block; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;" />

            <label class="label-form-act-admin">Texto:</label>
            <input name="texto" class="input-form-act-admin" type="text" required value="<?php echo $nosotrosF['texto']; ?>">

            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $nosotrosF['identificador']; ?>" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Editar</button>
        </form>
    </div>
</div>
<script>
    function mostrarImagen(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var filePreview = document.getElementById('previsua');
                filePreview.id = 'file-preview';
                filePreview.src = e.target.result;
                var previewZone = document.getElementById('file-preview-zone');
                previewZone.appendChild(filePreview);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function mostrarImagenP(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var filePreview = document.getElementById('previsuaP');
                filePreview.id = 'file-preview';
                filePreview.src = e.target.result;
                var previewZone = document.getElementById('file-preview-zone');
                previewZone.appendChild(filePreview);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    var fileUpload = document.getElementById('inputNoticiaImagen');
    fileUpload.onchange = function(e) {
        mostrarImagen(e.srcElement);
    };
    var fileUpload = document.getElementById('inputImagenP');
    fileUpload.onchange = function(e) {
        mostrarImagenP(e.srcElement);
    };
</script>