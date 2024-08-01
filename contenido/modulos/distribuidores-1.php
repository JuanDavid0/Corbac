<?php
$idModulo = consultaModulo("distribuidores-1");
$consulta_historia_modulo = consultaInfoModuloGolbal($idModulo, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
$consulta_ciudades = consultaCiudadDistribuidores();
$xhtml = "";
$xhtml .= "<div id=\"distribuidores-1\">";
while ($resciudades = mysqli_fetch_array($consulta_ciudades)) {
    $xhtml .= "<div class=\"contenedor-ciudad \">";
    $consulta_distribuidores = consultaDistribuidores($resciudades['ciudad']);
    $xhtml .= "<h2 class=\"titulo-ciudad\">".$resciudades['ciudad']."</h2>";
    $xhtml .= "<div class=\"contenedor-distribuidores\">";
    while ($distribuidor = mysqli_fetch_array($consulta_distribuidores)) {
        $xhtml .= "<div class=\"contenedor-distribuidor\">";
        $xhtml .= "<h3>".$distribuidor['nombre']."</h3>";
        $xhtml .= "<p><span>".$varcontenido[0]."</span> " .$distribuidor['direccion']."</p>";
        $xhtml .= "<p><span>".$varcontenido[1]."</span> ".$distribuidor['descripcion']."</p>";
        $xhtml .= "<p><span>".$varcontenido[2]."</span> ".$distribuidor['horario']."</p>";                
        $xhtml .= "</div>";
    }        
    $xhtml .= "</div>";
    $xhtml .= "</div>";
}    
$xhtml .= "</div>";
echo $xhtml;                                   