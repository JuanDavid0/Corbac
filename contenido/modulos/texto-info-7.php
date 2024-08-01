<?php
$idModulo = consultaModulo("texto-info-7");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con,$idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="texto-info-7">
	<div class="texto-info-7-cont">
		<h3><?php echo $varcontenido[0]; ?></h3>
		<p><?php echo $varcontenido[1]; ?></p>
	</div>
	<div class="texto-info-7-cont">
		<h3><?php echo $varcontenido[2]; ?></h3>
		<p><?php echo $varcontenido[3]; ?></p>
	</div>
</div>