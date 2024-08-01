<div id="banner">
    <?php
    $consulta_banner1 = consultaBanner1($con);
    $consulta_banner2 = consultaBullets1($con);
    ?>
    <div class="contenedorBannerPrincipal">
        <div class="contenedorBanner">
            <?php while ($banners = mysqli_fetch_array($consulta_banner1)) { ?>
                <div class="slideBanner">
                    <img style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php print $banners['imagen']; ?>.jpg')" class="imgBanner" />
                    <div id="disposicionTextoBaner<?php print $banners['disposicion']; ?>" class="informacionBanner" <?php if ($banners['texto'] == null) { ?> style="display:none" <?php } ?> />
                    <?php if ($banners['titulo'] != null) {
                    ?> <div class="tituloBanner"><?php print $banners['titulo'] ?></div>
                    <?php } ?>
                    <?php if ($banners['texto'] != null) {
                    ?> <div class="textoBanner"><?php print $banners['texto'] ?></div>
                    <?php } ?>
                    <?php if ($banners['url'] != null) {
                    ?> <a class="botonBannerEnlase" href="<?php echo $banners['url'] ?>">Saber mas</a>
                    <?php } ?>
                </div>
        </div>
    <?php } ?>
    <div class="anteriorBanner left" onclick="bannerClick(-1)"></div>
    <div class="siguienteBanner right" onclick="bannerClick(1);"></div>
    </div>
    <div class="botonesBanner">
        <?php
        $i = 0;
        while ($resultados1 = mysqli_fetch_array($consulta_banner2)) {
        ?>
            <span class="bullet" onclick="mover(<?php echo $i; ?>)" style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resultados1['imagen']; ?>.jpg') "></span>
        <?php
            $i++;
        }
        ?>
        <script>
            iniciar2();
        </script>
    </div>
</div>
</div>