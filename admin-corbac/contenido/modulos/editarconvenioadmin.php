<?php
require_once './contenido/clases/convenio.php';
$convenio = new Convenio();
$convenio->identificador = $msg;

$convenioF = Convenio::buscaConvenio('convenio', $convenio);
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR CONVENIO</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxConvenio.php" enctype="multipart/form-data">
            <label class="label-form-act-admin">Imagen de fondo:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 600px</label>
            <input id="inputConvenioImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />

            <img id="previsua" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $convenioF['imagen']; ?>"
                style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;" />

            <label class="label-form-act-admin">Nombre:</label>
            <input name="nombre" class="input-form-act-admin" type="text" required
                value="<?php echo $convenioF['nombre']; ?>">

            <label class="label-form-act-admin">Vigencia:</label>
            <input name="vigencia" class="input-form-act-admin" type="text" required
                value="<?php echo $convenioF['vigencia']; ?>">

            <label class="label-form-act-admin">Contacto:</label>
            <input name="contacto" class="input-form-act-admin" type="text" required
                value="<?php echo $convenioF['contacto']; ?>">

            <label class="label-form-act-admin">Email:</label>
            <input name="email" class="input-form-act-admin" type="text" required
                value="<?php echo $convenioF['email']; ?>">

            <label class="label-form-act-admin">Url:</label>
            <input name="url" class="input-form-act-admin" type="url" required 
                value="<?php echo $convenioF['url']; ?>"  pattern="https?://.+" title="Ingrese una URL válida que comience con http:// o https://">

            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="activo" <?php if ($convenioF['estado'] === 'activo') {
                                            echo 'selected=""';
                                        } ?>>Activo
                </option>
                <option value="inactivo" <?php if ($convenioF['estado'] === 'inactivo') {
                                                echo 'selected=""';
                                            } ?>>Inactivo
                </option>
            </select>

            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $convenioF['identificador']; ?>" type="hidden" readonly required>
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

    var fileUpload = document.getElementById('inputConvenioImagen');
    fileUpload.onchange = function(e) {
        mostrarImagen(e.srcElement);
    };
</script>