<?php
$idModulo = consultaModulo("imagen-banner-3");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="imagen-banner-3" style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varcontenido[0]; ?>');">
    <div id="imagen-banner-3-capa">
        <h2 id="imagen-banner-3-titulo"><?php echo $varcontenido[1]; ?></h2>
        <p><?php echo $varcontenido[2]; ?></p>
    </div>
</div>