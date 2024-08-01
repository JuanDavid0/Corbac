<?php
$idModulo = consultaModulo("pago-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="pago-1">
    <h3 id="pago-1-titulo"><?php echo $varcontenido[0]; ?></h3>
    <div id="pago-1-contenedor">
        <?php
            $consultapago = consultaPago($varEspecifico['url_amigable'],$idioma);
            while ($pago = mysqli_fetch_array($consultapago)) {
        ?>
        <div class="pago-1-servicio">
            <div class="pago-1-servicio-icono <?php echo $pago['icono'] ?>"></div>
            <div class="pago-1-servicio-contenido">
                <p><?php echo $pago['nombre'] ?></p>
                <?php if($pago['valor'] != ""){ ?>
                <span><?php echo $pago['valor'] ?></span>
                <?php } ?>
                <?php if($pago['url'] != ""){ ?>
                <a href="<?php echo $pago['url'] ?>"><?php echo $varcontenido[1]; ?></a>
                <?php } else { ?>
                <a href="<?php echo $ruta ?>contacto"><?php echo $varcontenido[2]; ?></a>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>