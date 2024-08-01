<?php
$idModulo = consultaModulo("galeria-4");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="galeria-4">
    <h3 id="galeria-4-titulo"><?php echo $varcontenido[0]; ?></h3>
    <div id="galeria-4-cont">
        <?php
        $consultagaleria = consultaGaleria($idModulo,$con,$idioma);
        while ($resgaleria = mysqli_fetch_array($consultagaleria)) {
            ?>
            <div class="galeria-4-esp">
                <div class="galeria-4-img">
                    <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resgaleria['imagen']; ?>" alt="<?php echo $resgaleria['alt']; ?>">
                    <div class="galeria-4-esp-capa" style="background-color: rgba(<?php echo $resgaleria['clase']; ?>)">
                        <p class="galeria-4-texto-esp">
                            <?php echo $resgaleria['texto']; ?>
                        </p>
                    </div>
                    <a href="<?php echo $resgaleria['url']; ?>" class="galeria-4-titulo-esp">
                        <?php echo $resgaleria['nombre']; ?>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>