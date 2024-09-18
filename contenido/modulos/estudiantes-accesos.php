<?php
$idModulo = consultaModulo("estudiantes-accesos");
?>
<div class="estudiantes-accesos">
    <div class="titulo">
        <h1>Accesos Estudiantes</h1>
    </div>

    <div class="estudiantes-contenedor">
        <?php
        $consultarEstudiantes = consultaInfoEstudiantes();
        while ($resEstudiantes = mysqli_fetch_array($consultarEstudiantes)) {
        ?>
            <a href="<?php echo $resEstudiantes["url"] ?>" class="link-estudiantes">
                <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resEstudiantes['icono']; ?>" alt="<?php echo $resEstudiantes["icono"] ?>">
                <span class="estudiantes-texto">
                    <h3><?php echo $resEstudiantes["nombre"] ?></h3>
                </span>
                <p class="boton">Ver más</p>
            </a>
        <?php } ?>
    </div>
</div>