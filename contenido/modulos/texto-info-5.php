<?php
$idModulo = consultaModulo("texto-info-5");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="texto-info-5">
    <img id="texto-info-5-img" src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varcontenido[0]; ?>" alt="<?php echo $varcontenido[1]; ?>">
    <div id="texto-info-5-cont">
        <h2 id="texto-info-5-titulo"><?php echo $varcontenido[1]; ?></h2>
        <div id="texto-info-5-contenido">
            <p><?php echo $varcontenido[2]; ?></p>
        </div>
    </div>
</div>