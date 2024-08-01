<?php
$idModulo = consultaModulo("imagen-banner-4");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con,$idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="imagen-banner-4" style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varcontenido[0]; ?>');">
	<div id="imagen-banner-4-capa"></div>
</div>