<header id="header">
    <div id="header-info">
        <div id="header-info-redes">
            <?php
            $consultageneral = consultaGeneralSinIdioma('redes');
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <div class="header-red">
                    <a href="<?php echo $resgeneral['variable']; ?>" target="_blank" rel="noopener noreferrer"
                        class="<?php echo $resgeneral['clase']; ?>"></a>
                </div>
            <?php } ?>
        </div>
    </div>
    <div id="header-contenedor" class="header-contenedor">
        <div id="logo" style="opacity: 1;">
            <!-- Menu Mobile -->
            <div id="menu-mobile" onclick="mostrar_menu('mobile');">
                <span class="menui"></span>
            </div>
            <a href="<?php echo $ruta ?>inicio">
                <?php
                $consultageneral = consultaGeneralSinIdioma('logo');
                while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                    ?>
                    <img src="<?php echo $rutaFinal ?>contenido/assets/<?php echo $resgeneral['variable']; ?>"
                        alt="<?php echo $resgeneral['descripcion']; ?>">
                <?php } ?>
            </a>
        </div>
        <nav id="nav">
            <?php
            $consultamenu = consultaMenu($idioma);
            while ($resmenu = mysqli_fetch_array($consultamenu)) {
                if ($resmenu['archivo'] != '') {
                    // el comHeader es la variable que se obtiene de la url
                    if ($comHeader == $idioma . "/" . $resmenu['identificador']) {
                        // este if es solo para poner un sombreado en el menu sobre la pagina que esta actualmente    
                        ?>
                        <a class="navActivo"
                            href="<?php echo $ruta ?><?php echo $resmenu['identificador']; ?>"><?php echo $resmenu['nombre']; ?></a>
                        <?php
                    } else { ?>
                        <a href="<?php echo $ruta ?><?php echo $resmenu['identificador']; ?>"><?php echo $resmenu['nombre']; ?></a>
                    <?php }
                } else {
                    ?>
                    <span>
                        <?php
                        echo $resmenu['nombre'];
                        $consultasubmenuex = consultaExistenciaHijos($resmenu['identificador'], $idioma);
                        if ($consultasubmenuex != 0) {
                            ?>
                            <div class="submenu">
                                <?php
                                $consultasubmenu = consultaMenuHijos($resmenu['identificador'], $idioma);
                                while ($ressubmenu = mysqli_fetch_array($consultasubmenu)) {
                                    ?>
                                    <a href="<?php echo $ruta ?><?php echo $ressubmenu['identificador']; ?>"
                                        class="submenu-op"><?php echo $ressubmenu['nombre']; ?></a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </span>
                <?php } ?>
            <?php } ?>
        </nav>
    </div>
    <div id="menumob-mobile">
        <div id="menumob-fondo-mobile" onclick="ocultar_menu('mobile');"></div>
        <div id="menumob-opciones-mobile">
            <div id="menumob-presentacion-mobile">
                <a href="<?php echo $ruta ?>inicio">
                    <?php
                    $consultageneral = consultaGeneralSinIdioma('logo');
                    while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                        ?>
                        <img src="<?php echo $rutaFinal ?>contenido/assets/<?php echo $resgeneral['variable']; ?>"
                            alt="<?php echo $resgeneral['descripcion']; ?>">
                    <?php } ?>
                </a>
                <?php
                $consultageneral = consultaGeneral('telefono-header', $idioma);
                while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                    ?>
                    <a href="tel:<?php echo $resgeneral['variable']; ?>" class="telefono"></a>
                <?php } ?>
                <?php
                $consultageneral = consultaGeneral('email-header', $idioma);
                while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                    ?>
                    <a href="mailto:<?php echo $resgeneral['variable']; ?>" class="email"></a>
                <?php } ?>
            </div>
            <div id="menumob-contenedor-mobile">
                <?php
                $consultamenu = consultaMenu($idioma);
                $contsubmm = 0;
                while ($resmenu = mysqli_fetch_array($consultamenu)) {
                    if ($resmenu['archivo'] != '') {
                        ?>
                        <div class="menumob-conte-opcion-mobile">
                            <a
                                href="<?php echo $ruta ?><?php echo $resmenu['identificador']; ?>"><?php echo $resmenu['nombre']; ?></a>
                        </div>
                    <?php } else { ?>
                        <div class="menumob-conte-opcion-mobile">
                            <p onclick="MostrarInfo(<?php echo $contsubmm; ?>);" class="arriba">
                                <?php
                                echo $resmenu['nombre'];
                                $consultasubmenuex = consultaExistenciaHijos($resmenu['identificador'], $idioma);
                                if ($consultasubmenuex != 0) {
                                    ?>
                                <div class="submenum">
                                    <?php
                                    $consultasubmenu = consultaMenuHijos($resmenu['identificador'], $idioma);
                                    while ($ressubmenu = mysqli_fetch_array($consultasubmenu)) {
                                        ?>
                                        <a href="<?php echo $ruta ?><?php echo $ressubmenu['identificador']; ?>"
                                            class="submenum-op"><?php echo $ressubmenu['nombre']; ?></a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            </p>
                        </div>
                        <?php $contsubmm++;
                    } ?>
                <?php } ?>
            </div>
            <div id="menumob-cerrar-mobile" onclick="ocultar_menu('mobile');">
                <span class="close2"></span>
            </div>
        </div>
    </div>
</header>
<div id="header-borde"></div>