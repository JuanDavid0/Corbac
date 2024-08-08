<?php
$idModulo = consultaModulo("nosotros-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="nosotros-1" class="nosotros-1">
    <h3 id="nosotros-1-titulo" class="nosotros-1-titulo">
        <?php echo $varcontenido[0]; ?>
    </h3>
    <div id="nosotros-1-contenedor" class="nosotros-1-contenedor">
        <?php
        $consultaNosotrosGaleria = consultaGaleria($idModulo, $con, $idioma);
        while ($resgaleria = mysqli_fetch_array($consultaNosotrosGaleria)) {
        ?>
            <div class="nosotros-1-tarjeta">
                <div class="nosotros-1-img" style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resgaleria['imagen']; ?>');">
                </div>
                <div class="nosotros-1-texto">
                    <p><?php echo $resgaleria['texto']; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>