<?php
$idModulo = consultaModulo("formulario-3");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="formulario-3">
    <div id="formulario-3-info">
        <?php echo $varcontenido[0]; ?>
    </div>
    <div id="formulario-3-form">
        <h3 id="formulario-3-form-titulo">
            <?php echo $varcontenido[1]; ?>
        </h3>
        <form id="formulario-3-form-formulario" action="" onsubmit="enviarContacto(); return false;">
            <input id="nombreContacto" type="" name="" placeholder="Tu Nombre" class="formulario-3-input" required>
            <input id="numeroContacto" type="" name="" placeholder="Tu Teléfono" class="formulario-3-input" required>
            <input id="emailContacto" type="" name="" placeholder="Tu Email" class="formulario-3-input" required>
            <textarea  id="textoContacto" placeholder="Tu mensaje"></textarea>
            <input id="formulario-3-boton" type="submit" value="Enviar">
        </form>
    </div>
</div>
<div id="openModal" class="modalDialog invisible ">
    <div id="contenedorModal">
        <div class="logoModal" ></div>
        <p>¡Gracias por escribirnos! Nos contactaremos con Tigo lo antes posible :)</p>
        <button title="Close" class="close" onclick="cerrarModal()"></button>                
    </div>
</div>