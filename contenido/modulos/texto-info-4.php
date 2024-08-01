<?php
$idModulo = consultaModulo("texto-info-4");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="texto-info-4">
    <div id="texto-info-4-cont">
        <div id="texto-info-4-contenido">
            <p><?php echo $varcontenido[0]; ?></p>
        </div>
    </div>
    <img id="texto-info-4-img" src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varcontenido[1]; ?>" alt="<?php echo $varcontenido[2]; ?>">
</div>