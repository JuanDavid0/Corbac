<?php
$idModulo = consultaModulo("informacioncorporativa");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="info-1">
    <div id="info-1-cont">
        <?php
        $consultainformacion = consultaInfoCorporativa($idModulo, $con, $idioma);
        while ($resinformacion = mysqli_fetch_array($consultainformacion)) {
        ?>
            <div class="info-1-esp">
                <div class="info-1-capa">
                    <h2><?php echo $resinformacion['titulo']; ?></h2>
                    <?php if ($resinformacion['imagen'] != "") { ?>
                        <img src="/contenido/assets/<?php echo $resinformacion['imagen']; ?>" alt="<?php echo $resinformacion['titulo']; ?>" />
                    <?php } ?>
                    <p><?php echo $resinformacion['contenido']; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>