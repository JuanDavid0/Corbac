<?php
require_once './contenido/clases/contenidoModulo.php';
$galeria = new ContenidoModulo();
$galeria->identificador = $msg;
$galeriaF = ContenidoModulo::buscarContenido('galeria',$galeria);
?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">        
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR CONTENIDO</h2>           
        <form id="contenedor-form-Admin" method="post" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxContenidoModulo.php" enctype="multipart/form-data">        
            <?php 
            $xhtml = '';
            if($galeriaF['nombre'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Titulo</label>';
               $xhtml .= '<input id="inputNoticiaTitulo" value="'.$galeriaF['nombre'].'" name="nombre" class="input-form-act-admin" type="text" placeholder="Titulo" required/>';
            }
            if($galeriaF['subtitulo'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Sub Titulo</label>';
               $xhtml .= '<input id="inputNoticiaTitulo" value="'.$galeriaF['subtitulo'].'" name="subtitulo" class="input-form-act-admin" type="text" placeholder="Subtitulo" required/>';
            }
            if($galeriaF['clase'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Clase</label>';
               $xhtml .= '<input id="inputNoticiaTitulo" value="'.$galeriaF['clase'].'" name="clase" class="input-form-act-admin" type="text" placeholder="Clase" required/>';
            }
            if($galeriaF['imagen'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Imagen </label>';
               $xhtml .= '<label class="label-form-act-admin">Tamaño Recomendado: 1200px * 1200px</label>';
               $xhtml .= '<input id="inputNoticiaImagen" name="imagen" class="input-form-act-admin inputImagen" type="file" accept=".jpg"/>';
               $xhtml .= '<img id="previsua" src="'.$rutaFinal.'contenido/assets/'.$galeriaF['imagen'].'" style="display: block; width: 60%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;"/>';               
            }
            if($galeriaF['url'] != ''){
               $xhtml .= '<label class="label-form-act-admin">URL</label>';
               $xhtml .= '<input id="inputNoticiaTitulo" value="'.$galeriaF['url'].'" name="url" class="input-form-act-admin" type="text" placeholder="Clase" required/>';
            }
            if($galeriaF['texto'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Texto</label>';
               $xhtml .= '<textarea id="texto" style="height: 200px; display:none;"  name="texto" class="input-form-act-admin" type="text" ></textarea>    ';
               $xhtml .= '<div id="editor" name="editor" style="height: 200px;">'.$galeriaF['texto'].'</div>';                                          
            }
            if($galeriaF['texto_s'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Texto Secundario</label>';
               $xhtml .= '<textarea id="texto_s" style="height: 200px; display:none;"  name="texto_s" class="input-form-act-admin" type="text" ></textarea>    ';
               $xhtml .= '<div id="editor-1" name="editor-1" style="height: 200px;">'.$galeriaF['texto_s'].'</div>';                               
            }
            if($galeriaF['texto_boton'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Texto Boton</label>';
               $xhtml .= '<input id="inputNoticiaTitulo" value="'.$galeriaF['texto_boton'].'" name="texto_boton" class="input-form-act-admin" type="text" placeholder="Ver Más" required/>';
            }
            if($galeriaF['ciudad'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Ciudad</label>';
               $xhtml .= '<input id="inputNoticiaTitulo" value="'.$galeriaF['ciudad'].'" name="ciudad" class="input-form-act-admin" type="text" placeholder="Tunja - Boyaca" required/>';
            }
            if($galeriaF['video'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Video</label>';
               $xhtml .= '<input id="inputNoticiaTitulo" value="'.$galeriaF['video'].'" name="video" class="input-form-act-admin" type="text" placeholder="Video frame de Youtube" required/>';
            }
            if($galeriaF['orden'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Orden</label>';
               $xhtml .= '<input id="inputNoticiaTitulo" value="'.$galeriaF['orden'].'" name="orden" class="input-form-act-admin" type="number" placeholder="0" required/>';
            }
            if($galeriaF['estado'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Estado</label>';
               $xhtml .= '<input id="inputNoticiaTitulo" value="'.$galeriaF['estado'].'" name="estado" class="input-form-act-admin" type="text" placeholder="activo" required readonly/>';
            }
            if($galeriaF['idioma'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Idioma</label>';
               $xhtml .= '<input id="inputNoticiaTitulo" value="'.$galeriaF['idioma'].'" name="idioma" class="input-form-act-admin" type="text" placeholder="es" required readonly/>';
            }
            if($galeriaF['fecha'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Fecha</label>';
               $xhtml .= '<input id="inputNoticiaTitulo" value="'.$galeriaF['fecha'].'" name="fecha" class="input-form-act-admin" type="date" placeholder="es" required />';
            }
            if($galeriaF['tipo'] != ''){
               $xhtml .= '<label class="label-form-act-admin">Tipo</label>';
               $xhtml .= '<input id="inputNoticiaTitulo" value="'.$galeriaF['tipo'].'" name="tipo" class="input-form-act-admin" type="text" placeholder="es" required readonly />';
            }                                                                                 
            echo $xhtml;                        
            ?>                                                                        
            <input name="retorno" value="modulospaginasadmin" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $galeriaF['identificador']; ?>" type="hidden" readonly required>
            <input name="identificador_pagina" value="<?php echo $galeriaF['identificador_pagina']; ?>" type="hidden" readonly required>
            <input name="modulo" value="<?php echo $galeriaF['modulo']; ?>" type="hidden" readonly required>
            <input name="accion" value="editar" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit" >Editar Contenido</button>
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
    var container = document.getElementById('texto');
    var editor = document.getElementsByClassName('ql-editor');
    update();
    function update(delta) {
        var contents = quill.getText();
        var html = editor[0].innerHTML;
        container.value = html;
    }        
    
    var toolbarOptions1 = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{'header': [1, 2, 3, 4, 5, 6, false]}],
        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'align': []}],
        [{'script': 'sub'}, {'script': 'super'}],
        [{'ident': '-1'}, {'ident': '+1'}],
        [{'direction': 'rtl'}],
        [{'color': []}, {'background': []}],
        [{'font': []}]
    ];
    var quill1 = new Quill('#editor-1', {
        modules: {
            toolbar: toolbarOptions1
        },
        theme: 'snow'
    });
    quill1.on('text-change', update);
    var container1 = document.getElementById('texto_s');
    var editor1 = document.getElementsByClassName('ql-editor1');
    update1();
    function update1(delta1) {
        var contents = quill1.getText();
        var html = quill1[0].innerHTML;
        container1.value = html;
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
    var fileUpload = document.getElementById('inputNoticiaImagen');
    fileUpload.onchange = function (e) {
        mostrarImagen(e.srcElement);
    };
</script>