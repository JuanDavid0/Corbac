<div id="post-1">
    <div id="post-1-conta">
        <h2 id="post-1-contaco-titulo"><?php echo $varEspecifico['nombre']; ?></h2>
        <img src="<?php echo $rutaFinal ?>contenido/assets/<?php echo $varEspecifico['imagen'] ?>.jpg" alt="<?php echo $varEspecifico['alt'] ?>" id="post-1-conta-img">
        <div id="post-1-contaco">
            <p id="post-1-contaco-introduccion"><?php echo $varEspecifico['descripcion'] ?></p>
        </div>
    </div>
    <div id="post-compartir">
        <p>Compartelo en tus redes sociales</p>
        <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $rutaFinal ?>contenido/noticia/<?php echo $varEspecifico['url_amigable']; ?>&title=<?php echo $varEspecifico['nombre']; ?>&description=<?php echo $varEspecifico['descripcion']; ?>&imagen=<?php echo $rutaFinalNoticias ?>contenido/assets/<?php echo $varEspecifico['imagen_p']; ?>.jpg"
           class="post-compartir-red facebook compartir-facebook" target="_blank"></a>
        <a href="http://twitter.com/intent/tweet?status=<?php echo $varEspecifico['descripcion']; ?> - <?php echo $rutaFinal ?>contenido/noticia/<?php echo $varEspecifico['url_amigable']; ?> "
           class="post-compartir-red twitter compartir-twitter" target="_blank"></a>                    
    </div>          
    <?php
    if (($varEspecifico['video'] != '') || ($varEspecifico['video'] != null)) {
        ?>
        <div id="post-1-video">
            <div id="post-1-video-cont">
                <h3 id="post-1-video-titulo"><?php echo $varEspecifico['tvideo'] ?></h3>
                <p id="post-1-video-contenido"><?php echo $varEspecifico['cvideo'] ?></p>
            </div>
            <div id="post-1-video-video">
                <?php echo $varEspecifico['video'] ?>
            </div>
        </div>
    <?php } ?>
    <?php
    if (($varEspecifico['contenido'] != '') || ($varEspecifico['contenido'] != null)) {
        ?>
        <div id="post-1-contenido">
            <p><?php echo $varEspecifico['contenido']; ?></p>
        </div>
    <?php } ?>
</div>