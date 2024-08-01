<div id="testimonio-3">
    <?php
    $consultaTest = consultaTestimonio();
    $restestimonio = mysqli_fetch_array($consultaTest);
    ?>
    <div id="testimonio-3-capa">
        <div id="testimonio-3-img">
            <img src="<?php echo $rutaFinal?>contenido/assets/<?php if ($restestimonio['foto'] != '') {
        echo $restestimonio['foto'];
    } else {
        echo 'oceta.jpg';
    } ?>" alt="<?php echo $restestimonio['alt']; ?>">
        </div>
        <h3><?php echo $restestimonio['nombre']; ?></h3>
        <p class="coma comc"><?php echo $restestimonio['testimonio']; ?></p>
    </div>	
</div>