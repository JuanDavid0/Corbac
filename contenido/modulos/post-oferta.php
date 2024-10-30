<?php
$idModulo = consultaModulo("post-oferta");
$url_noticia = $varEspecifico['url_amigable'];
?>
<div class="post-oferta">
    <div class="post-oferta-titulo">
        <h1><?php echo $varEspecifico['nombre']; ?></h1>
        <div class="img-container">
            <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varEspecifico['imagen1']; ?>"
                class="logo" alt="Image">
        </div>
        <h2>
            <?php echo $varEspecifico['descripcion']; ?>
        </h2>
    </div>
    <div id="post-oferta-contenido">
        <section class="post-oferta-contenido-1">
            <h3 class="headline">Título que otorga</h3>
            <p>
                <?php echo $varEspecifico['contenido1']; ?>
            </p>
            <h3 class="headline">Duración:</h3>
            <p>
                <?php echo htmlspecialchars_decode($varEspecifico['contenido_duracion']); ?>
            </p>
            <h3 class="headline">Modalidad:</h3>
            <p>
                <?php echo $varEspecifico['contenido_modalidad']; ?>
            </p>
            <h3 class="headline">APROBADO MINISTERIO DE EDUCACIÓN:</h3>
            <p>
                <?php echo $varEspecifico['contenido_aprobado']; ?>
            </p>
        </section>
        <section class="post-oferta-contenido-2">
            <div class="img-container">
                <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varEspecifico['imagen2']; ?>"
                    class="perfil" alt="Image">
            </div>
            <div class="text-container">
                <h2 class="headline">Perfil profesional</h2>
                <p>
                    <?php echo $varEspecifico['contenido2']; ?>
                </p>
            </div>
        </section>
        <section class="content">
            <h3 class="headline">Plan de estudios</h3>
            <div class="contenedor-content">
                <p>
                    <?php echo $varEspecifico['contenido3']; ?>
                </p>
                <a href="<?php echo $varEspecifico['plan_enlace'] ?>">Descargar plan de estudios</a>
            </div>
        </section>
        <div class="section-last">
            <section class="post-oferta-contenido-3">
                <h3 class="headline">Costos</h3>
                <p>
                    <?php echo htmlspecialchars_decode($varEspecifico['contenido4']); ?>
                </p>
            </section>
            <section class="post-oferta-contenido-4">
                <h3 class="headline">Requisitos de admisión </h3>
                <p>
                    <?php echo htmlspecialchars_decode($varEspecifico['contenido5']); ?>
                </p>
            </section>
        </div>
    </div>
</div>