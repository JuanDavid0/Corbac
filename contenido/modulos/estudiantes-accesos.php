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
            <div class="estudiantes-contenido">
                <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resEstudiantes['icono']; ?>" alt="<?php echo $resEstudiantes["icono"] ?>">
                <p><a href="<?php echo $resEstudiantes["url"] ?>"><?php echo $resEstudiantes["nombre"] ?></a></p>
            </div>
        <?php } ?>
    </div>
</div>