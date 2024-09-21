<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>CREAR NUEVO BANNER</h2>           
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxBanner.php" enctype="multipart/form-data">                  
            <label class="label-form-act-admin">Imagen de fondo:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 800px</label>
            <input id="inputNoticiaImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg" required/>          
            <img id="previsua" src="" style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>
            <label class="label-form-act-admin">Titulo:</label>
            <input name="titulo" class="input-form-act-admin" type="text" required placeholder="informacion"> 
            <label class="label-form-act-admin">Texto:</label>
            <input name="texto" class="input-form-act-admin" type="text" required placeholder="informacion">
            <label class="label-form-act-admin">Texto Boton:</label>
            <input name="texto_boton" class="input-form-act-admin" type="text" placeholder="informacion">
            <label class="label-form-act-admin">Url boton:</label>
            <input name="url_boton" class="input-form-act-admin" type="text" placeholder="informacion">
            <label style="display: none" class="label-form-act-admin">Ubicacion Texto</label>
            <select style="display: none" name="disposicion" class="input-form-act-admin" required>
                <option value="0" >Izquierda</option>
                <option value="1" selected="">Centro</option>
                <option value="2">Derecha</option>               
            </select>       
            <label style="display: none" class="label-form-act-admin">Imagen Pequeña:</label>
            <label style="display: none" class="label-form-act-admin">Tamaño recomendado: 350px X 350px</label>
            <input style="display: none" id="inputImagenP" name="imagen_p" class="input-form-act-admin" type="file" accept=".jpg, .png"/>          
            <img style="display: none" id="previsuaP" src="" style="display: block; width: 50%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>
            <label style="display: none" class="label-form-act-admin">Ubicacion Imagen Pequeña</label>
            <select style="display: none" name="$disposicion_imagen_p" class="input-form-act-admin">
                <option value="0" selected="">Izquierda</option>
                <option value="1">Centro</option>
                <option value="2">Derecha</option>               
            </select>                 
            <label class="label-form-act-admin">Fecha inicio:</label>
            <input name="fecha_inicio" class="input-form-act-admin" type="date" required>
            <label class="label-form-act-admin">Fecha final:</label>
            <input name="fecha_final" class="input-form-act-admin" type="date">
            <label class="label-form-act-admin">Idioma</label>
            <select name="idioma" class="input-form-act-admin" required>
                <option value="es" selected="">Español</option>
                <option value="en">Ingles</option>                          
            </select> 
            <input name="accion" value="crear" type="hidden" readonly required>
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