<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>REGISTRAR FOTO EN GALERIA</h2>           
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxGaleria.php" enctype="multipart/form-data">                  
            <label class="label-form-act-admin">Proyecto:</label>
            <input class="input-form-act-admin" name="pagina" value="<?php echo $msg; ?>"  readonly required>            
            <label class="label-form-act-admin">Imagen:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 800px X 400px</label>
            <input id="inputNoticiaImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg" required/>          
            <img id="previsua" src="" style="display: block; width: 70%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>
            <label class="label-form-act-admin">Video:</label>
            <textarea class="input-form-act-admin" name="video" ></textarea>            
            <label class="label-form-act-admin">Titulo:</label>
            <input name="titulo" class="input-form-act-admin" type="text" placeholder="Reproducor / Ver"> 
            <label class="label-form-act-admin">Texto:</label>
            <input name="texto" class="input-form-act-admin" type="text" placeholder="0">             
            <input name="accion" value="crear" type="hidden" readonly required>                        
            <input name="retorno" value="galeriaadmin/<?php echo $msg ?>" type="hidden" readonly required>            
            <button class="inputSubmitForm" type="submit" >Crear</button>   
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

    var fileUpload = document.getElementById('inputNoticiaImagen');
    fileUpload.onchange = function (e) {
        mostrarImagen(e.srcElement);
    };
</script>