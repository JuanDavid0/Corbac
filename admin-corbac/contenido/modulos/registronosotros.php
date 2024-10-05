<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">        
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>REGISTRAR CONTENIDO NOSOTROS</h2>           
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxNosotros.php" enctype="multipart/form-data">                  
            <label class="label-form-act-admin">Imagen:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 800px X 400px</label>
            <input id="inputNoticiaImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg" required/>          
            <img id="previsua" src="" style="display: block; width: 70%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>
            <label class="label-form-act-admin">Nombre:</label>
            <input name="nombre" class="input-form-act-admin" type="text" value="<?php echo $galeriaF['nombre']; ?>">                       
            <label class="label-form-act-admin">Contenido</label>
            <textarea id="inputProyectoContenido" style="height: 200px; display:none;"  name="texto" class="input-form-act-admin" type="text" ></textarea>    
            <div id="editor" name="editor" style="height: 200px;"><?php print $galeriaF['texto']; ?> </div>
            <label class="label-form-act-admin">Modulo</label>
            <select name="modulo" class="input-form-act-admin" required>
                <option value="112">LA FELICIDAD HACE PARTE DE NUESTRO ADN</option>
                <option value="176">NUESTROS VALORES</option>               
            </select>              
            <input name="accion" value="crear" type="hidden" readonly required>            
            <input name="pagina" value="nosotros" type="hidden" readonly required>
            <input name="retorno" value="nosotrosadmin" type="hidden" readonly required>            
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
    var container = document.getElementById('inputProyectoContenido');
    var editor = document.getElementsByClassName('ql-editor');
    update();
    function update(delta) {
        var contents = quill.getText();
        var html = editor[0].innerHTML;
        container.value = html;
    }
</script>