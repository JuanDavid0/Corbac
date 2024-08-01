<?php
$idModulo = consultaModulo("mapa-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="mapa-1">
	<h3 id="mapa-1-titulo"><?php echo $varcontenido[0]; ?></h3>
	<div id="mapa-1-contenedor">
		<?php echo $varcontenido[1]; ?>
	</div>
</div>