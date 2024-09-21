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
            if ($resOfertaLim['oferta-padre'] === null) {
        ?>
                <a href="<?php echo $ruta . $resOfertaLim['url_amigable']; ?>" class="link-oferta-educativa">
                    <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resOfertaLim['imagen_p']; ?>" />
                    <span class="oferta-educativa-texto">
                        <h3><?php echo $resOfertaLim['nombre']; ?></h3>
                    </span>
                    <p class="boton">Ver Programa</p>
                </a>
        <?php }
        } ?>
    </div>
</div>