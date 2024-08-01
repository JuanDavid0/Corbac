<?php
$idModulo = consultaModulo("footer-4");
$consulta_historia_modulo = consultaInfoModuloGolbal($idModulo);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<footer>
    <div id="footer-contenedor">
        <div id="footer-info">
            <p id="footer-info-titulo">
                <?php echo $varcontenido[0]; ?>
            </p>
            <?php
            $consultageneral = consultaGeneral('telefono-footer');
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <p><strong class="telefono">Teléfono: </strong><a href="tel:<?php echo $resgeneral['variable']; ?>"><?php echo $resgeneral['variable']; ?></a></p>
            <?php } ?>
            <?php
            $consultageneral = consultaGeneral('email-footer');
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <p><strong class="email">Email: </strong><a href="mailto:<?php echo $resgeneral['variable']; ?>"><?php echo $resgeneral['variable']; ?></a></p>
            <?php } ?>
            <?php
            $consultageneral = consultaGeneral('direccion1-footer');
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <p><strong class="<?php echo $resgeneral['clase']; ?>">Dirección: </strong><?php echo $resgeneral['variable']; ?></p>
            <?php } ?>
            <?php
            $consultageneral = consultaGeneral('direccion2-footer');
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <p><?php echo $resgeneral['variable']; ?></p>
            <?php } ?>
            <?php
            $consultageneral = consultaGeneral('ciudad-footer');
            while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                ?>
                <p><?php echo $resgeneral['variable']; ?></p>
            <?php } ?>
        </div>
        <div id="footer-logo">
            <a href="inicio">
                <?php
                $consultageneral = consultaGeneral('logo');
                while ($resgeneral = mysqli_fetch_array($consultageneral)) {
                    ?>
                    <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $resgeneral['variable']; ?>" alt="<?php echo $resgeneral['descripcion']; ?>">
                <?php } ?>
            </a>
        </div>
        <div id="footer-formulario">
            <p id="footer-formulario-titulo">
                <?php echo $varcontenido[1]; ?>
            </p>
            <form action="" method="">
                <input type="text" class="footer-formulario-input" placeholder="Nombre" required>
                <input type="number" class="footer-formulario-input" placeholder="Teléfono / Celular" required>
                <input type="email" class="footer-formulario-input" placeholder="Correo Electronico" required>
                <textarea name="" id="footer-formulario-area" placeholder="Mensaje" required></textarea>
                <input type="submit" id="footer-formulario-boton" value="Enviar">
            </form>
        </div>
    </div>
    <div id="footer-build"></div>
    <div id="footer-marca">
        <div id="footer-copy"><p>Copyright © <?php $hoy = getdate();
            print $hoy['year'];
            ?> <?php echo $varcontenido[2]; ?></p>
        </div>
        <div id="footer-desarrollo"><a href="http://www.anbu.com.co"> <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $varcontenido[3]; ?>" alt="Desarrollado por Anbu Business Group"></a></div>
    </div>
</footer>