<?php
require_once './contenido/clases/servicio.php';
$servicio = new Servicio();
$servicio->identificador = $msg;
$servicioF = Servicio::buscarServicio('servicio',$servicio);
$categorias = Servicio::listarCategoriaServcio('pagina');
?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">        
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR Proyecto</h2>           
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxServicio.php" enctype="multipart/form-data">                  
            <label class="label-form-act-admin">Imagen de fondo:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 400px X 200px</label>
            <input id="inputNoticiaImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg"/>          
            <img id="previsua" src="<?php echo $rutaFinal.'contenido/assets/'.$servicioF['imagen']; ?>" style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>
            <label class="label-form-act-admin">Categoria</label> 
            <select name="categoria_pagina" class="input-form-act-admin" required>
                <?php
                foreach ($categorias as $indice => $campo) {    
                    $xhtml = '';
                    if($campo['identificador'] == $servicioF['categoria_pagina']){
                        $xhtml .= "<option value=\"".$campo['identificador']."\" selected>".$campo['nombre']."</option>";
                    }else{
                        $xhtml .= "<option value=\"".$campo['identificador']."\">".$campo['nombre']."</option>";
                    }                    
                    echo $xhtml;
                }
                 ?>                                           
            </select>
            <label class="label-form-act-admin">Titulo:</label>
            <input name="titulo" value="<?php echo $servicioF['titulo']; ?>" onchange="crearUrl(this.value)" class="input-form-act-admin" type="text" required placeholder="Nombre del servicio/producto"> 
            <label class="label-form-act-admin">Url Amigable:</label>
            <input id="url_amigable" value="<?php echo $servicioF['url_amigable']; ?>"  name="url_amigable" class="input-form-act-admin" type="text" required readonly>
            <label class="label-form-act-admin">Subtitulo:</label>
            <input  name="subtitulo" value="<?php echo $servicioF['subtitulo']; ?>" class="input-form-act-admin" type="text" required placeholder="Subtitulo del servicio/producto">
            <label class="label-form-act-admin">Ciudad:</label>
            <input  name="ciudad" value="<?php echo $servicioF['ciudad']; ?>" class="input-form-act-admin" type="text" required placeholder="Ubicacion servicio/producto">
            <label class="label-form-act-admin">Descripcion corta:</label>
            <textarea rows="4" cols="50" name="descripcion_corta" class="input-form-act-admin" type="text" maxlength="250"><?php echo $servicioF['descripcion_corta']; ?></textarea>                      
            <label class="label-form-act-admin">Texto Largo:</label>
            <textarea id="descripcionLarga" style="height: 300px; display:none;"  name="descripcion_larga" class="input-form-act-admin" type="text" ></textarea>    
            <div id = "editor" name="editor" style="height: 300px;"><?php echo $servicioF['descripcion_larga']; ?> </div>
            <label class="label-form-act-admin">Video:</label>
            <textarea rows="2" cols="50" name="video" class="input-form-act-admin" type="text"><?php echo $servicioF['video']; ?></textarea>                            
            <label class="label-form-act-admin">Texto Boton:</label>
            <input name="texto_boton"  value="<?php echo $servicioF['texto_boton']; ?>" class="input-form-act-admin" type="text" required placeholder="Ver más">                        
            <label class="label-form-act-admin">Enlace Boton:</label>
            <input id="enlace_boton" value="<?php echo $servicioF['enlace']; ?>" name="enlace" class="input-form-act-admin" type="text" required readonly>  
            <label class="label-form-act-admin">Nivel:</label>
            <input name="nivel" class="input-form-act-admin" value="0" type="numer" required readonly>   
            <label class="label-form-act-admin">Idioma</label>
            <select name="idioma" class="input-form-act-admin">
                <option value="es" <?php if($servicioF['idioma'] === 'es' ){  echo 'selected=""' ;}?>>Es</option>
                <option value="en" <?php if($servicioF['idioma'] === 'en' ){  echo 'selected=""'; } ?>>En</option>               
            </select> 
            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="activo" <?php if($servicioF['estado'] === 'activo' ){  echo 'selected=""' ;}?>>Activo</option>
                <option value="inactivo" <?php if($servicioF['estado'] === 'inactivo' ){  echo 'selected=""'; } ?>>Inactivo</option>               
            </select>  
            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $servicioF['identificador']; ?>" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit" >Editar</button>   
        </form>
    </div>
</div>
<script>
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{'header': [1, 2, 3, 4, 5, 6, false]}],
        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'align': []}],
        [{'script': 'sub'}, {'script': 'super'}],
        [{'ident': '-1'}, {'ident': '+1'}],
        [{'direction': 'rtl'}],
        ['link', 'image', 'video', 'formula'],
        [{'color': []}, {'background': []}],
        [{'font': []}]
    ];
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    quill.on('text-change', update);
    var container = document.getElementById('descripcionLarga');
    var editor = document.getElementsByClassName('ql-editor');
    update();
    function update(delta) {
        var contents = quill.getText();
        var html = editor[0].innerHTML;
        container.value = html;
    }
</script>
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
    <script>
    function crearUrl(cadena) {
        document.getElementById('url_amigable').value = normalizar(cadena);
        document.getElementById('enlace_boton').value = normalizar(cadena);
    }
    var normalizar = (function () {
        var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç",
                to = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
                mapa = {};
        for (var i = 0, j = from.length; i < j; i++)
            mapa[ from.charAt(i) ] = to.charAt(i);
        return function (str) {
            var cadenaFinal = [];
            for (var i = 0, j = str.length; i < j; i++) {
                var c = str.charAt(i);
                if (mapa.hasOwnProperty(str.charAt(i))) {
                    cadenaFinal.push(mapa[ c ]);
                } else {
                    cadenaFinal.push(c);
                }
            }
            return cadenaFinal.join('').replace(/[^-A-Za-z0-9]+/g, '-').toLowerCase();
        };
    })();
</script>
