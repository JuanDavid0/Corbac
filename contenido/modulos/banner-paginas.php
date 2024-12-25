<div id="banner">
    <?php
    $fechaServidor = getdate();
    $fecha = "" . $fechaServidor['year'] . "-" . $fechaServidor['mon'] . "-" . $fechaServidor['mday'];
    consultaValidarBanner($fecha);
    $consulta = consultaBanner($fecha, $con, $idioma);
    $nombrePagina = mysqli_fetch_array(consultarNombrePagina($con));
    ?>
    <div class="contenedorBanner">
        <?php
        while ($banners = mysqli_fetch_array($consulta)) { ?>
            <div class="slideBanner">
                <div style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $banners['imagen']; ?>')" class="imgBanner"></div>
                <div id="disposicionTextoBaner<?php echo $banners['disposicion']; ?>" class="informacionBanner">
                    <?php if ($nombrePagina['nombre'] != null) { ?>
                        <div class="tituloBanner"><?php echo $nombrePagina['nombre'] ?></div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <script>
        iniciar();
    </script>
</div>