<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>NUEVA NOTICIA</h2>
        <form id="contenedor-form-Admin" method="post" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxNoticia.php"
            enctype="multipart/form-data">
            <label class="label-form-act-admin">Titulo Noticia</label>
            <input id="inputNoticiaTitulo" onkeyup="crearUrl(this.value);" name="nombre" class="input-form-act-admin"
                type="text" placeholder="Titulo Noticia" required />
            <input id="inputNoticiaUrl" style="display: none;" name="url_amigable" class="input-form-act-admin"
                type="text" placeholder="Url_amigable" required />

            <label class="label-form-act-admin">Presentacion</label>
            <textarea id="inputNoticiaPresentacion" name="presentacion" class="input-form-act-admin" type="text"
                placeholder="Presentacion corta de la noticia" maxlength="250" required></textarea>

            <label class="label-form-act-admin">Imagen Presentacion </label>
            <label class="label-form-act-admin">Tamaño Recomendado: 600px * 600px</label>
            <input id="inputNoticiaImagen" name="imagen-presentacion" class="input-form-act-admin inputImagen" type="file"
                accept=".jpg, .webp" required onchange="mostrarImagen(this, 'previsua')" />
            <img id="previsua" src=""
                style="display: block; width: 60%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />

            <label class="label-form-act-admin">Descripcion</label>
            <textarea id="inputNoticiaDescripcion" name="descripcion" class="input-form-act-admin" type="text"
                placeholder="Descripcion global de la noticia" maxlength="300" required></textarea>

            <label class="label-form-act-admin">Titulo 1</label>
            <input id="inputNoticiaTitulo1" name="titulo1" class="input-form-act-admin" type="text"
                placeholder="Titulo 1" maxlength="200" required />
            <label class="label-form-act-admin">Contenido1</label>
            <textarea id="inputProyectoContenido" style="height: 200px; display:none;" name="contenido1"
                class="input-form-act-admin" type="text" placeholder="Contenido de la noticia"></textarea>
            <div id="editor" name="editor" style="height: 200px;"> </div>

            <label class="label-form-act-admin">Imagen del primer contenido </label>
            <label class="label-form-act-admin">Tamaño Recomendado: 600px * 600px</label>
            <input id="inputNoticiaImagen" name="imagen-contenido1" class="input-form-act-admin inputImagen" type="file"
                accept=".jpg, .webp" required onchange="mostrarImagen(this, 'previsua1')" />
            <img id="previsua1" src=""
                style="display: block; width: 60%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />

            <button type="button" id="addSecondBlockBtn" onclick="toggleSecondBlock()">Añadir segundo bloque</button>
            <div id="secondBlock" style="display: none;">
                <label class="label-form-act-admin">Segundo Titulo</label>
                <input id="inputNoticiaTitulo2" value="" name="titulo2" class="input-form-act-admin" type="text" placeholder="Segundo Titulo" />
                <label class="label-form-act-admin">Segundo Contenido</label>
                <textarea id="inputNoticiaContenido2" name="contenido2" class="input-form-act-admin" type="text" placeholder="Segundo bloque del cuerpo de la noticia" maxlength="250" value=""></textarea>

                <label class="label-form-act-admin">Imagen del segundo contenido </label>
                <label class="label-form-act-admin">Tamaño Recomendado: 750px * 750px</label>
                <input id="inputNoticiaImagen2" name="imagen-contenido2" class="input-form-act-admin inputImagen" type="file" accept=".jpg, .webp" onchange="mostrarImagen(this, 'previsua2')" />
                <img id="previsua2" src="" style="display: block; width: 70%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />
            </div>

            <button type="button" id="addSecondBlockBtn" onclick="toggleVideoBlock()">Añadir video</button>
            <div id="videoBlock" style="display: none;">
                <label class="label-form-act-admin">Frame Youtube</label>
                <input id="inputNoticiaVideo" name="video" class="input-form-act-admin" type="text"
                    placeholder="<iframe  https://www.youtube.com/embed/zTmaY_zUCsI> </iframe>" />
                <label class="label-form-act-admin">Titulo Video</label>
                <input id="inputTituloVideo" name="tvideo" class="input-form-act-admin" type="text"
                    placeholder="Titulo de Video" maxlength="200" />
                <label class="label-form-act-admin">Contenido Video</label>
                <textarea id="inputContenidoVideo" name="cvideo" class="input-form-act-admin" type="text"
                    placeholder="Texto informacion sobre video"></textarea>
            </div>
            <label class="label-form-act-admin">Fecha</label>
            <input id="fecha" name="fecha" class="input-form-act-admin" type="date" required />
            <label class="label-form-act-admin">Idioma</label>
            <select name="idioma" class="input-form-act-admin" required>
                <option value="es" selected="">Español</option>
                <option value="en">Ingles</option>
            </select>
            <input name="accion" value="crear" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Crear Noticia</button>
        </form>
    </div>
</div>
<script>
    function toggleSecondBlock() {
        var block = document.getElementById("secondBlock");
        block.style.display = block.style.display === "none" ? "block" : "none";
    }

    function toggleVideoBlock() {
        var block = document.getElementById("videoBlock");
        block.style.display = block.style.display === "none" ? "block" : "none";
    }

    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],
        [{
            'align': []
        }],
        [{
            'script': 'sub'
        }, {
            'script': 'super'
        }],
        [{
            'ident': '-1'
        }, {
            'ident': '+1'
        }],
        [{
            'direction': 'rtl'
        }],
        ['link', 'image', 'video', 'formula'],
        [{
            'color': []
        }, {
            'background': []
        }],
        [{
            'font': []
        }]
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

<script>
    function mostrarImagen(input, imgId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(imgId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]); // convertir a base64
        }
    }
</script>