<?php
date_default_timezone_set("America/Bogota");
require_once './conexion/bdconexion.php';
require_once './contenido/clases/pagina.php';
$objCms = new pagina();
$nombrePersona = "Admin Frutalia";
$categoria = $objCms->categoriaPagina($con);
$fehcaServidor = getdate(time());
$fecha_hoy = "" . $fehcaServidor['year'] . "-" . $fehcaServidor['mon'] . "-" . $fehcaServidor['mday'];
?>
<div id="contenedor-menuAdmin">    
    <div id="contenedor-menuAdmin-informacion">
        <div id="contenedor-menuAdmin-info-img"><img src="<?php echo $rutaFinal; ?>contenido/assets/anbutb.png" alt="Logo"></div>            
        <h3 id="log-usuario">Administrador</h3>   
        <br>
        <nav class="nav-menuAdmin">      
            <?php
            $paginas = $objCms->consultaMenu();
            $xhtml = "";
            foreach ($paginas as $indice => $campo) {
                if ($campo['categoria'] == $categoria['categoria']) {
                    $xhtml .= "<li class=\"activoDonde\"> ";
                } else {
                    $xhtml .= "<li>";
                }
                $xhtml .= "<div class=\"nav-menuAdmin-icono\" style=\"background-image: url('" . $rutaFinal . "contenido/assets/iconos/" . $campo['imagen_p'] . "');\"></div>";
                $xhtml .= "<a href=\"" . $rutaFinal . $campo['identificador'] . " \">" . $campo['nombre'] . "</a></li>";
            }
            echo $xhtml;
            ?>                                  
        </nav>
        <div class="salirAdmin">
            <form method="GET" action="<?php echo $rutaFinal ?>contenido/controlador/controladorLogueo.php">
                <input type="text" name="accion" style="display:none" value="cerrarSesion">                                     
                <button type="submit">Cerrar Sesión</button>
            </form>
        </div>
    </div>
</div>