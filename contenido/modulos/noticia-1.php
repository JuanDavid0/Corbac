<?php
$idModulo = consultaModulo("noticia-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
$identificador_noticias = mysqli_fetch_row(noticiaNivel('noticia', $idioma));
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="noticia-1">
    <h3 id="noticia-1-titulo"><?php echo $varcontenido[0]; ?></h3>
    <div class="noticia-1-contenido">
        <?php
        $consultanoticialim = consultaNoticiasLim($varcontenido[1], $idioma);
        while ($resnoticialim = mysqli_fetch_array($consultanoticialim)) {
            $fecha = $resnoticialim['fecha'];
            $timestamp = strtotime($fecha);
            $dia = date('d', $timestamp);
            $mes = date('M', $timestamp);
            ?>
            <figure class="noticias">
                <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resnoticialim['imagen_p']; ?>"
                    alt="pr-sample13" />
                <div class="date"><span class="day"><?php echo $dia; ?></span><span class="month"><?php echo $mes; ?></span>
                </div>
                <figcaption>
                    <h3><?php echo $resnoticialim['nombre']; ?></h3>
                    <p><?php echo $resnoticialim['presentacion']; ?></p>
                </figcaption>
                <div class="hover"><i class="ion-android-open"></i></div>
                <a href="<?php echo $ruta . $identificador_noticias[0]; ?>/<?php echo $resnoticialim['url_amigable']; ?>"></a>
            </figure>
        <?php } ?>
    </div>
    <div>
        <a href="<?php echo $ruta;?>noticias">
            <button>
                <p>Todas las noticias</p>
            </button>
        </a>
    </div>
</div>