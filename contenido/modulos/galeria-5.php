<?php
$idModulo = consultaModulo("galeria-5");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
$contador0 = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
if($con != "servicio"){
    $conaux = $con;
} else {
    $conaux = $varEspecifico['url_amigable'];
}
$consultagaleria = consultaGaleria($idModulo,$conaux,$idioma);
?>
<div id="contenedor-galeria-5">    
    <h4><?php echo $varcontenido[0]; ?></h4>
        <?php while ($galeria = mysqli_fetch_array($consultagaleria)) {
            ?> 
            <div class="galeria-5">
                <div class="slide-galeria-5" >
                    <div class="siguienteGaleria right" onclick="galeryClick(1,<?php echo $galeria['identificador']; ?>);"></div>
                    <div class="anteriorGaleria left" onclick="galeryClick(-1,<?php echo $galeria['identificador']; ?>);"></div>
                    <?php                    
                    $imagenes = explode(",", $galeria['imagen']);
                    $contador1 = 0;
                    foreach ($imagenes as $imagen) {
                        ?>
                    <div class="slideImg slideImg-<?php echo $galeria['identificador']; ?>"
                         style ="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $imagen ?>'); <?php if($contador1 == 0){ echo "left: 0%;"; } ?>  "></div> 
                    <?php  $contador1 ++;} ?>                                 
                </div>
            </div>
        <?php 
        if ($contador0 == 0) { $contador0++; } else { $contador0 = 0; }
                         } ?>
</div>