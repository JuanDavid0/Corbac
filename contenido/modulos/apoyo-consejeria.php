<?php
$idModulo = consultaModulo("apoyo-consejeria");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="apoyo-1">
    <h1><?php echo $varcontenido[0] ?></h1>
    <h3><?php echo $varcontenido[1] ?></h3>
    <div id="forma-apoyo">
        <article class="apoyo-article">
            <section class="atencion">
                <h2 class="headline">Información y Contacto</h2>
                <ul>
                    <h3><?php echo $varcontenido[2] ?></h3>
                    <h3><?php echo $varcontenido[3] ?></h3>
                    <a href="mailto:<?php echo $varcontenido[4] ?>">
                        <h3><?php echo $varcontenido[4] ?></h3>
                    </a>
                </ul>
            </section>
            <div class="formulario">
                <h2 class="headline">Formulario</h2>
            </div>
        </article>
    </div>
</div>