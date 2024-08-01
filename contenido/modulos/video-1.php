<?php
$idModulo = consultaModulo("video-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="video-1">
	<h3 id="video-1-titulo">
		<?php echo $varcontenido[0]; ?>
	</h3>
	<div id="video-1-video">
		<?php echo $varcontenido[1]; ?>
	</div>
</div>