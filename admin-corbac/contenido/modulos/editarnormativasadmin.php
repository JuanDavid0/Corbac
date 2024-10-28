<?php
require_once 'contenido/clases/normativa.php';
$normativa = new Normativa();
$normativa->identificador = $msg;

$normativaF = Normativa::buscarNormativa('normativas', $normativa);
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR NORMATIVAS</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxNormativa.php" enctype="multipart/form-data">
            <label class="label-form-act-admin">Nombre:</label>
            <input name="nombre" class="input-form-act-admin" type="text" required
                value="<?php echo $normativaF['nombre']; ?>">
            
            <label class="label-form-act-admin">Url:</label>
            <input name="url" class="input-form-act-admin" type="url" required pattern="https?://.+" title="Ingrese una URL válida que comience con http:// o https://"
                value="<?php echo $normativaF['url']; ?>">
            
            <label class="label-form-act-admin">Imagen:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 600px</label>
            <input id="inputBannerImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />

            <img id="previsua" src="<?php echo $rutaFinalAssets.'contenido/assets/'.$normativaF['imagen']; ?>"
                style="display: block; width: 100%; height: 400px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;" />

            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $normativaF['identificador']; ?>" type="hidden" readonly required>
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
var fileUpload = document.getElementById('inputBannerImagen');
fileUpload.onchange = function(e) {
    mostrarImagen(e.srcElement);
};
</script>