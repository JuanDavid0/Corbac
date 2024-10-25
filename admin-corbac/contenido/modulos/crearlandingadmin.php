<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
    <h2>CREAR NUEVO BANNERA LANDING</h2>
    <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxLanding.php" enctype="multipart/form-data">
    <label class="label-form-act-admin">Título:</label>
            <input name="titulo" class="input-form-act-admin" type="text" required placeholder="Información">

            <label class="label-form-act-admin">Subtítulo:</label>
            <input name="subTitulo" class="input-form-act-admin" type="text" required placeholder="Información">

            <label class="label-form-act-admin">Contenido:</label>
            <input name="contenido" class="input-form-act-admin" type="text" required placeholder="Información">

            <label class="label-form-act-admin">cta1:</label>
            <input name="cta1" class="input-form-act-admin" type="text" required placeholder="Información">

            <label class="label-form-act-admin">cta2:</label>
            <input name="cta2" class="input-form-act-admin" type="text" placeholder="Información">

            <label class="label-form-act-admin">Promesa:</label>
            <input name="promesa1" class="input-form-act-admin" type="text" required placeholder="Información">

            <label class="label-form-act-admin">Promesa 2:</label>
            <input name="promesa2" class="input-form-act-admin" type="text" placeholder="Información">

            <label class="label-form-act-admin">Logo:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 800px</label>
            <input id="inputLogo" name="logo" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" onchange="mostrarLogo(this)"/>        
            <img id="previsua" src="" style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>

            <label class="label-form-act-admin">Imagen 1:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 800px</label>
            <input id="inputImage1" name="image1" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" onchange="mostrarImage1(this)"/>        
              
            <img id="previsua" src="" style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>

            <label class="label-form-act-admin">Imagen 2:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 800px</label>
            <input id="inputImage2" name="image2" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" onchange="mostrarImage2(this)"/>        
              
            <img id="previsua" src="" style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>

            <label class="label-form-act-admin">Fecha inicio:</label>
            <input name="fecha_inicio" class="input-form-act-admin" type="date" required>
            
            <label class="label-form-act-admin">Fecha final:</label>
            <input name="fecha_fin" class="input-form-act-admin" type="date" required>

            <input name="accion" value="crear" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Crear</button>   
        </form>
    </div>
</div>

<script>
    function mostrarLogo(input) {
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

    function mostrarImage1(input) {
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

    function mostrarImage2(input) {
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

    var fileUpload = document.getElementById('inputLogo');
    fileUpload.onchange = function (e) {
        mostrarLogo(e.srcElement);
    };

    var fileUpload = document.getElementById('inputImage1');
    fileUpload.onchange = function (e) {
        mostrarImage1(e.srcElement);
    };

    var fileUpload = document.getElementById('inputImage2');
    fileUpload.onchange = function (e) {
        mostrarImage2(e.srcElement);
    };
</script>
