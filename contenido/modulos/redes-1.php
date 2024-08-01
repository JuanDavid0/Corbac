<?php
$idModulo = consultaModulo("redes-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con,$idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="redes-1">
	<?php
        $consultaredes = consultaRedes($idioma);
        while ($resredes = mysqli_fetch_array($consultaredes)) {
    ?>
	<a href="<?php echo $resredes['variable'] ?>" class="redes-1-red <?php echo $resredes['clase'] ?>" target="_blank" rel="noopener noreferrer"></a>
    <?php } ?>
</div>