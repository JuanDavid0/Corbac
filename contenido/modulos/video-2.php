<?php
$idModulo = consultaModulo("video-2");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="video-2">
	<h3 id="video-2-titulo">
		<?php echo $varcontenido[0]; ?>
	</h3>
	<p id="video-2-contenido">
		<?php echo $varcontenido[1]; ?>
	</p>
	<div id="video-2-video">
		<?php echo $varcontenido[2]; ?>
	</div>
</div>