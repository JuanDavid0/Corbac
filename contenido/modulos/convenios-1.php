<?php
$idModulo = consultaModulo("convenios-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="convenios-1">
    <h3 id="convenios-1-titulo">
        <?php echo $varcontenido[0]; ?>
    </h3>
    <div id="convenios-1-contenedor">
        <?php
        $consultaservicios = consultaServicios(0);
        while ($resservicios = mysqli_fetch_array($consultaservicios)) {
            ?>
            <div class="convenios-1-serv">
                <h4 class="convenios-1-serv-titulo">
                    <?php echo $resservicios['titulo']; ?>
                </h4>
                <?php
                $consultasubcat = consultaSubServicios($resservicios['titulo'], 4);
                while ($ressubcat = mysqli_fetch_array($consultasubcat)) {
                    ?>
                    <div class="convenios-1-servesp">
                        <a href="<?php echo $rutaFinal . $resservicios['url_amigable'] . '/' . $ressubcat['url_amigable']; ?>"
                            class="convenios-1-servesp-img">
                            <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $ressubcat['imagen']; ?>"
                                alt="Imagen">
                        </a>
                        <div class="convenios-1-servesp-contenido">
                            <h3 class="convenios-1-servesp-contenido-titulo">
                                <a
                                    href="<?php echo $rutaFinal . $resservicios['url_amigable'] . '/' . $ressubcat['url_amigable']; ?>"><?php echo $ressubcat['titulo']; ?></a>
                            </h3>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>