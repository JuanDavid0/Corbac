<?php
$idModulo = consultaModulo("texto-info-servicio");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="texto-info-servicio">
    <img id="texto-info-servicio-img" src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varEspecifico['imagen']; ?>" alt="<?php echo $varcontenido['alt']; ?>">
    <div id="texto-info-servicio-cont">
        <h2 id="texto-info-servicio-titulo"><?php echo $varEspecifico['titulo']; ?></h2>
        <div id="texto-info-servicio-contenido">
            <p><?php echo $varEspecifico['descripcion_Larga']; ?></p>
        </div>
    </div>
</div>