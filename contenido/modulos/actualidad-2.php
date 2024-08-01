<?php
$idModulo = consultaModulo("actualidad-2");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="actualidad-2">
    <h2 id="actualidad-2-titulo">
        <?php echo $varcontenido[0]; ?>
    </h2>
    <?php
    $consultanoticias = consultaOtrasNoticias($varEspecifico['identificador'],3,$idioma);
    while ($resnoticias = mysqli_fetch_array($consultanoticias)) {
        ?>
        <div class="actualidad-2-esp">
            <div class="actualidad-2-esp-img" style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resnoticias['imagen_p']; ?>.jpg');">
                <a href="<?php echo $ruta; ?>blog/<?php echo $resnoticias['url_amigable']; ?>" class="actualidad-2-esp-capa"></a>
            </div>
            <div class="actualidad-2-esp-cont">
                <h3 class="actualidad-2-esp-titulo">
                    <a href="<?php echo $ruta; ?>blog/<?php echo $resnoticias['url_amigable']; ?>"><?php echo $resnoticias['nombre']; ?></a>
                </h3>
                <div class="actualidad-2-esp-texto">
                    <p><?php echo $resnoticias['presentacion']; ?></p>
                    <div class="actualidad-2-esp-boton">
                        <a href="<?php echo $ruta; ?>blog/<?php echo $resnoticias['url_amigable'];?>" >Leer Más...</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>