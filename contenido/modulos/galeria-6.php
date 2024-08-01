<?php
$idModulo = consultaModulo("galeria-6");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
//me trae el contenido de texto que va a tener, n este caso contiene el titulo(nuestros servicio) y el boton (saber mas)
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="galeria-6">
    <h3 id="galeria-6-titulo"><?php echo $varcontenido[0]; ?></h3>
    <div id="galeria-6-cont">
        <?php
        $consultagaleria = consultaGaleria($idModulo,$con,$idioma);
        while ($resgaleria = mysqli_fetch_array($consultagaleria)) {
            ?>
            <div class="galeria-6-esp">
                <div class="galeria-6-img" style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resgaleria['imagen']; ?>');">
                    <div class="galeria-6-capa">
                        <p><?php echo $resgaleria['texto']; ?></p>
                    </div>
                </div>
                <h4 class="galeria-6-titulo-esp">
                    <a href="<?php echo $ruta; ?><?php echo $resgaleria['url']; ?>"><?php echo $resgaleria['nombre']; ?></a>
                </h4>
                <a href="<?php echo $ruta; ?><?php echo $resgaleria['url']; ?>" class="galeria-6-boton-esp"><?php echo $varcontenido[1]; ?></a>
            </div>
        <?php } ?>
    </div>
</div>