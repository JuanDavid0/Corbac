<?php
$idModulo = consultaModulo("formulario-2");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="formulario-2">
    <div id="formulario-2-form">
        <h3 id="formulario-2-form-titulo">
            <?php echo $varcontenido[0]; ?>
        </h3>
        <form id="formulario-2-form-formulario" action="" onsubmit="enviarContacto(); return false;">
            <input id="nombreContacto" type="" name="" placeholder="Tu Nombre" class="formulario-2-input" required>
            <input id="numeroContacto" type="" name="" placeholder="Tu Teléfono" class="formulario-2-input" required>
            <input id="emailContacto" type="" name="" placeholder="Tu Email" class="formulario-2-input" required>
            <textarea  id="textoContacto" placeholder="Tu mensaje"></textarea>
            <input id="formulario-2-boton" type="submit" value="Enviar">
        </form>
    </div>
    <div id="formulario-2-mapa">
        <h3 id="formulario-2-mapa-titulo">
            <?php echo $varcontenido[1]; ?>
        </h3>
        <div id="formulario-2-mapa-mapa">
            <?php echo $varcontenido[2]; ?>
        </div>
    </div>
</div>
<div id="openModal" class="modalDialog invisible ">
    <div id="contenedorModal">
        <div class="logoModal" ></div>
        <p>¡Gracias por escribirnos! Nos contactaremos con Tigo lo antes posible :)</p>
        <button title="Close" class="close" onclick="cerrarModal()"></button>                
    </div>
</div>