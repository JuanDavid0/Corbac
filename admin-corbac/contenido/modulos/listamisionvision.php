<?php
require_once './contenido/clases/misionvision.php';

$registros = MisionVision::listaMisionVision('contenido');
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
        $xhtml .= "<div id=\"contenedor-personas-admin-label\"><div>Mision/Vision</div><div>Contenido</div><div>Acciones</div></div>";
        $contenido = [];
        $titulo = [];

        foreach ($registros as $campo) {
            if ($campo['indice'] % 2 == 1) {
                $titulo[] = $campo;
            } else {
                $contenido[] = $campo;
            }
        }
        $total = max(count($contenido), count($titulo));
        for ($i = 0; $i < $total; $i++) {
            $xhtml .= "<div class=\"contenedor-persona-admin\">";

            if (isset($titulo[$i])) {
                $xhtml .= "<p class=\"tit-persona-admin\">" . htmlspecialchars($titulo[$i]['contenido']) . "</p>";
            } else {
                $xhtml .= "<p class=\"tit-persona-admin\"></p>";
            }

            if (isset($contenido[$i])) {
                $xhtml .= "<p class=\"tit-persona-admin\">" . htmlspecialchars($contenido[$i]['contenido']) . "</p>";
            } else {
                $xhtml .= "<p class=\"tit-persona-admin\"></p>";
            }

            $xhtml .= "<p class=\"tit-persona-admin\">";

            $xhtml .= "<a title=\"Editar\" class=\"log-persona-admin log-persona-ed fa-editar\" href=\"" . $rutaFinal . "editarmisionvisionadmin/" . $contenido[$i]['identificador'] . "\"></a>";
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