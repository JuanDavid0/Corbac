<div id="banner">
    <?php
    $fechaServidor = getdate();
    $fecha = "" . $fechaServidor['year'] . "-" . $fechaServidor['mon'] . "-" . $fechaServidor['mday'];
    consultaValidarBanner($fecha);
    $consulta = consultaBanner($fecha, $con, $idioma);
    ?>
    <div class="contenedorBanner">
        <?php while ($banners = mysqli_fetch_array($consulta)) { ?>
            <div class="slideBanner">
                <div style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $banners['imagen']; ?>')" class="imgBanner"></div>
                <div id="disposicionTextoBaner<?php echo $banners['disposicion']; ?>" class="informacionBanner">
                    <?php if ($banners['titulo'] != null) { ?>
                        <div class="tituloBanner"><?php echo $banners['titulo'] ?></div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <script>
        iniciar();
    </script>
</div>