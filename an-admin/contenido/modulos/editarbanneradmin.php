<?php
require_once './contenido/clases/banner.php';
$testimonio = new Banner();
$testimonio->identificador = $msg;
$bannerF = Banner::buscarBanner('banner',$testimonio);
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR BANNER</h2>           
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxBanner.php" enctype="multipart/form-data">                  
            <label class="label-form-act-admin">Imagen de fondo:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 600px</label>
            <input id="inputNoticiaImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg"/>          
            <img id="previsua" src="<?php echo $rutaFinal.'contenido/assets/'.$bannerF['imagen']; ?>" style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>
            <label class="label-form-act-admin">Titulo:</label>
            <input name="titulo" class="input-form-act-admin" type="text" required value="<?php echo $bannerF['titulo']; ?>"> 
            <label class="label-form-act-admin">Texto:</label>
            <input name="texto" class="input-form-act-admin" type="text" required value="<?php echo $bannerF['texto']; ?>">
            <label class="label-form-act-admin">Texto Boton:</label>
            <input name="texto_boton" class="input-form-act-admin" type="text" value="<?php echo $bannerF['texto_boton']; ?>">
            <label class="label-form-act-admin">Url boton:</label>
            <input name="url_boton" class="input-form-act-admin" type="text" value="<?php echo $bannerF['url']; ?>">
            <label style="display: none" class="label-form-act-admin">Ubicacion Texto</label>
            <select style="display: none" name="disposicion" class="input-form-act-admin" required>
                <option value="0" <?php if($bannerF['disposicion'] == 0 ){ } echo 'selected=""' ?> >Izquierda</option>
                <option value="1" <?php if($bannerF['disposicion'] == 1 ){ } echo 'selected=""' ?>>Centro</option>
                <option value="2" <?php if($bannerF['disposicion'] == 2 ){ } echo 'selected=""' ?>>Derecha</option>               
            </select>       
            <label style="display: none" class="label-form-act-admin">Imagen Pequeña:</label>
            <label style="display: none" class="label-form-act-admin">Tamaño recomendado: 350px X 350px</label>
            <input id="inputImagenP" style="display: none" name="imagen_p" class="input-form-act-admin" type="file" accept=".jpg, .png"/>          
            <img id="previsuaP" src="<?php echo $rutaFinal.'contenido/assets/'.$bannerF['imagen_p']; ?>" style="display: block; width: 50%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>
            <label style="display: none" class="label-form-act-admin">Ubicacion Imagen Pequeña</label>
            <select style="display: none" name="$disposicion_imagen_p" class="input-form-act-admin">
                <option value="0" <?php if($bannerF['$disposicion_imagen_p'] == 0 ){ } echo 'selected=""' ?>>Izquierda</option>
                <option value="1" <?php if($bannerF['$disposicion_imagen_p'] == 0 ){ } echo 'selected=""' ?>>Centro</option>
                <option value="2" <?php if($bannerF['$disposicion_imagen_p'] == 0 ){ } echo 'selected=""' ?>>Derecha</option>               
            </select>    
            <label class="label-form-act-admin">Fecha inicio:</label>
            <input name="fecha_inicio" class="input-form-act-admin" type="date" value="<?php echo $bannerF['fecha_inicio']; ?>"> 
            <label class="label-form-act-admin">Fecha final:</label>
            <input name="fecha_final" class="input-form-act-admin" type="date" value="<?php echo $bannerF['fecha_final']; ?>">
             <label class="label-form-act-admin">Idioma</label>
            <select name="idioma" class="input-form-act-admin">
                <option value="es" <?php if($bannerF['idioma'] === 'es' ){  echo 'selected=""' ;}?>>Español</option>
                <option value="en" <?php if($bannerF['idioma'] === 'en' ){  echo 'selected=""'; } ?>>Ingles</option>               
            </select> 
            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="activo" <?php if($bannerF['estado'] === 'activo' ){  echo 'selected=""' ;}?>>Activo</option>
                <option value="inactivo" <?php if($bannerF['estado'] === 'inactivo' ){  echo 'selected=""'; } ?>>Inactivo</option>               
            </select>  
            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $bannerF['identificador']; ?>" type="hidden" readonly required>
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