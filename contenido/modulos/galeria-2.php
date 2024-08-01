<?php
$idModulo = consultaModulo("galeria-2");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="galeria-2">
	<h2 id="galeria-2-titulo"><?php echo $varcontenido[0]; ?></h2>
	<?php
    $consultasubcat = consultaSubServicios($varEspecifico['titulo'], 10);
    
    while ($ressubcat = mysqli_fetch_array($consultasubcat)) {
        ?>
	<div class="galeria-2-esp">
		<div class="galeria-2-esp-icono <?php echo $ressubcat['icono']; ?>"></div>
		<div class="galeria-2-info">
			<h3><?php echo $ressubcat['titulo']; ?></h3>
			<p><?php echo $ressubcat['descripcion_Corta']; ?></p>
			<a href="<?php echo $rutaFinal; ?><?php echo $varcontenido[2]; ?>" class="galeria-2-boton"><?php echo $varcontenido[1]; ?></a>
		</div>
	</div>
	<?php } ?>
</div>