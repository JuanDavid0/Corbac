<?php
require_once './contenido/clases/general.php';
$general = new General();
$general->identificador = $msg;
$generalF = General::buscarGeneral('general', $general);
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR VALOR</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxGeneral.php" enctype="multipart/form-data">
            <label class="label-form-act-admin">Nombre:</label>
            <input name="clase" class="input-form-act-admin" type="text" required readonly value="<?php echo $generalF['clase']; ?>">
            <label class="label-form-act-admin">Valor:</label>
            <?php
            if ($generalF['clase'] === 'Logo') {
            ?>
                <img id="previsua" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $generalF['variable']; ?>"
                    style="display: block; width: 300px; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;" />
                <input id="inputBannerImagen" name="variable" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />
                <label style="font-size: smaller; text-align: center; ">Formato Horizontal - Tamaño recomendado 300px x 150px </label>
            <?php
            } else {
            ?>
                <input name="variable" class="input-form-act-admin" type="text" required value="<?php echo $generalF['variable']; ?>">
            <?php
            }
            ?>
            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="activo" <?php if ($generalF['estado'] === 'activo') {
                                            echo 'selected=""';
                                        } ?>>Activo</option>
                <option value="inactivo" <?php if ($generalF['estado'] === 'inactivo') {
                                                echo 'selected=""';
                                            } ?>>Inactivo</option>
            </select>
            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $generalF['identificador']; ?>" type="hidden" readonly required>
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