<?php
require_once './contenido/clases/landing.php';
$registros = Landing::listaLanding('landing');
?>
<div id="contenedor-AreaTrabajo-Admin">
    <div class="contenedor-Agregar-personas">
        <a class="ico-agregar Agregar-persona" href="<?php echo $rutaFinal; ?>crearlandingadmin">Crear</a>
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
        $xhtml .= "<div id=\"contenedor-personas-admin-label\"><div>Titulo</div><div>Contenido</div><div>Fecha final</div><div>Acciones</div></div>";
        foreach ($registros as $indice => $campo) {
            $xhtml .= "<div class=\"contenedor-persona-admin\">";

            //informaciond del banner
            $xhtml .= "<p class=\"tit-persona-admin\">" . $campo['titulo'] . "</p>";
            $xhtml .= "<p class=\"tit-persona-admin\">" . $campo['contenido'] . "</p>";

            $xhtml .= "<p class=\"tit-persona-admin\">" . $campo['fecha_fin'] . "</p>";
            $xhtml .= "<p class=\"tit-persona-admin\">";

            //botones para editar y eliminar
            $xhtml .= "<a title=\"Editar\" class=\"log-persona-admin log-persona-ed fa-editar\" href=\"" . $rutaFinal . "editarlandingadmin/" . $campo['identificador'] . "\"></a>";
            $xhtml .= "</p>";
            $xhtml .= "</div>";
        }
        if ($xhtml !== "") {
            echo $xhtml;
        } else {
            echo "Aun no hay landing registrados";
        }
        ?>
    </div>
</div>