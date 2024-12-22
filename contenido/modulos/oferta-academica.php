<?php
$idModulo = consultaModulo("oferta-academica");
$consulta_historia_modulo = consultaInfoModuloGolbal($idModulo, $idioma);
$varindice = 0;
$identificador_oferta = mysqli_fetch_row(ofertaNivel('oferta_academica', $idioma));
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
            if ($resOfertaLim['oferta_padre'] === null) {
        ?>
                <a href="<?php echo $ruta . $resOfertaLim['url_amigable']; ?>" class="link-oferta-academica">
                    <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resOfertaLim['imagen_p']; ?>" />
                    <span class="oferta-academica-texto">
                        <h3 class="oferta-academica-texto"><?php echo $resOfertaLim['nombre'] ?></h4>
                    </span>
                    <p class="boton">Ver Programa</p>
                </a>
        <?php
            }
        }
        ?>
    </div>
    <div>
        <a href="<?php echo $ruta; ?>oferta-academica">
            <button>
                <p>Toda nuestra oferta</p>
            </button>
        </a>
    </div>
</div>