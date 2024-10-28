<?php
require_once './contenido/clases/contactos.php';
$contacto = new Contacto();
$contacto->identificador = $msg;

$contactoF = Contacto::buscaContacto('contenido', $contacto);
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR CONTACTO</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxContactos.php" enctype="multipart/form-data">

            <label class="label-form-act-admin">Número:</label>
            <input name="contenido" class="input-form-act-admin" type="text" required
                value="<?php echo $contactoF['contenido']; ?>" pattern=".{10}" title="Debes ingresar exactamente 10 caracteres.">

            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $contactoF['identificador']; ?>" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Editar</button>
        </form>
    </div>
</div>