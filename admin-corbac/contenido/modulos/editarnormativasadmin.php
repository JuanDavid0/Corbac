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
            <select id="tipoContenido" name="tipo_contenido" class="input-form-act-admin" onchange="toggleInputFields()" required>
                <option value="url">URL</option>
                <option value="pdf">Archivo PDF</option>
            </select>

            <div id="urlField" style="display: none;">
                <label class="label-form-act-admin">URL:</label>
                <input name="url" id="inputURL" class="input-form-act-admin" type="url"
                    placeholder="Ingrese la URL" pattern="https?://.+"
                    title="Ingrese una URL válida que comience con http:// o https://"
                    value="<?php echo filter_var($normativaF['url'], FILTER_VALIDATE_URL) ? $normativaF['url'] : ''; ?>">
            </div>

            <div id="pdfField" style="display: none;">
                <label class="label-form-act-admin">Archivo PDF:</label>
                <?php if (!filter_var($normativaF['url'], FILTER_VALIDATE_URL)): ?>
                    <p>Archivo actual: <strong><?php echo htmlspecialchars($normativaF['url'], ENT_QUOTES, 'UTF-8'); ?></strong></p>
                <?php endif; ?>
                <input name="archivo_pdf" id="inputPDF" class="input-form-act-admin" type="file" accept=".pdf"
                    data-existing-file="<?php echo !empty($normativaF['url']) ? 'true' : ''; ?>"
                    <?php echo (!filter_var($normativaF['url'], FILTER_VALIDATE_URL)) && empty($normativaF['url']) ? 'required' : ''; ?>>
            </div>

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

    function toggleInputFields() {
        const tipoContenido = document.getElementById("tipoContenido").value;
        const urlField = document.getElementById("urlField");
        const pdfField = document.getElementById("pdfField");
        const inputPdf = document.getElementById("inputPdf");
        const inputUrl = document.getElementById("inputUrl");

        if (tipoContenido === "url") {
            urlField.style.display = "block";
            pdfField.style.display = "none";
            inputUrl.required = true;
            inputPdf.required = false;
        } else if (tipoContenido === "pdf") {
            urlField.style.display = "none";
            pdfField.style.display = "block";
            // Solo requerir el PDF si no hay uno previamente cargado.
            inputPdf.required = !inputPdf.hasAttribute("data-existing-file");
            inputUrl.required = false;
        } else {
            urlField.style.display = "none";
            pdfField.style.display = "none";
            inputUrl.required = false;
            inputPdf.required = false;
        }
    }

    window.onload = function() {
        const normativa = "<?php echo $normativaF['url']; ?>";
        const tipoContenido = normativa.match(/^https?:\/\//) ? "url" : "pdf"; 
        document.getElementById("tipoContenido").value = tipoContenido;
        toggleInputFields(); 
    };
</script>