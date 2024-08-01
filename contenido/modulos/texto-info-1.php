<?php
$idModulo = consultaModulo("texto-info-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="texto-info-1">
    <h2 id="texto-info-1-titulo"><?php echo $varcontenido[0]; ?></h2>
    <div id="texto-info-1-contenido">
        <p><?php echo $varcontenido[1]; ?></p>
    </div>
</div>