<?php
$idModulo = consultaModulo("aulas-virtuales");
?>
<div class="aulas-virtuales">
    <div class="titulo">
        <h1>Aulas Virtuales</h1>
    </div>

    <div class="aulas-contenedor">
        <?php
        $consultarAulas = consultaInfoAulas();
        while ($resAulas = mysqli_fetch_array($consultarAulas)) {
        ?>
            <a href="<?php echo $resAulas["url"] ?>" class="link-aulas">
                <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resAulas['imagen']; ?>" alt="<?php echo $resAulas["imagen"] ?>">
                <span class="aulas-texto">
                    <h3><?php echo $resAulas["nombre"] ?></h3>
                </span>
                <p class="boton">Click para acceder</p>
            </a>
        <?php } ?>
    </div>
</div>