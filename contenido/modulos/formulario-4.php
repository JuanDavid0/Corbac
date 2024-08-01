<?php
$idModulo = consultaModulo("formulario-4");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="formulario-4">
    <div id="formulario-4-form">
        <div id="formulario-4-form-imagen" style ="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varcontenido[0]; ?>.jpg')">
        </div>
        <form id="formulario-4-form-formulario" action="" onsubmit="enviarContacto(); return false;">
            <div class="formulario-4-form-cont">
                <input id="nombreContacto" type="" name="" placeholder="<?php echo $varcontenido[1]; ?>" class="formulario-4-input" required>
                <input id="numeroContacto" type="" name="" placeholder="<?php echo $varcontenido[2]; ?>" class="formulario-4-input" required>
                <input id="emailContacto" type="" name="" placeholder="<?php echo $varcontenido[3]; ?>" class="formulario-4-input" required>
           
                <textarea  id="textoContacto" placeholder="<?php echo $varcontenido[4]; ?>"></textarea>
            </div>
            <div class="formulario-4-terminos">
                <input type="checkbox" name="aceptarT" value="aceptarT" required> <?php echo $varcontenido[5]; ?> <a href="#" target="_blank"><?php echo $varcontenido[6]; ?></a>
            </div>
            <input id="formulario-4-boton" type="submit" value="<?php echo $varcontenido[7]; ?>">
        </form>
    </div>
</div>
<div id="openModal" class="modalDialog invisible ">
    <div id="contenedorModal">
        <div class="logoModal" ></div>
        <p><?php echo $varcontenido[8]; ?></p>
        <button title="Close" class="close" onclick="cerrarModal()"></button>                
    </div>
</div>