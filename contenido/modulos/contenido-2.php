<?php
$idModulo = consultaModulo("contenido-2");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="contenido-2" style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varcontenido[0]; ?>');">


	<div id="contenido-2-con">

    	<p><?php echo $varcontenido[1]; ?></p>

	</div>


</div>