<?php
$idModulo = consultaModulo("convenios-1");
$consulta_historia_modulo = consultaInfoModulo($idModulo, $con, $idioma);
$varindice = 0;
unset($varcontenido);
while ($rescontenido = mysqli_fetch_array($consulta_historia_modulo)) {
    $varcontenido[$varindice] = $rescontenido['contenido'];
    $varindice++;
}
?>
<div id="convenios-1">
    <h3 id="convenios-1-titulo">
        <?php echo $varcontenido[0]; ?>
    </h3>
    <div id="convenios-1-contenedor">
            <div class="convenios-1-serv">
                <h4 class="convenios-1-serv-titulo">
                    <?php echo $varcontenido[1]; ?>
                </h4>
                <?php
                $consultaConv = consultaConvenios();
                while ($ressubcat = mysqli_fetch_array($consultaConv)) {
                    ?>
                    <div class="card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <div class="card-image-container">
                                    <img src="<?php echo $rutaFinal; ?>contenido/assets/<?php echo $ressubcat['imagen']; ?>"
                                        alt="Imagen">
                                </div>
                                <p class="card-title">
                                    <?php echo $ressubcat['nombre']; ?>
                                </p>
                            </div>
                            <div class="flip-card-back">
                                <h1 class="card-title-back">
                                    <?php echo $ressubcat['nombre']; ?>
                                </h1>
                                <div class="card-info-back">
                                    <h3 class="card-subtitle"><?php echo $varcontenido[2]; ?></h3>
                                    <p class="card-text-back">
                                        <?php echo $ressubcat['vigencia']; ?>
                                    </p>
                                    <h3 class="card-subtitle"><?php echo $varcontenido[3]; ?></h3>
                                    <p class="card-text-back">
                                        <?php echo $ressubcat['contacto']; ?>
                                    </p>
                                    <h3 class="card-subtitle"><?php echo $varcontenido[4]; ?></h3>
                                    <p class="card-text-back">
                                        <?php echo $ressubcat['email']; ?>
                                    </p>
                                    <a href="<?php echo $ressubcat['url']; ?>" target="_blank">
                                        <button>
                                            <p>Visitar web</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </div>
</div>