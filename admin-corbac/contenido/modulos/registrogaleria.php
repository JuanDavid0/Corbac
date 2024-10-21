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
            <label class="label-form-act-admin">Imagenes:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 800px X 400px</label>
            <input id="inputNoticiaImagen" name="imagenes[]" class="input-form-act-admin" type="file" accept=".jpg, .webp" multiple required onchange="mostrarImagenes(this, 'previsualizaciones')" />
            <div id="previsualizaciones" style="display: flex; flex-wrap: wrap;"></div>
            <input name="accion" value="crear" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">añadir imagen</button>
        </form>
    </div>
</div>
<script>
    function mostrarImagenes(input, divId) {
        var previsualizaciones = document.getElementById(divId);
        previsualizaciones.innerHTML = ''; // Limpiar previsualizaciones anteriores
        if (input.files) {
            Array.from(input.files).forEach(file => {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style = 'width: 70%; height: 200px; margin: 5px;';
                    previsualizaciones.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
    }
</script>