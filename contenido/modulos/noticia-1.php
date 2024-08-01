<?php
$idModulo = consultaModulo("noticia-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="noticia-1">
    <h3 id="noticia-1-titulo"><a href="noticias"><?php echo $varcontenido[0]; ?></a></h3>
    <div id="noticia-1-contenido">
        <?php
        $consultanoticialim = consultaNoticiasLim($varcontenido[1], $idioma);
        while ($resnoticialim = mysqli_fetch_array($consultanoticialim)) {
            ?>
            <div class="noticia-1-esp">
                <div class="noticia-1-esp-img"
                    style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resnoticialim['imagen_p']; ?>.jpg');">
                    <div class="noticia-1-esp-capa">
                        <a href="<?php echo $ruta; ?>blogs/<?php echo $resnoticialim['url_amigable']; ?>">Leer Más...</a>
                    </div>
                </div>
                <div class="noticia-1-esp-contenedor">
                    <div class="noticia-1-esp-titulo">

                        <a
                            href="<?php echo $ruta; ?>blogs/<?php echo $resnoticialim['url_amigable']; ?>"><?php echo $resnoticialim['nombre']; ?></a>
                    </div>
                    <div class="noticia-1-esp-contenido">
                        <p><?php echo $resnoticialim['presentacion']; ?></p>

                        <!-- agragado borrar -->
                        <a href="<?php echo $ruta; ?>blogs/<?php echo $resnoticialim['url_amigable']; ?>">Leer Más</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>