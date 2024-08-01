<div id="testimonio-2">
    <?php
    $consultaTest = consultaTestimonio();
    $restestimonio = mysqli_fetch_array($consultaTest);
    ?>
    <div id="testimonio-2-capa">
        <div id="testimonio-2-img">
            <img src="<?php echo $rutaFinal?>contenido/assets/<?php if ($restestimonio['foto'] != '') {
        echo $restestimonio['foto'];
    } else {
        echo 'TAdefecto.jpg';
    } ?>" alt="<?php echo $restestimonio['alt']; ?>">
        </div>
        <p class="coma comc"><?php echo $restestimonio['testimonio']; ?></p>
        <h3><?php echo $restestimonio['nombre']; ?></h3>
    </div>	
</div>