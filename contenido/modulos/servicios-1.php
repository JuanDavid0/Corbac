<?php
$idModulo = consultaModulo("servicios-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="servicios-1">
    <h3 id="servicios-1-titulo">
        <?php echo $varcontenido[0]; ?>        
    </h3>
    <div id="servicios-1-contenedor">
        <?php
        $consultaservicios = consultaServicios(0);
        while ($resservicios = mysqli_fetch_array($consultaservicios)) {
            ?>
            <div class="servicios-1-serv">
                <h4 class="servicios-1-serv-titulo">
                    <?php echo $resservicios['titulo']; ?>
                </h4>
                <?php                
                $consultasubcat = consultaSubServicios($resservicios['titulo'], 4);
                while ($ressubcat = mysqli_fetch_array($consultasubcat)) {
                    ?>
                    <div class="servicios-1-servesp">
                        <a href="<?php echo $rutaFinal.$resservicios['url_amigable'].'/'.$ressubcat['url_amigable']; ?>" style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $ressubcat['imagen']; ?>');" class="servicios-1-servesp-img"></a>
                        <div class="servicios-1-servesp-contenido">
                            <h5 class="servicios-1-servesp-contenido-titulo">
                                <a href="<?php echo $rutaFinal.$resservicios['url_amigable'].'/'.$ressubcat['url_amigable']; ?>"><?php echo $ressubcat['titulo']; ?></a>
                            </h5>
                            <p class="servicios-1-servesp-contenido-presentacion"><?php echo $ressubcat['descripcion_Corta']; ?></p>
                            <a href="<?php echo $rutaFinal.$resservicios['url_amigable'].'/'.$ressubcat['url_amigable']; ?>" class="servicios-1-servesp-contenido-boton">Leer Más</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>