<?php
$idModulo = consultaModulo("landing-3");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="landing-3">
    <h3 id="landing-3-titulo"><?php echo $varcontenido[0]; ?></h3>
    <div id="landing-3-contenido">
        <?php              
        $consultalanding = consultaServiciosP($con, $idioma);
        while ($reslanding = mysqli_fetch_array($consultalanding)) {
            ?>
            <div class="landing-3-esp">
                <h4 class="landing-3-esp-titulo">
                    <a href="<?php echo $ruta.$con."/".$reslanding['url_amigable'];?>"><?php echo $reslanding['titulo']; ?></a>                        
                </h4>
                <div class="landing-3-esp-img" style="background-image: url('<?php echo $rutaFinal?>contenido/assets/<?php echo $reslanding['imagen']; ?>');">	                    
                        <a href="<?php echo $ruta.$con."/".$reslanding['url_amigable'];?>" class="landing-3-esp-capa"></a>                    
                </div>
                <div class="landing-3-esp-contenido">                        
                            
                    <div class="landing-3-esp-contenido-texto">
                        <p><?php echo $reslanding['descripcion_Corta']; ?></p>
                    </div>
                    <a href="<?php echo $ruta.$con."/".$reslanding['url_amigable'];?>" class="landing-3-esp-contenido-boton">Leer más</a>
                </div>
            </div>
<?php } ?>
    </div>
</div>