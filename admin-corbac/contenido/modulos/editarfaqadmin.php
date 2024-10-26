<?php
require_once './contenido/clases/faq.php';
$faq = new Faq();
$faq->identificador = $msg;

$faqF = Faq::buscarFaq('preguntas_frecuentes', $faq);
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR FAQ</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxFaq.php" enctype="multipart/form-data">

            <label class="label-form-act-admin">Pregunta:</label>
            <input name="pregunta" class="input-form-act-admin" type="text" required
                value="<?php echo $faqF['pregunta']; ?>">

            <label class="label-form-act-admin">Respuesta:</label>
            <input name="respuesta" class="input-form-act-admin" type="text" required
                value="<?php echo $faqF['respuesta']; ?>">

            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="activo" <?php if ($faqF['estado'] === 'activo') {
                                            echo 'selected=""';
                                        } ?>>Activo
                </option>
                <option value="inactivo" <?php if ($faqF['estado'] === 'inactivo') {
                                                echo 'selected=""';
                                            } ?>>Inactivo
                </option>
            </select>
        
            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $faqF['identificador']; ?>" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Editar</button>
        </form>
    </div>
</div>