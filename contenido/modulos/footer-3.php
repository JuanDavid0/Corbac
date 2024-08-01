<?php
$idModulo = consultaModulo("footer-3");
$consulta_historia_modulo = consultaInfoModuloGolbal($idModulo, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<footer>
    <div id="footer-contenedor">
        <div id="footer-capa"></div>
        <div id="footer-logo">
            <a href="/">
                <?php
                $consultageneral = consultaGeneral('logof', $idioma);
                while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                    ?>
                    <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resgeneral['variable']; ?>"
                        alt="<?php echo $resgeneral['descripcion']; ?>">
                <?php } ?>
            </a>
        </div>
        <div id="footer-redes">
            <?php
            $consultageneral = consultaGeneral('redes', $idioma);
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <a href="<?php echo $resgeneral['variable']; ?>" target="_blank"
                    class="footer-red <?php echo $resgeneral['clase']; ?> footer-<?php echo $resgeneral['clase']; ?>"></a>
            <?php } ?>
        </div>
        <div id="footer-info">
            <?php
            $consultageneral = consultaGeneral('telefono-footer', $idioma);
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <p><?php echo $varcontenido[2]; ?> <a
                        href="tel:<?php echo $resgeneral['variable']; ?>"><?php echo $resgeneral['variable']; ?></a></p>
            <?php } ?>
            <?php
            $consultageneral = consultaGeneral('email-footer', $idioma);
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <p><?php echo $varcontenido[3]; ?> <a
                        href="mailto:<?php echo $resgeneral['variable']; ?>"><?php echo $resgeneral['variable']; ?></a></p>
            <?php } ?>
            <?php
            $consultageneral = consultaGeneral('direccion1-footer', $idioma);
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <p><?php echo $varcontenido[4]; ?>     <?php echo $resgeneral['variable']; ?></p>
            <?php } ?>
            <?php
            $consultageneral = consultaGeneral('direccion2-footer', $idioma);
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <p><?php echo $resgeneral['variable']; ?></p>
            <?php } ?>
            <?php
            $consultageneral = consultaGeneral('ciudad-footer', $idioma);
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <p><?php echo $resgeneral['variable']; ?></p>
            <?php } ?>
        </div>
    </div>
    <div id="footer-marca">
        <div id="footer-copy">
            <p>Copyright © <?php $hoy = getdate();
            print $hoy['year']; ?> <?php echo $varcontenido[0]; ?></p>
        </div>
        <div id="footer-desarrollo"><a href="http://www.anbu.com.co"> <img
                    src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varcontenido[1]; ?>"
                    alt="Desarrollado por Anbu Business Group"></a></div>
    </div>






</footer>