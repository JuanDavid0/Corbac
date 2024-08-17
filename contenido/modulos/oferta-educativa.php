<?php
$idModulo = consultaModulo("oferta-educativa");
$consulta_historia_modulo = consultaInfoModuloGolbal($idModulo, $idioma);
$varindice = 0;
$identificador_oferta = mysqli_fetch_row(ofertaNivel('oferta_academica', $idioma));
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="oferta-educativa">
    <div class="oferta-educativa-contenido">
        <?php
        $consultaOfertaLim = consultaOfertaLim($varcontenido[0], $idioma);
        while ($resOfertaLim = mysqli_fetch_array($consultaOfertaLim)) {
        ?>
                <a href="<?php echo $ruta . $identificador_oferta[0]; ?>/<?php echo $resOfertaLim['url_amigable']; ?>" class="link-oferta-educativa">
                    <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resOfertaLim['imagen_p']; ?>" />
                    <span class="oferta-educativa-texto">
                        <h3><?php echo $resOfertaLim['nombre']; ?></h3>
                        <p>Ver Programa</p>
                    </span>
                </a>
        <?php } ?>
    </div>
</div>