<?php
require_once './contenido/clases/galeriaNosotros.php'; // En este caso para las consultas enfocodas al banner, se utiliza como tipo de objeto en el cual los valores de las consultas se almacenan en los atributos de esta clase banner, por lo cual contien las consultas y los tributos donde se van a alamcenar las respuestas en cada conulta.
$registros = GaleriaNosotros::listaNosotrosInicio('galeria'); // por medio de la consulta se trae todos los registros de la tabla banner
?>
<div id="contenedor-AreaTrabajo-Admin">
    <div class="contenedor-Agregar-personas">
    </div>

    <div id="contenedorRespuesta" class="contenedorRespuesta">
        <?php
        if ($msg == '1') {
        ?>
            <div class="alerta">
                <div class="alerta-titulo alerta-ok-color">Operación Éxitosa</div>
                <div class="alerta-icono ico-check alerta-ok-color"></div>
                <p id="respuestaLogin" class="alerta-texto">
                    La operación se ha realizado con Éxito
                </p>
                <div class="alerta-boton alerta-ok-fondo" onclick="ocultarAlerta()">
                    <p>Cerrar</p>
                </div>
            </div>
            <script type="text/javascript">
                mostrarAlerta();
            </script>
        <?php } else if ($msg == '2') {  ?>
            <div class="alerta">
                <div class="alerta-titulo alerta-error-color1">Ha ocurrido un error</div>
                <div class="alerta-icono closec alerta-error-color1"></div>
                <p id="respuestaLogin" class="alerta-texto">
                    Lo sentimos, No se pudo crear, Vuelve a intentarlo.
                </p>
                <div class="alerta-boton alerta-error-fondo1" onclick="ocultarAlerta()">
                    <p>Cerrar</p>
                </div>
            </div>
            <script type="text/javascript">
                mostrarAlerta();
            </script>
        <?php } ?>
    </div>

    <div id="contenedor-personas-admin">
        <?php
        $xhtml = "";
        $xhtml .= "<div id=\"contenedor-personas-admin-label\"><div>Imagen</div><div>Texto</div><div>Idioma</div><div>Acciones</div></div>";
        foreach ($registros as $indice => $campo) {
            $xhtml .= "<div class=\"contenedor-persona-admin\">";
            $xhtml .= "<p class=\"tit-persona-admin img-banner-admin\" style=\"background-image:url('" . $rutaFinalAssets . "contenido/assets/" . $campo['imagen'] . "');\"></p>";

            //informaciond del banner
            $xhtml .= "<p class=\"tit-persona-admin\">" . $campo['texto'] . "</p>";
            $xhtml .= "<p class=\"tit-persona-admin\">" . $campo['idioma'] . "</p>";
            $xhtml .= "<p class=\"tit-persona-admin\">";

            //botones para editar y eliminar
            $xhtml .= "<a title=\"Editar\" class=\"log-persona-admin log-persona-ed fa-editar\" href=\"" . $rutaFinal . "editarnosotrosadmin/" . $campo['identificador'] . "\"></a>";
            $xhtml .= "</p>";
            $xhtml .= "</div>";
        }
        if ($xhtml !== "") {
            echo $xhtml;
        } else {
            echo "Aun no hay datos registrados";
        }
        ?>
    </div>
</div>