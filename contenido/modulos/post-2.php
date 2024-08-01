<div id="post-2">
	<div id="post-2-cont">
		<div id="post-2-info">
			<div id="post-2-info-contenido">
				<h2 id="post-2-titulo"><?php echo $varEspecifico['nombre']; ?></h2>
				<p><?php echo $varEspecifico['contenido']; ?></p>
			</div>
			<?php
				$consultagaleria = consultaGaleriaPIdioma($varEspecifico['url_amigable'],$idioma);
			?>
			<div id="post-2-info-galeria">
				<?php while ($postg = mysqli_fetch_array($consultagaleria)) {
            ?> 
			<div class="slide-post-2-galeria">
			<div class="siguienteSlide right" onclick="galeryClick(1,<?php echo $postg['identificador']; ?>);"></div>
            <div class="anteriorSlide left" onclick="galeryClick(-1,<?php echo $postg['identificador']; ?>);"></div>

			<?php                    
            $imagenes = explode(",", $postg['imagen']);
            $contador1 = 0;
            foreach ($imagenes as $imagen) {
                ?>
			<div class="slideImg slideImg-<?php echo $postg['identificador']; ?>"style ="background-image: url('<?php echo $rutaFinal; ?>contenido/assets/<?php echo $imagen ?>'); <?php if($contador1 == 0){ echo "left: 0%;"; } ?>  "></div>
			
			<?php  $contador1 ++;} ?>  
			</div>
        	<?php } ?>
			</div>
		</div>
		<?php
    	if (($varEspecifico['video'] != '') || ($varEspecifico['video'] != null)) {
        ?>
		<div id="post-2-video">
			<div id="post-2-video-video">
				<?php echo $varEspecifico['video']; ?>
			</div>
			<div id="post-2-video-texto">
				<p><?php echo $varEspecifico['cvideo']; ?></p>
			</div>
		</div>
		<?php } ?>
	</div>
</div>