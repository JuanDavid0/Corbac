<?php
require_once './contenido/clases/landing.php';
$landing = new Landing();
$landing->identificador = $msg;

$landingF = Landing::buscaLanding('landing', $landing);
$registros = Landing::paginasDisponibles();
$noticias = Landing::noticiasDisponibles();
$ofertas = Landing::ofertasDisponibles();
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
            <textarea name="contenido" class="input-form-act-admin" type="text" required rows="8" cols="50">
                <?php echo $landingF['contenido']; ?></textarea>

            <label class="label-form-act-admin">LLamado a la acción:</label>
            <input name="cta1" class="input-form-act-admin" type="text" required
                value="<?php echo $landingF['cta1']; ?>">

            <label class="label-form-act-admin">Página a la que se redirigirá al usuario</label>
            <select name="cta2" class="input-form-act-admin" id="urlBotonSelect" required>
                <option value="<?php echo $landingF['cta2']; ?>"><?php echo $landingF['cta2']; ?></option>
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
            <input name="promesa1" class="input-form-act-admin" type="text" required
                value="<?php echo $landingF['promesa1']; ?>">

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