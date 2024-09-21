<?php
$idModulo = consultaModulo("historia");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="historia">
    <img id="historia-img" src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varcontenido[0]; ?>" alt="<?php echo $varcontenido[1]; ?>">
    <div id="historia-cont">
        <h2 id="historia-titulo"><?php echo $varcontenido[1]; ?></h2>
        <div id="historia-contenido" aria-label="contenido">
            <ul>
                <li class="parte contenido-parte1">
                    <p><?php echo $varcontenido[2]; ?></p>
                </li>

                <li class="parte contenido-parte2">
                    <p><?php echo $varcontenido[3]; ?></p>
                </li>
            </ul>
        </div>
    </div>
</div>