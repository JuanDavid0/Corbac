<?php
require_once './contenido/clases/galeria.php';
$noticiaSeleccionada = isset($_GET['noticia']) ? $_GET['noticia'] : null;

// Consultar galería, todas si no hay noticia seleccionada
$registros = Galeria::listarGaleria('galeria', $noticiaSeleccionada);

$msg = isset($_GET['msg']) ? $_GET['msg'] : ''; // Verificar si $msg está definido
?>

<div id="contenedor-AreaTrabajo-Admin">
    <div class="contenedor-Agregar-personas">
        <a class="ico-agregar Agregar-persona" href="<?php echo htmlspecialchars($rutaFinal . 'registrogaleria/'); ?>">Agregar</a>
    </div>

    <div id="contenedorRespuesta" class="contenedorRespuesta">
        <div id="confirmeEliminar" class="confirmar">
            <input id="idEliminar" type="text" style="display: none;">
            <input id="usuarioEliminar" type="text" style="display: none;">
            <div class="alerta-titulo alerta-error-color1">¿Realmente desea eliminar este noticia?</div>
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
        <?php } else if ($msg == '2') { ?>
            <div class="alerta">
                <div class="alerta-titulo alerta-error-color1">Ha ocurrido un error</div>
                <div class="alerta-icono closec alerta-error-color1"></div>
                <p id="respuestaLogin" class="alerta-texto">Lo sentimos, No se pudo crear, Vuelve a intentarlo.</p>
                <div class="alerta-boton alerta-error-fondo1" onclick="ocultarAlerta()">
                    <p>Cerrar</p>
                </div>
            </div>
        <?php } ?>
    </div>

    <form id="form-filtro">
        <label for="filtroNoticia">Filtrar por noticia:</label>
        <select id="filtroNoticia" name="noticia" onchange="filtrarGaleria()">
            <option value="">Todas las noticias</option>
            <?php
            $noticias = Galeria::noticiasDisponibles('noticia');
            foreach ($noticias as $noticia) {
                echo '<option value="' . htmlspecialchars($noticia['url_amigable']) . '"' . ($noticia['url_amigable'] == $noticiaSeleccionada ? ' selected' : '') . '>' . htmlspecialchars($noticia['nombre']) . '</option>';
            }
            ?>
        </select>
    </form>

    <div id="contenedor-personas-admin">
        <?php
        echo "<div id=\"contenedor-personas-admin-label\"><div>Imagen</div><div>Noticia</div><div>Acciones</div></div>";
        if ($registros) {
            foreach ($registros as $campo) {
                echo '<div class="contenedor-persona-admin">';
                echo '<p class="tit-persona-admin img-banner-admin" style="background-image:url(\'/contenido/assets/' . htmlspecialchars($campo['imagen']) . '\');"></p>';
                echo '<p class="tit-persona-admin">' . htmlspecialchars($campo['nombre']) . '</p>';
                echo '<p class="tit-persona-admin">';
                echo '<a class="log-persona-admin log-persona-ed fa-eliminar" onclick="mostrarConfirmar(\'confirmeEliminar\', ' . $campo['identificador'] . ')"></a>';
                echo '</p>';
                echo '</div>';
            }
        } else {
            echo 'No hay imágenes disponibles.';
        }
        ?>
    </div>
</div>

<script>
    function filtrarGaleria() {
        var noticia = document.getElementById('filtroNoticia').value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'contenido/ajax/ajaxGaleria.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status == 200) {
                document.getElementById('contenedor-personas-admin').innerHTML = xhr.responseText;
            }
        };
        xhr.send('accion=filtrar&noticia=' + encodeURIComponent(noticia));
    }
</script>