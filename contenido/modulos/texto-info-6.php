<?php
$idModulo = consultaModulo("texto-info-6");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="texto-info-6" style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varcontenido[0]; ?>');">


	<div id="texto-info-6-con">
	    <h2 id="texto-info-6-titulo"><?php echo $varcontenido[1]; ?></h2>
	    <div id="texto-info-6-contenido">
	        <p><?php echo $varcontenido[2]; ?></p>
	    </div>
	</div>


</div>