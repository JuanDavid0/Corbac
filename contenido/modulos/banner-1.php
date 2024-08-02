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
                <div style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $banners['imagen']; ?>')"
                    class="imgBanner"></div>
                <div class="slideBanner-capa"></div>
                <div id="disposicionTextoBaner<?php echo $banners['disposicion']; ?>" class="informacionBanner">
                    <?php if ($banners['titulo'] != null) { ?>
                        <div class="tituloBanner"><?php echo $banners['titulo'] ?></div>
                    <?php } ?>
                    <?php if ($banners['texto'] != null) { ?>
                        <div class="textoBanner"><?php echo $banners['texto'] ?></div>
                    <?php } ?>
                    <?php if ($banners['url'] != null) { ?>
                        <a class="botonBannerEnlase"
                            href="<?php echo $banners['url'] ?>"><?php echo $banners['texto_boton'] ?></a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="anteriorBanner left" onclick="bannerClick(-1)"></div>
    <div class="siguienteBanner right" onclick="bannerClick(1);"></div>
    <div class="botonesBanner">
        <script> iniciar();</script>
    </div>
</div>