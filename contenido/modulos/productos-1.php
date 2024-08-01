<div id="productos-1">
	<?php
	$consulta = consultaBanner1($con, $idioma);
	while ($banners = mysqli_fetch_array($consulta)) {
	?>
	<div class="producto-1" style="background-color: rgba(<?php echo $banners['url']; ?>,.25)">
		<div class="producto-1-imagen" style="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $banners['imagen']; ?>');"></div>
		<div class="producto-1-info">
			<div class="producto-1-info-titulo">
				<h3><?php echo $banners['texto_boton']; ?></h3>
			</div>
			<div class="producto-1-contenido">
				<div class="siguienteGaleria right" onclick="galeryClick(1,<?php echo $banners['identificador']; ?>);"></div>
                <div class="anteriorGaleria left" onclick="galeryClick(-1,<?php echo $banners['identificador']; ?>);"></div>
				<?php
				$pieces = explode("|||", $banners['titulo']);
				$piecest = explode("|||", $banners['texto']);
				$contador1 = 0;
				for ($i=0; $i < count($pieces); $i++) { 
				?>
				<div class="producto-1-conte slide-<?php echo $banners['identificador']; ?>" style="background-color: rgba(<?php echo $banners['url']; ?>,1); <?php if($contador1 == 0){ echo "left: 0%;"; } ?>">
					<h4><?php echo $pieces[$i] ?></h4>
					<p><?php echo $piecest[$i] ?></p>
				</div>
				<?php $contador1++;} ?>
			</div>
		</div>
	</div>
	<?php }	?>
</div>