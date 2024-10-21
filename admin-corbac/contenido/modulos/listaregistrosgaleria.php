<?php
require_once './contenido/clases/galeria.php';

$registros = Galeria::listarGaleria('galeria', 'noticia');

?>

<div id="contenedor-AreaTrabajo-Admin">

    <div class="contenedor-Agregar-personas">
        <a class="ico-agregar Agregar-persona" href="<?php echo htmlspecialchars($rutaFinal . 'registrogaleria/'); ?>">Agregar</a>
    </div>

    <div id="contenedorRespuesta" class="contenedorRespuesta">
        <div id="confirmeEliminar" class="confirmar">
            <input id="idEliminar" type="text" style="display: none;">
            <input id="usuarioEliminar" type="text" style="display: none;">

            <div class="alerta-titulo alerta-error-color1">¿Realmente desea eliminar este Cliente?</div>
            <div class="alerta-icono closec alerta-error-color1"></div>
            
            <div class="alerta-boton alerta-ok-fondo" onclick="eliminarValor(); ocultarConfirmar('confirmeEliminar')">
                <p>Si</p>
            </div>
            <div class="alerta-boton alerta-error-color1" onclick="ocultarConfirmar('confirmeEliminar')">
                <p>Cancelar</p>
            </div>
        </div>

        <?php if ($msg == '1') { ?>
            <div class="alerta">
                <div class="alerta-titulo alerta-ok-color">Operación Éxitosa</div>
                <div class="alerta-icono ico-check alerta-ok-color"></div>
                <p id="respuestaLogin" class="alerta-texto">La operación se ha realizado con Éxito</p>
                <div class="alerta-boton alerta-ok-fondo" onclick="ocultarAlerta()">
                    <p>Cerrar</p>
                </div>
            </div>
            <script type="text/javascript">
                mostrarAlerta();
            </script>
        <?php } else if ($msg == '2') { ?>
            <div class="alerta">
                <div class="alerta-titulo alerta-error-color1">Ha ocurrido un error</div>
                <div class="alerta-icono closec alerta-error-color1"></div>
                <p id="respuestaLogin" class="alerta-texto">Lo sentimos, No se pudo crear, Vuelve a intentarlo.</p>
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
        $xhtml = "<div id=\"contenedor-personas-admin-label\"><div>Imagen</div><div>Noticia</div><div>Acciones</div></div>";
        foreach ($registros as $campo) {
            $xhtml .= "<div class=\"contenedor-persona-admin\">";
            $xhtml .= "<p class=\"tit-persona-admin img-banner-admin\" style=\"background-image:url('" . htmlspecialchars($rutaFinalAssets . "contenido/assets/" . $campo['imagen']) . "');\"></p>";
            $xhtml .= "<p class=\"tit-persona-admin\">" . htmlspecialchars($campo['nombre']) . "</p>";
            $xhtml .= "<p class=\"tit-persona-admin\">";
            $xhtml .= "<a class=\"log-persona-admin log-persona-ed fa-eliminar\" onclick=\"mostrarConfirmar('confirmeEliminar'," . $campo['identificador'] . ") \"></a>";
            $xhtml .= "</p>";
            $xhtml .= "</div>";
        }
        if ($xhtml !== "") {
            echo $xhtml;
        } else {
            echo "Aún no hay imágenes registradas para esta noticia.";
        }
        ?>
    </div>
</div>