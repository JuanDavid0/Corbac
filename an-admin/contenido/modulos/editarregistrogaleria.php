<?php
require_once './contenido/clases/galeria.php';
$galeria = new Galeria();
$separador = explode('---',$msg);
$galeria->identificador = $separador[0];
echo $galeria->identificador;
$galeriaF = Galeria::buscarGaleria('galeria_producto_servicio',$galeria);
?>
<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR GALERIA</h2>           
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxGaleria.php" enctype="multipart/form-data">                  
            <label class="label-form-act-admin">Imagen de fondo:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 250px X 250px</label>
            <input id="inputNoticiaImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg"/>          
            <img id="previsua" src="<?php echo $rutaFinal.'contenido/assets/'.$galeriaF['imagen']; ?>" style="display: block; width: 50%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>
            <label class="label-form-act-admin">Video:</label>
            <textarea class="input-form-act-admin" name="video"><?php echo $galeriaF['video']; ?></textarea>              
            <label class="label-form-act-admin">Titulo:</label>
            <input name="titulo" class="input-form-act-admin" placeholder="Reproducor / Ver" type="text" value="<?php echo $galeriaF['titulo']; ?>">                       
            <label class="label-form-act-admin">Texto:</label>
            <input name="texto" class="input-form-act-admin" type="text" value="<?php echo $galeriaF['texto']; ?>">             
            <label class="label-form-act-admin">Estado</label>              
            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $galeriaF['id']; ?>" type="hidden" readonly required>
            <input name="pagina" value="<?php echo $separador[1] ?>" type="hidden" readonly required> 
            <input name="retorno" value="galeriaadmin/<?php echo $separador[1] ?>" type="hidden" readonly required>        
            <button class="inputSubmitForm" type="submit" >Editar</button>   
        </form>
    </div>
</div>
<script>
    function mostrarImagen(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var filePreview = document.getElementById('previsua');
                filePreview.id = 'file-preview';
                filePreview.src = e.target.result;
                var previewZone = document.getElementById('file-preview-zone');
                previewZone.appendChild(filePreview);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function mostrarImagenP(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var filePreview = document.getElementById('previsuaP');
                filePreview.id = 'file-preview';
                filePreview.src = e.target.result;
                var previewZone = document.getElementById('file-preview-zone');
                previewZone.appendChild(filePreview);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    var fileUpload = document.getElementById('inputNoticiaImagen');
    fileUpload.onchange = function (e) {
        mostrarImagen(e.srcElement);
    };
    var fileUpload = document.getElementById('inputImagenP');
    fileUpload.onchange = function (e) {
        mostrarImagenP(e.srcElement);
    };
</script>