<?php
$idModulo = consultaModulo("noticia-2");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="noticia-2">
    <h3 id="noticia-2-titulo"><?php echo $varcontenido[0]; ?></h3>
    <div class="contenido-noticias">
        <?php
        $consultanoticialim = consultaNoticiasLim($varcontenido[1], $idioma);
        while ($resnoticialim = mysqli_fetch_array($consultanoticialim)) {
            $fecha = $resnoticialim['fecha'];
            $timestamp = strtotime($fecha);
            $dia = date('d', $timestamp);
            $mes = date('M', $timestamp);
            ?>
            <div class="lista-noticia">
                <figure class="noticias-2">
                    <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resnoticialim['imagen_p']; ?>"
                        alt="pr-sample13" />
                    <div class="date"><span class="day"><?php echo $dia; ?></span><span
                            class="month"><?php echo $mes; ?></span></div>
                    <figcaption>
                        <h3><?php echo $resnoticialim['nombre']; ?></h3>
                        <p><?php echo $resnoticialim['presentacion']; ?></p>
                    </figcaption>
                    <div class="hover"><i class="ion-android-open"></i></div>
                </figure>
            </div>
        <?php } ?>
    </div>
</div>