<?php
require_once './contenido/clases/landing.php';
$landing = new Landing();
$landing->identificador = $msg;

$landingF = Landing::buscaLanding('landing', $landing);
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR LANDING</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxLanding.php"
            enctype="multipart/form-data">
            <label class="label-form-act-admin">Título:</label>
            <input name="titulo" class="input-form-act-admin" type="text" required
                value="<?php echo $landingF['titulo']; ?>">

            <label class="label-form-act-admin">Subtítulo:</label>
            <input name="subTitulo" class="input-form-act-admin" type="text" required
                value="<?php echo $landingF['subTitulo']; ?>">

            <label class="label-form-act-admin">Contenido:</label>
            <input name="contenido" class="input-form-act-admin" type="text" required
                value="<?php echo $landingF['contenido']; ?>">

            <label class="label-form-act-admin">cta1:</label>
            <input name="cta1" class="input-form-act-admin" type="text" required
                value="<?php echo $landingF['cta1']; ?>">

            <label class="label-form-act-admin">cta2:</label>
            <input name="cta2" class="input-form-act-admin" type="text"
                value="<?php echo $landingF['cta2']; ?>">

            <label class="label-form-act-admin">Promesa:</label>
            <input name="promesa1" class="input-form-act-admin" type="text" required
                value="<?php echo $landingF['promesa1']; ?>">

            <label class="label-form-act-admin">Promesa 2:</label>
            <input name="promesa2" class="input-form-act-admin" type="text"
                value="<?php echo $landingF['promesa2']; ?>">

            <label class="label-form-act-admin">Logo:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 600px</label>
            <input id="inputLogo" name="logo" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />

            <img id="previsua" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $landingF['logo']; ?>"
                style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;" />

            <label class="label-form-act-admin">Imagen:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 600px</label>
            <input id="inputImage1" name="image1" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />

            <img id="previsua" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $landingF['image1']; ?>"
                style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;" />

            <label class="label-form-act-admin">Imagen 2:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 600px</label>
            <input id="inputImage2" name="image2" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />

            <img id="previsua" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $landingF['image2']; ?>"
                style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;" />

            <label class="label-form-act-admin">Fecha inicio:</label>
            <input name="fecha_inicio" class="input-form-act-admin" type="date" required
                value="<?php echo $landingF['fecha_inicio']; ?>">

            <label class="label-form-act-admin">Fecha fin:</label>
            <input name="fecha_fin" class="input-form-act-admin" type="date" required
                value="<?php echo $landingF['fecha_fin']; ?>">

            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="activo" <?php if ($landingF['estado'] === 'activo') {
                                            echo 'selected=""';
                                        } ?>>Activo
                </option>
                <option value="inactivo" <?php if ($landingF['estado'] === 'inactivo') {
                                                echo 'selected=""';
                                            } ?>>Inactivo
                </option>
            </select>

            <input name="accion" value="editar" type="hidden" readonly required>
            <input type="hidden" name="identificador" value="<?php echo $landingF['identificador']; ?>" readonly required>
            <button class="inputSubmitForm" type="submit">Editar</button>
        </form>
    </div>
</div>

<script>
    function mostrarLogo(input) {
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

    function mostrarImage1(input) {
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

    function mostrarImage2(input) {
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

    var fileUpload = document.getElementById('inputLogo');
    fileUpload.onchange = function(e) {
        mostrarLogo(e.srcElement);
    };

    var fileUpload = document.getElementById('inputImage1');
    fileUpload.onchange = function(e) {
        mostrarLogo(e.srcElement);
    };

    var fileUpload = document.getElementById('inputImage2');
    fileUpload.onchange = function(e) {
        mostrarLogo(e.srcElement);
    };
</script>