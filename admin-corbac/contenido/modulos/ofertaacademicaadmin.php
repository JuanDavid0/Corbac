<?php
require_once './contenido/clases/oferta.php';
$registros = oferta::cargarOfertaPadre();
?>
<div id="contenedor-AreaTrabajo-Admin">
    <div class="contenedor-Agregar-personas">
        <a class="ico-agregar Agregar-persona" href="<?php echo $rutaFinal; ?>crearofertaadmin">Crear</a>
    </div>

    <div id="contenedor-personas-admin">
        <?php
        $xhtml = "";
        $xhtml .= "<div id=\"contenedor-personas-admin-label\"><div>Imagen</div><div>Url</div><div>Nombre</div><div>Acciones</div></div>";
        foreach ($registros as $indice => $campo) {
            $xhtml .= "<div class=\"contenedor-persona-admin\">";
            $xhtml .= "<p class=\"tit-persona-admin img-banner-admin\" style=\"background-image:url('" . $rutaFinalAssets . "../../../contenido/assets/" . $campo['imagen_p'] . "');\"></p>";
            $xhtml .= "<p class=\"tit-persona-admin\">" . $campo['url_amigable'] . "</p>";
            $xhtml .= "<p class=\"tit-persona-admin\">" . $campo['nombre'] . "</p>";
            $xhtml .= "<p class=\"tit-persona-admin\">";

            $xhtml .= "<a title=\"Editar\" class=\"log-persona-admin log-persona-ed fa-editar\" href=\"" . $rutaFinal . "editarofertaadmin/" . $campo['url_amigable'] . "\"></a>";
            $xhtml .= "<a title=\"Ver oferta\" class=\"log-persona-admin log-persona-ed fa-search1\" href=\"" . $rutaFinal . "ofertaespecificaadmin/" . $campo['url_amigable'] . "\"></a>"; 
            $xhtml .= "</p>";
            $xhtml .= "</div>";
        }
        if ($xhtml !== "") {
            echo $xhtml;
        } else {
            echo "Aun no hay ofertas registrados";
        }
        ?>
    </div>
</div>