<?php
$separador = explode('---', $msg);
$msg = $separador[0];
$idAlerta = $separador[1];
require_once './contenido/clases/pagina.php';
$registros = pagina::modulosPaginaNivel1('pagina_modulo', $msg);
?>
<div id="contenedor-AreaTrabajo-Admin">       
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
        <?php
        if ($idAlerta == '1') {
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
        <?php } else if ($idAlerta == '2') { ?>
            <div class="alerta">
                <div class="alerta-titulo alerta-error-color1">Ha ocurrido un error</div>
                <div class="alerta-icono closec alerta-error-color1"></div>
                <p id="respuestaLogin" class="alerta-texto">
                    Lo sentimos, No se pudo editar, Vuelve a intentarlo.
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
    <div class="contenedor-Agregar-personas">        
    </div>
    <div id="contenedorRespuesta" class="contenedorRespuesta">
        <div id="confirmeEliminar" class="confirmar">
            <input id="idEliminar" type="text" style="display: none;">
            <input id="usuarioEliminar" type="text" style="display: none;">            
            <div class="alerta-titulo alerta-error-color1">¿Realmente desea eliminar este banner?</div>
            <div class="alerta-icono closec alerta-error-color1"></div>
            <div class="alerta-boton alerta-ok-fondo" onclick="eliminarValor(); ocultarConfirmar('confirmeEliminar')">
                <p>Si</p>
            </div>  
            <div class="alerta-boton alerta-error-color1" onclick="ocultarConfirmar('confirmeEliminar')">
                <p>Cancelar</p>
            </div>  
        </div>
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
        <?php } else if ($msg == '2') { ?>
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
        $xhtml .= "<div id=\"contenedor-personas-admin-label\"><div>Imagen / Titulo</div><div style=\"text-align: center;\">Titulo / Texto</div><div>Idioma</div><div>Acciones</div></div>";
        foreach ($registros as $indice => $campo) {            
            $registrosModulo = pagina::contenidoModulosPaginaNivel1('galeria', $campo['identificador_pagina'], $campo['identificador_modulo']);            
            foreach ($registrosModulo as $indice => $campo1) {
                $xhtml .= "<div class=\"contenedor-persona-admin\">";
                if($campo1['imagen'] != ''){
                    $xhtml .= "<p class=\"tit-persona-admin img-banner-admin\" style=\"background-image:url('".$rutaFinal."contenido/assets/".$campo1['imagen']."');\"></p>";
                    $xhtml .= "<p class=\"tit-persona-admin\">" . $campo1['nombre'] . "</p>";
                }else{
                    $xhtml .= "<p class=\"tit-persona-admin\">" . $campo1['nombre'] . "</p>";
                    $xhtml .= "<p class=\"tit-persona-admin\">" . $campo1['texto'] . "</p>";
                    
                }                                                
                $xhtml .= "<p class=\"tit-persona-admin\">" . $campo1['idioma'] . "</p>";
                $xhtml .= "<p class=\"tit-persona-admin\">";
                $xhtml .= "<a title=\"Editar\" class=\"log-persona-admin log-persona-ed fa-editar\" href=\"" . $rutaFinal . "editarcontenidomodulo/" . $campo1['identificador'] . "\"></a>";
                $xhtml .= "</p>";
                $xhtml .= "</div>";
            }
        }
        if ($xhtml !== "") {
            echo $xhtml;
        } else {
            echo "Aun no hay noticias registrados";
        }
        ?>
    </div>    
</div>      