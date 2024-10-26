<?php
$idModulo = consultaModulo("normativas");
?>
<div class>
    <div class="titulo">
        <h1>Normativas</h1>
    </div>
    <div class="normativas-contenedor">
        <?php
        $consultarNormativas = consultaInfoNormativas();
        while ($resNormativas = mysqli_fetch_array($consultarNormativas)) {
        ?>
            <div class="normativas-contenido">
                <a href="<?php echo $resNormativas["url"] ?>">
                    <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resNormativas['imagen']; ?>" alt="<?php echo $resNormativas["imagen"] ?>">
                    <p><?php echo $resNormativas["nombre"] ?></p>
                </a>
            </div>
        <?php } ?>
    </div>
</div>