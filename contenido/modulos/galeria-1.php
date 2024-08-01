<?php
$idModulo = consultaModulo("galeria-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="galeria-1">
    <h3 id="galeria-1-titulo"><?php echo $varcontenido[0]; ?></h3>
    <div id="galeria-1-cont">
        <?php
        $consultagaleria = consultaGaleria($idModulo,$con);
        while ($resgaleria = mysqli_fetch_array($consultagaleria)) {
            ?>
            <div class="galeria-1-esp">
                <div class="galeria-1-img">
                    <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resgaleria['imagen']; ?>" alt="<?php echo $resgaleria['alt']; ?>">
                </div>
                <p class="galeria-1-titulo-esp">
                    <?php echo $resgaleria['nombre']; ?>
                </p>
                <div class="galeria-1-texto">
                    <p><?php echo $resgaleria['texto']; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>