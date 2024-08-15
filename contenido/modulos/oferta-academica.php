<?php
$idModulo = consultaModulo("oferta-academica");
$consulta_historia_modulo = consultaInfoModuloGolbal($idModulo, $idioma);
$varindice = 0;
$identificador_oferta = mysqli_fetch_row(ofertaNivel('oferta-academica', $idioma));
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="oferta-academica">
    <h3 id="oferta-academica-titulo"><?php echo $varcontenido[0]; ?></h3>
    <div id="oferta-academica-contenido">
        <?php
        $consultaOfertaLim = consultaOfertaLim($varcontenido[1], $idioma);
        while ($resOfertaLim = mysqli_fetch_array($consultaOfertaLim)) {
        ?>
            <div class="oferta-card">
                <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resOfertaLim['imagen_p']; ?>" />
                <h4 class="oferta-academica-texto"><?php echo $resOfertaLim['nombre'] ?></h4>
                <div class="oferta-card-button-container">
                    <a href="<?php echo $ruta . $identificador_oferta[0]; ?>/<?php echo $resOfertaLim['url_amigable']; ?>">Ver más</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <div>
        <a href="<?php echo $ruta; ?>oferta-academica">
            <button>
                <p>Toda nuestra oferta</p>
            </button>
        </a>
    </div>
</div>