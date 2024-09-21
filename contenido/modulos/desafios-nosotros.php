<?php
$idModulo = consultaModulo("desafios-nosotros");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div class="desafios-nosotros">
    <p><?php echo $varcontenido[0]; ?></p>  
</div>