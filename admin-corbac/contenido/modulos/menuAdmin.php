<?php

// este modulo se relaciona con cada pagina a la cual se edita, ejemplo para la pagina banneradmin tiene relacionado el 142 que corresponde a este modulo y así con todas las paginas del panel administrativo. Para que se ubique el menú lateral y tambien la pagina relaciona otro modulo que corresponde a la parte derecha.

date_default_timezone_set("America/Bogota");
require_once './conexion/bdconexion.php'; // traer la conexion a la base de datos

/** CLASES DIRECTORY 
 * En la carpeta de clases lo que hace es almacenar las consultas, pero a diferencia de corbac
 * agrupa las consultas por clase, en este caso tiene las consultas principales o genraicas que 
 * se requieren en una pagina.
 */
require_once './contenido/clases/pagina.php'; 

$objCms = new pagina(); // Instancia de la clase pagina que contiene las consultas generales
$nombrePersona = "Admin Frutalia";

$categoria = $objCms->categoriaPagina($con); // Consulta la categoria de la pagina en este caso la categoria es banneradmin. la url es (http://corbac.com/an-admin/banneradmin) por lo que la cat es el tercer parametro de la url

$fehcaServidor = getdate(time());
$fecha_hoy = "" . $fehcaServidor['year'] . "-" . $fehcaServidor['mon'] . "-" . $fehcaServidor['mday'];
?>
<div id="contenedor-menuAdmin">    
    <div id="contenedor-menuAdmin-informacion">
        <div id="contenedor-menuAdmin-info-img"><img src="<?php echo $rutaFinal; ?>contenido/assets/logo.webp" alt="Logo"></div>            
        <h3 id="log-usuario">Corbac Administrador</h3>   
        <br>
            <!-- en este nav-menuAdmin se carga la lista de paginas que van aestar en este menú lateral-->
        <nav class="nav-menuAdmin">      
            <?php
            //Esta consulta me trae las paginas que la gerarquia = 1 AND nivel = 0; es decir las paginas principales
            $paginas = $objCms->consultaMenu();
            // En consultaMenu, se debe reeplazar por SELECT identificador, nombre, categoria FROM pagina WHERE estado = 'activo' AND archivo = 'menu' AND nivel = 0 ORDER BY orden;; para CORBAC

            $xhtml = "";
            foreach ($paginas as $indice => $campo) { // recorro las paginas para mostrarlas en el menu
                // en este if lo que hace es identificar las paginas que corresponden a la categoria de la pagina actual, que en este caso es banneradmin.
                if ($campo['categoria'] == $categoria['categoria']) {
                    $xhtml .= "<li class=\"activoDonde\"> ";
                } else {
                    $xhtml .= "<li>";
                }
                // el cada li se le asigna un icono que se carga desde la carpeta de iconos y el nombre de la pagina con su respectivo redireccionamiento
                $xhtml .= "<div class=\"nav-menuAdmin-icono\" style=\"background-image: url('" . $rutaFinal . "contenido/assets/iconos/" . $campo['imagen_p'] . "');\"></div>";
                $xhtml .= "<a href=\"" . $rutaFinal . $campo['identificador'] . " \">" . $campo['nombre'] . "</a></li>";
            }
            echo $xhtml;
            ?>                                  
        </nav>

        <!-- FALTA POR REVISAR :( quiero mimir-->
        <div class="salirAdmin">
            <form method="GET" action="<?php echo $rutaFinal ?>contenido/controlador/controladorLogueo.php">
                <input type="text" name="accion" style="display:none" value="cerrarSesion">                                     
                <button type="submit">Cerrar Sesión</button>
            </form>
        </div>
    </div>
</div>