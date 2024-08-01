<?php
$idModulo = consultaModulo("destacado-3");
$consulta_historia_modulo = consultaInfoModulo($idModulo,$con);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="destacado-3">
    <div id="destacado-3-info">
        <div id="destacado-3-icono" class="<?php echo $varcontenido[0]; ?>"></div>
        <div id="destacado-3-titulo">
            <h3><?php echo $varcontenido[1]; ?></h3>
            <span><?php echo $varcontenido[2]; ?></span>
        </div>
        <div id="destacado-3-texto">
            <p><?php echo $varcontenido[3]; ?></p>
        </div>
    </div>
    <div id="destacado-3-dest">
        <?php
        $consultadestacado = consultaGaleria($idModulo,$con);
        while ($resdestacado = mysqli_fetch_array($consultadestacado)) {
            ?>
            <div class="destacado-3-dest" style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resdestacado['imagen_p']; ?>');">
                <a href="<?php echo $resdestacado['url']; ?>">
                    <div class="destacado-3-titulo">
                        <h3><?php echo $resdestacado['nombre']; ?></h3>
                    </div>
                    <div class="destacado-3-informacion">
                        <p><?php echo $resdestacado['texto']; ?></p>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>