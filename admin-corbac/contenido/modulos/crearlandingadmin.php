<?php
require_once './contenido/clases/landing.php';
$landing = new Landing();
$landing->identificador = $msg;
$registros = Landing::paginasDisponibles();
$noticias = Landing::noticiasDisponibles();
$ofertas = Landing::ofertasDisponibles();
?>
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
            <textarea name="contenido" class="input-form-act-admin" type="text" required rows="8" cols="50"></textarea>

            <label class="label-form-act-admin">LLamado a la acción:</label>
            <input name="cta1" class="input-form-act-admin" type="text" required placeholder="Frase de acción">

            <label class="label-form-act-admin">Página a la que se redirigirá al usuario</label>
            <select name="cta2" class="input-form-act-admin" id="urlBotonSelect" required>
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

            <label class="label-form-act-admin">Promesa:</label>
            <input name="promesa1" class="input-form-act-admin" type="text" required placeholder="Información">

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