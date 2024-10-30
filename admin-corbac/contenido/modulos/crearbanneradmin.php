<?php
require_once './contenido/clases/banner.php';
$registros = Banner::paginasDisponibles();
$noticias = Banner::noticiasDisponibles();
$ofertas = Banner::ofertasDisponibles();
?>
<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>CREAR NUEVO BANNER</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxBanner.php" enctype="multipart/form-data">
            <div style="display:flex; flex-direction:column; gap:10px">
                <label class="label-form-act-admin">Imagen</label>
                <img id="previsua" src="" style="display: block; width: 100%; height: 180px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;" />
                <label style="font-size: smaller; text-align: center; ">Formato Horizontal - Escala de imagen recomendada 16:9 </label>
                <input id="inputBannerImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" required onchange="mostrarImagen(this, 'previsua')" />

                <label class="label-form-act-admin">Título:</label>
                <input name="titulo" class="input-form-act-admin" type="text" required placeholder="Titulo que tendrá el banner">

                <label class="label-form-act-admin">Texto:</label>
                <input name="texto" class="input-form-act-admin" type="text" required placeholder="Informacion complementaria del banner">

                <label class="label-form-act-admin">Texto Botón:</label>
                <input name="texto_boton" class="input-form-act-admin" type="text" placeholder="LLamado a la accion">

                <label class="label-form-act-admin">Página a la que se redirigirá al usuario</label>
                <select name="url_boton" class="input-form-act-admin" id="urlBotonSelect" required>
                    <option value="inicio">inicio</option>
                    <?php
                    foreach ($registros as $registro) {
                        if ($registro['identificador'] === 'inicio') continue;
                        echo '<option value="' . $registro['identificador'] . '">' . $registro['nombre'] . '</option>';
                    }
                    ?>
                </select>

                <div id="selectNoticia" style="display: none;">
                    <label class="label-form-act-admin">Selecciona la noticia</label>
                    <select name="noticiaSeleccionada" class="input-form-act-admin">
                        <?php
                        foreach ($noticias as $registro) {
                            echo '<option value="' . $registro['url_amigable'] . '">' . $registro['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div id="selectOferta" style="display: none;">
                    <label class="label-form-act-admin">Selecciona la oferta</label>
                    <select name="ofertaSeleccionada" class="input-form-act-admin">
                        <?php
                        foreach ($ofertas as $registro) {
                            echo '<option value="' . $registro['url_amigable'] . '">' . $registro['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <label class="label-form-act-admin">Ubicación Texto</label>
                <select name="disposicion" class="input-form-act-admin" required>
                    <option value="0">Izquierda</option>
                    <option value="1" selected="">Centro</option>
                    <option value="2">Derecha</option>
                </select>

                <label class="label-form-act-admin">Orden:</label>
                <input name="orden" class="input-form-act-admin" type="number" required placeholder="Prioridad del banner">

                <label class="label-form-act-admin">Fecha inicio:</label>
                <input name="fecha_inicio" class="input-form-act-admin" type="date" required>

                <label class="label-form-act-admin">Fecha final:</label>
                <input name="fecha_final" class="input-form-act-admin" type="date">

            </div>

            <input name="accion" value="crear" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Crear</button>
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

    document.getElementById('urlBotonSelect').addEventListener('change', function() {
        const selectNoticia = document.getElementById('selectNoticia');
        const selectOferta = document.getElementById('selectOferta');
        if (this.value === 'noticia') {
            selectNoticia.style.display = 'block';
        } else {
            selectNoticia.style.display = 'none';
        }

        if (this.value === 'oferta') {
            selectOferta.style.display = 'block';
        } else {
            selectOferta.style.display = 'none';
        }
    });
</script>