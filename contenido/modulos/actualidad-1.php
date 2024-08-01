<?php
$idModulo = consultaModulo("actualidad-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con,$idioma);
$varindice = 0;
$identificador_noticias = mysqli_fetch_row(blogNivel('noticia', $idioma));
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="actualidad-1">
    <h2 id="actualidad-1-titulo">
        <?php echo $varcontenido[0]; ?>
    </h2>
    <?php
    $consultanoticias = consultaNoticiasLim(5,$idioma);
    while ($resnoticias = mysqli_fetch_array($consultanoticias)) {
        ?>
        <div class="actualidad-1-esp">
            <div class="actualidad-1-esp-img" style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resnoticias['imagen_p']; ?>.jpg');">
                <a href="<?php echo $ruta.$identificador_noticias[0]; ?>/<?php echo $resnoticias['url_amigable'];?>" class="actualidad-1-esp-capa"></a>
            </div>
            <div class="actualidad-1-esp-cont">
                <h3 class="actualidad-1-esp-titulo">
                    <a href="<?php echo $ruta.$identificador_noticias[0]; ?>/<?php echo $resnoticias['url_amigable'];?>"><?php echo $resnoticias['nombre']; ?></a>
                </h3>
                <div class="actualidad-1-esp-texto">
                    <p><?php echo $resnoticias['presentacion']; ?></p>
                    <div class="actualidad-1-esp-boton">
                        <a href="<?php echo $ruta.$identificador_noticias[0]; ?>/<?php echo $resnoticias['url_amigable'];?>" ><?php echo $varcontenido[1]; ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>