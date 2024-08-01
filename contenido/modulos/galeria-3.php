<?php
$idModulo = consultaModulo("galeria-3");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="galeria-3">
    <h3 id="galeria-3-titulo"><?php echo $varcontenido[0]; ?></h3>
    <div id="galeria-3-cont">
        <?php
        $consultagaleria = consultaGaleria($idModulo,$con);
        while ($resgaleria = mysqli_fetch_array($consultagaleria)) {
            ?>
            <div class="galeria-3-esp">
                <div class="galeria-3-img">
                    <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resgaleria['imagen']; ?>" alt="<?php echo $resgaleria['alt']; ?>">
                </div>
                <h4 class="galeria-3-titulo-esp">
                    <?php echo $resgaleria['nombre']; ?>
                </h4>
            </div>
        <?php } ?>
    </div>
</div>