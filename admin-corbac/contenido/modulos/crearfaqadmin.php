<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>CREAR NUEVO FAQ</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxFaq.php" enctype="multipart/form-data">

            <label class="label-form-act-admin">Pregunta:</label>
            <input name="pregunta" class="input-form-act-admin" type="text" required placeholder="información">

            <label class="label-form-act-admin">Respuesta:</label>
            <input name="respuesta" class="input-form-act-admin" type="text" required placeholder="información">

            <input name="accion" value="crear" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Crear</button>
        </form>
    </div>
</div>