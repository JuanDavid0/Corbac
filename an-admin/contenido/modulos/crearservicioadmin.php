<?php
require_once './contenido/clases/servicio.php';
$categorias = Servicio::listarCategoriaServcio('pagina');
?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">        
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>CREAR NUEVO PROYECTO</h2>           
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxServicio.php" enctype="multipart/form-data">                  
            <label class="label-form-act-admin">Imagen de fondo:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 400px X 200px</label>
            <input id="inputNoticiaImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg" required/>          
            <img id="previsua" src="" style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>
            <label class="label-form-act-admin">Categoria</label> 
            <select name="categoria_pagina" class="input-form-act-admin" required>
                <?php
                foreach ($categorias as $indice => $campo) {
                    $xhtml = '';
                    $xhtml .= "<option value=\"" . $campo['identificador'] . "\">" . $campo['nombre'] . "</option>";
                    echo $xhtml;
                }
                ?>                                           
            </select>
            <label class="label-form-act-admin">Titulo:</label>
            <input  name="titulo" onchange="crearUrl(this.value)" class="input-form-act-admin" type="text" required placeholder="Nombre del servicio/producto"> 
            <label class="label-form-act-admin">Url Amigable:</label>
            <input id="url_amigable"  name="url_amigable" class="input-form-act-admin" type="text" required readonly>
            <label class="label-form-act-admin">Subtitulo:</label>
            <input  name="subtitulo" class="input-form-act-admin" type="text" required placeholder="Subtitulo del servicio/producto">
            <label class="label-form-act-admin">Ciudad:</label>
            <input  name="ciudad" class="input-form-act-admin" type="text" required placeholder="Ubicacion servicio/producto">
            <label class="label-form-act-admin">Descripcion corta:</label>
            <textarea rows="4" cols="50" name="descripcion_corta" class="input-form-act-admin" type="text" maxlength="250"></textarea>                      
            <label class="label-form-act-admin">Texto Largo:</label>
            <textarea id="descripcionLarga" style="height: 300px; display:none;"  name="descripcion_larga" class="input-form-act-admin" type="text" ></textarea>    
            <div id = "editor" name="editor" style="height: 300px;"><?php echo $servicioF['descripcion_Larga']; ?> </div>
            <label class="label-form-act-admin">Video:</label>
            <textarea rows="2" cols="50" name="video" class="input-form-act-admin" type="text"></textarea>                            
            <label class="label-form-act-admin">Texto Boton:</label>
            <input name="texto_boton" class="input-form-act-admin" type="text" required placeholder="Ver más">                        
            <label class="label-form-act-admin">Enlace Boton:</label>
            <input id="enlace_boton" name="enlace" class="input-form-act-admin" type="text" required readonly>  
            <label class="label-form-act-admin">Nivel:</label>
            <input name="nivel" class="input-form-act-admin" value="0" type="numer" required readonly>             
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
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{'header': [1, 2, 3, 4, 5, 6, false]}],
        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'align': []}],
        [{'script': 'sub'}, {'script': 'super'}],
        ['link', 'image', 'video', 'formula'],
        [{'ident': '-1'}, {'ident': '+1'}],
        [{'direction': 'rtl'}],
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