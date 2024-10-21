<?php
require_once './contenido/clases/galeria.php';
$registros = Galeria::noticiasDisponibles('noticia');
?>
<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>REGISTRAR FOTO EN GALERIA</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxGaleria.php" enctype="multipart/form-data">
            <label class="label-form-act-admin">Noticia:</label>
            <select id="inputNoticia" name="noticia" class="input-form-act-admin" required>
                <option value="">Seleccione una noticia</option>
                <?php
                foreach ($registros as $registro) {
                    echo '<option value="' . $registro['url_amigable'] . '">' . $registro['nombre'] . '</option>';
                }
                ?>
            </select>
            <label class="label-form-act-admin">Imagen:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 800px X 400px</label>
            <input id="inputNoticiaImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg, .webp" required onchange="mostrarImagen(this, 'previsua')" />
            <img id="previsua" src="" style="display: block; width: 70%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;" />

            <label class="label-form-act-admin">Fecha</label>
            <input id="fecha" name="fecha" class="input-form-act-admin" type="date" required />
            <label class="label-form-act-admin">Idioma</label>
            <select name="idioma" class="input-form-act-admin" required>
                <option value="es" selected="">Español</option>
                <option value="en">Ingles</option>
            </select>

            <input name="accion" value="crear" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">añadir imagen</button>
        </form>
    </div>
</div>
<script>
    function mostrarImagen(input, imgId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(imgId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]); // convertir a base64
        }
    }
</script>