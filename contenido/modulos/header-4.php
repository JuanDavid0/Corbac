<header id="header" class="header-info-sc-a">
    <div id="header-info" class="header-info-sc-a">
        <div id="header-info-email">
            <?php
            $consultageneral = consultaGeneral('email-header');
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <p>Email: </p><a href="mailto:<?php echo $resgeneral['variable']; ?>"><?php echo $resgeneral['variable']; ?></a>
            <?php } ?>
        </div>
        <div id="header-info-tel">
            <?php
            $consultageneral = consultaGeneral('telefono-header');
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <p>Teléfono: </p><a href="tel:<?php echo $resgeneral['variable']; ?>"><?php echo $resgeneral['variable']; ?></a>
            <?php } ?>
        </div>
        <div id="header-info-redes">
            <?php
            $consultageneral = consultaGeneral('redes');
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <div class="header-red">
                    <a href="<?php echo $resgeneral['variable']; ?>" target="_blank" rel="noopener noreferrer" class="<?php echo $resgeneral['clase']; ?>"></a>
                </div>
            <?php } ?>
        </div>
    </div>
    <div id="header-contenedor" class="header-contenedor">
        <div id="logo" style="opacity: 1;">
            <div id="menu-mobile" onclick="mostrar_menu('mobile');">
                <span class="menui"></span>
            </div>
            <a href="<?php echo $rutaFinal ?>inicio">
                <?php
                $consultageneral = consultaGeneral('logo');
                while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                    ?>
                    <img src="<?php echo $rutaFinal ?>contenido/assets/<?php echo $resgeneral['variable']; ?>" alt="<?php echo $resgeneral['descripcion']; ?>">
                <?php } ?>
            </a>
        </div>
        <nav id="nav" class="nav-scroll">
            <?php
            $consultamenu = consultaMenu();
            while ($resmenu = mysqli_fetch_array($consultamenu)) {
                if ($resmenu['archivo'] != '') {                    
                    if ($comHeader == $resmenu['identificador']) {
                        ?>
                        <a class="navActivo" href="<?php echo $rutaFinal ?><?php echo $resmenu['identificador']; ?>"><?php echo $resmenu['nombre']; ?></a>
                        <?php } else{ ?>
                        <a  href="<?php echo $rutaFinal ?><?php echo $resmenu['identificador']; ?>"><?php echo $resmenu['nombre']; ?></a>
                    <?php }
                } else {
                    ?>
                    <span><?php echo $resmenu['nombre']; ?>
                    <?php
                    $consultamenu2 = consultaExistenciaHijos($resmenu['identificador']);
                    if($consultamenu2 != 0){
                    ?>
                    <div class="submenu">
                        <?php
                        $consultasubmenu = consultaServicios(0);
                        while ($ressubmenu = mysqli_fetch_array($consultasubmenu)){
                        ?>
                        <a href="<?php echo  $rutaFinal.$ressubmenu['url_amigable']; ?>" class="submenu-op"><?php echo $ressubmenu['titulo']; ?></a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    </span>
                <?php  } ?>
<?php } ?>
        </nav>
    </div>
    <div id="menumob-mobile">
        <div id="menumob-fondo-mobile" onclick="ocultar_menu('mobile');"></div>
        <div id="menumob-opciones-mobile">
            <div id="menumob-presentacion-mobile">
                <a href="<?php echo $rutaFinal ?>inicio">
                    <?php
                    $consultageneral = consultaGeneral('logo');
                    while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                        ?>
                        <img src="<?php echo $rutaFinal ?>contenido/assets/<?php echo $resgeneral['variable']; ?>" alt="<?php echo $resgeneral['descripcion']; ?>">
                <?php } ?>
                </a>
                <?php
                $consultageneral = consultaGeneral('telefono-header');
                while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                    ?>
                <a href="tel:<?php echo $resgeneral['variable']; ?>" class="telefono"></a>
                <?php } ?>
                <?php
                $consultageneral = consultaGeneral('email-header');
                while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                    ?>
                <a href="mailto:<?php echo $resgeneral['variable']; ?>" class="email"></a>
<?php } ?>    
            </div>
            <div id="menumob-contenedor-mobile">
                <?php
                $consultamenu = consultaMenu();
                while ($resmenu = mysqli_fetch_array($consultamenu)) {
                    if ($resmenu['archivo'] != '') {
                        ?>
                        <div class="menumob-conte-opcion-mobile">
                            <a href="<?php echo $rutaFinal ?><?php echo $resmenu['identificador']; ?>"><?php echo $resmenu['nombre']; ?></a>
                        </div>
    <?php } else { ?>
                        <div class="menumob-conte-opcion-mobile">
                            <span><?php echo $resmenu['nombre']; ?>
                            <?php
                            $consultamenu2 = consultaExistenciaHijos($resmenu['identificador']);
                            if($consultamenu2 != 0){
                            ?>
                            <div class="submenumob">
                                <?php
                                $consultasubmenu = consultaServicios(0);
                                while ($ressubmenu = mysqli_fetch_array($consultasubmenu)){
                                ?>
                                <a href="<?php echo  $rutaFinal.$ressubmenu['url_amigable']; ?>" class="submenu-op"><?php echo $ressubmenu['titulo']; ?></a>
                                <?php } ?>
                            </div>
                            <?php } ?>
                            </span>
                        </div>
                    <?php } ?>
<?php } ?>
            </div>
            <div id="menumob-cerrar-mobile" onclick="ocultar_menu('mobile');" >
                 <span class="close2"></span>
            </div>
        </div>
    </div>
</header>
<div id="header-borde"></div>