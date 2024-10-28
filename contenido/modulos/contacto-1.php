<?php
$idModulo = consultaModulo("contacto-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="contacto-1">
    <h2><?php echo $varcontenido[0]?></h2>
    <p>
        <?php echo $varcontenido[1]?>
    </p>
    <div id="forma-contacto">
        <article class="contactenos">
            <section class="lineas-atencion">
                <h2 class="headline">
                    Lineas de atención
                </h2>
                <ul>
                    <h3>
                    <?php echo $varcontenido[2]?>
                    </h3>
                    <li>
                        <a href="http://wa.me/57<?php echo $varcontenido[3]?>"><?php echo preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1 $2 $3', $varcontenido[3]); ?></a>
                    </li>
                    <h3>
                    <?php echo $varcontenido[4]?>
                    </h3>
                    <li>
                        <a href="http://wa.me/57<?php echo $varcontenido[5]?>"><?php echo preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1 $2 $3', $varcontenido[5]); ?></a>
                    </li>
                    <h3>
                    <?php echo $varcontenido[6]?>
                    </h3>
                    <li>
                        <a href="http://wa.me/57<?php echo $varcontenido[7]?>"><?php echo preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1 $2 $3', $varcontenido[7]); ?></a>
                    </li>
                </ul>
            </section>
            <div class="formulario">
                <h2 class="headline">Formulario</h2>
                <iframe src="https://www.youtube.com/embed/333fq4ZcV54" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </article>
    </div>
</div>