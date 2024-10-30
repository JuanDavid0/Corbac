<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>CREAR NUEVA NORMATIVA</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxNormativa.php" enctype="multipart/form-data">

            <label class="label-form-act-admin">Nombre:</label>
            <input name="nombre" class="input-form-act-admin" type="text" required placeholder="información">

            <label class="label-form-act-admin">Tipo de contenido:</label>
            <select id="tipoContenido" name="tipo_contenido" class="input-form-act-admin" onchange="toggleInputFields()" required>
                <option value="">Selecciona una opción</option>
                <option value="url">URL</option>
                <option value="pdf">Archivo PDF</option>
            </select>

            <div id="urlField" style="display: none;">
                <label class="label-form-act-admin">Url:</label>
                <input name="url" id="inputUrl" class="input-form-act-admin" type="url" placeholder="información" pattern="https?://.+" title="Ingrese una URL válida que comience con http:// o https://">
            </div>

            <div id="pdfField" style="display: none;">
                <label class="label-form-act-admin">Archivo PDF:</label>
                <input name="archivo_pdf" id="inputPdf" class="input-form-act-admin" type="file" accept=".pdf">
            </div>

            <label class="label-form-act-admin">Imagen de fondo:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 800px</label>
            <input id="inputBannerImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" required onchange="mostrarImagen(this)"/>

            <img id="previsua" src="" style="display: block; width: 100%; height: 400px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>

            <input name="accion" value="crear" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Crear</button>
        </form>
    </div>
</div>

<script>
    function mostrarImagen(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
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
    fileUpload.onchange = function (e) {
        mostrarImagen(e.srcElement);
    };

    function toggleInputFields() {
        var tipoContenido = document.getElementById('tipoContenido').value;
        var urlField = document.getElementById('urlField');
        var pdfField = document.getElementById('pdfField');
        var inputUrl = document.getElementById('inputUrl');
        var inputPdf = document.getElementById('inputPdf');
        
        // Mostrar el campo correspondiente y establecer la obligatoriedad de cada uno
        if (tipoContenido === 'url') {
            urlField.style.display = 'block';
            pdfField.style.display = 'none';
            inputUrl.required = true;
            inputPdf.required = false;
            inputPdf.value = ''; // Limpiar el campo PDF si se selecciona URL
        } else if (tipoContenido === 'pdf') {
            urlField.style.display = 'none';
            pdfField.style.display = 'block';
            inputUrl.required = false;
            inputPdf.required = true;
            inputUrl.value = ''; // Limpiar el campo URL si se selecciona PDF
        } else {
            urlField.style.display = 'none';
            pdfField.style.display = 'none';
            inputUrl.required = false;
            inputPdf.required = false;
        }
    }
</script>
