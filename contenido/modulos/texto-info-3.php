<?php
$idModulo = consultaModulo("texto-info-3");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="texto-info-3">
	<h2 id="texto-info-3-titulo"><?php echo $varcontenido[0]; ?></h2>
    <div id="texto-info-3-cont">
        <div id="texto-info-3-contenido">
            <p><?php echo $varcontenido[1]; ?></p>
            <a href="<?php echo $varcontenido[2]; ?>" id="texto-info-3-boton"><?php echo $varcontenido[3]; ?></a>
        </div>
    </div>
    <img id="texto-info-3-img" src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varcontenido[4]; ?>" alt="<?php echo $varcontenido[0]; ?>">
</div>