<?php
require_once './contenido/clases/convenio.php';

$registros = Convenio::listaConvenio('convenio');
?>

<div id="contenedor-AreaTrabajo-Admin">
    <div class="contenedor-Agregar-personas">
    </div>

    <div id="contenedor-personas-admin">
        <?php
        $xhtml = "";
        $xhtml .= "<div id=\"contenedor-personas-admin-label\"><div>Imagen</div><div>Nombre</div><div>Acciones</div></div>";
        foreach ($registros as $indice => $campo) {
            $xhtml .= "<div class=\"contenedor-persona-admin\">";
            $xhtml .= "<p class=\"tit-persona-admin img-banner-admin\" style=\"background-image:url('" . trim($rutaFinalAssets) . "contenido/assets/" . trim($campo['imagen']) . "');\"></p>";


            $xhtml .= "<p class=\"tit-persona-admin\">" . $campo['nombre'] . "</p>";
            $xhtml .= "<p class=\"tit-persona-admin\">";

            $xhtml .= "<a title=\"Editar\" class=\"log-persona-admin log-persona-ed fa-editar\" href=\"" . $rutaFinal . "editarconvenioadmin/" . $campo['identificador'] . "\"></a>";
            $xhtml .= "</p>";
            $xhtml .= "</div>";
        }
        if ($xhtml !== "") {
            echo $xhtml;
        } else {
            echo "Aun no hay banner registrados";
        }
        ?>
    </div>
</div>