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
            <input name="nombre" class="input-form-act-admin" type="text" required value="<?php echo $normativaF['nombre']; ?>">

            <label class="label-form-act-admin">Seleccione URL o Archivo PDF:</label>

            <!-- Campo de URL -->
            <input name="url" id="inputURL" class="input-form-act-admin" type="url" pattern="https?://.+"
                title="Ingrese una URL válida que comience con http:// o https://"
                value="<?php echo $normativaF['url']; ?>"
                onchange="toggleField('inputPDF', this)" />

            <!-- Campo de PDF -->
            <input name="archivo_pdf" id="inputPDF" class="input-form-act-admin" type="file" accept=".pdf"
                onchange="toggleField('inputURL', this)" />

            <label class="label-form-act-admin">Imagen:</label>
            <img id="previsua" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $normativaF['imagen']; ?>"
                style=" display: block; width: 150px; height: 150px; background-position: center; background-size: contain; background-repeat: no-repeat; margin: 5px auto;" />
            <input id="inputBannerImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />
            <label style="text-align: center;">Tamaño recomendado: 150px x 150px</label>

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

<script>
    function toggleField(otherFieldId, currentField) {
        var otherField = document.getElementById(otherFieldId);
        if (currentField.value) {
            otherField.disabled = true;
        } else {
            otherField.disabled = false;
        }
    }
</script>