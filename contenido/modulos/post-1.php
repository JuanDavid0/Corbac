<?php
$idModulo = consultaModulo("post-1");
$url_noticia = $varEspecifico['url_amigable'];
$consulta_galeria_noticia = consultaGaleriaNoticias($idModulo, $con, $url_noticia, $idioma);

function obtenerLinkEmbebido($url)
{
    if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
        $videoId = $matches[1];
        return "https://www.youtube.com/embed/" . $videoId;
    }
    return $url;
}
?>
<div id="post-1">
    <div class="titulo-centrado">
        <h1><?php echo $varEspecifico['nombre']; ?></h1>
        <p>
            <?php echo $varEspecifico['descripcion']; ?>
        </p>
    </div>
    <div id="post-1-conta">
        <article class="article">
            <section class="content">
                <h2 class="headline">
                    <?php echo $varEspecifico['titulo1']; ?>
                </h2>
                <p><?php echo htmlspecialchars_decode($varEspecifico['contenido1']); ?></p>
            </section>
            <div class="img-container">
                <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varEspecifico['imagen1']; ?>"
                    alt="Image">
            </div>
        </article>
    </div>
    <?php
    if ($varEspecifico['contenido2'] != '') {
    ?>
        <div id="post-1-conta">
            <article class="article-2">
                <div class="img-container">
                    <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varEspecifico['imagen2']; ?>"
                        alt="Image">
                </div>
                <section class="content">
                    <h2 class="headline">
                        <?php echo $varEspecifico['titulo2']; ?>
                    </h2>
                    <p><?php echo htmlspecialchars_decode($varEspecifico['contenido2']); ?></p>
                </section>
            </article>
        </div>
    <?php
    }
    if (($varEspecifico['video'] != '') || ($varEspecifico['video'] != null)) {
    ?>
        <div id="post-1-video">
            <div id="post-1-video-cont">
                <section class="content">
                    <h2 class="headline"><?php echo $varEspecifico['tvideo']; ?></h2>
                    <p><?php echo htmlspecialchars_decode($varEspecifico['cvideo']); ?></p>
                </section>
            </div>
            <div id="post-1-video-video">
                <iframe src="<?php echo obtenerLinkEmbebido($varEspecifico['video']); ?>" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share""
                    referrerpolicy=" strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    <?php }
    if (mysqli_num_rows($consulta_galeria_noticia) > 0) {
    ?>
        <div class="container">
            <h2 class="text-center">Galeria</h2>
            <div class="lightbox-gallery">
                <?php
                while ($resgaleriaNoticia = mysqli_fetch_array($consulta_galeria_noticia)) {
                ?>
                    <div><img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resgaleriaNoticia['imagen']; ?>"
                            alt="Image">
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
</div>