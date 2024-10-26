<?php
$idModulo = consultaModulo("landing-1");
$fechaServidor = getdate();
$fecha = $fechaServidor['year'] . "-" . $fechaServidor['mon'] . "-" . $fechaServidor['mday'];
$consultarLanding = consultaInfoLanding($con, $idioma, $fecha);
$resLanding = mysqli_fetch_assoc($consultarLanding);

if ($resLanding) {
?>
<div id="landing-1">
    <div class="cont-landing">
        <div class="info-landing">
            <button class="close-button">Cerrar</button>
            <section class="landing">
                <div class="text1">
                    <h1>CORBAC</h1>
                </div>
                <div class="text2">
                    <div class="titulo-landing">
                        <h1><?php echo $resLanding['titulo']; ?></h1>
                    </div>
                    <div class="descripcion-landing">
                        <p><?php echo $resLanding['subTitulo']; ?></p>
                    </div>
                    <div class="texto-landing">
                        <p><?php echo $resLanding['contenido']; ?></p>
                    </div>
                </div>
                <div class="text3">
                    <a href="#">
                        <p><?php echo $resLanding['cta1']; ?></p>
                    </a>
                </div>
            </section>
            <div class="formulario">
                <h3 class="promesa"><?php echo $resLanding['promesa1']; ?></h3>
                <iframe src=""></iframe>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
