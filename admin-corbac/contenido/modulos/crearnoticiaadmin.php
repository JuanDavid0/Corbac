<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>NUEVA NOTICIA</h2>
        <form id="contenedor-form-Admin" method="post" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxNoticia.php"
            enctype="multipart/form-data">
            <label class="label-form-act-admin">Titulo de la noticia:</label>
            <input id="inputNoticiaTitulo" onkeyup="crearUrl(this.value);" name="nombre" class="input-form-act-admin"
                type="text" placeholder="Titulo Noticia" required />

            <input id="inputNoticiaUrl" style="display: none;" name="url_amigable" class="input-form-act-admin"
                type="text" placeholder="Url_amigable" required />

            <label class="label-form-act-admin">Imagen Presentacion </label>
            <label class="label-form-act-admin">Formato Vertical - Escala de imagen recomendada 9:16 </label>
            <input id="inputNoticiaImagen" name="imagen-presentacion" class="input-form-act-admin inputImagen" type="file"
                accept=".jpg, .webp, .png" required onchange="mostrarImagen(this, 'previsua')" />
            <img id="previsua" src=""
                style="display: block; width: 180px; height: 320px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />

            <label class="label-form-act-admin">Presentacion</label>
            <textarea id="inputNoticiaPresentacion" name="presentacion" class="input-form-act-admin" type="text"
                placeholder="Presentacion corta de la noticia (max 25 palabras)" maxlength="300" required></textarea>



            <label class="label-form-act-admin">Descripcion</label>
            <textarea id="inputNoticiaDescripcion" name="descripcion" class="input-form-act-admin" type="text"
                placeholder="Descripcion global de la noticia" required></textarea>

            <label class="label-form-act-admin">Encabezado(1)</label>
            <input id="inputNoticiaTitulo1" name="titulo1" class="input-form-act-admin" type="text"
                placeholder="Ingrese un encabezado que corresponda al contenido 1" maxlength="200" required />

            <label class="label-form-act-admin">Contenido1</label>
            <label> Ingresa el primero bloque de texto de la noticia </label>
            <textarea id="inputNoticiaContenido1" style="display:none;" name="contenido1"></textarea>
            <div id="editor1" style="height: 200px;"></div>

            <label class="label-form-act-admin">Imagen(1)</label>
            <label class="label-form-act-admin">Formato Horizontal - Escala de imagen recomendada 16:9 </label>
            <input id="inputNoticiaImagen" name="imagen-contenido1" class="input-form-act-admin inputImagen" type="file"
                accept=".jpg, .webp, .png" required onchange="mostrarImagen(this, 'previsua1')" />
            <img id="previsua1" src=""
                style="display: block; width: 320px; height: 180px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />

            <button type="button" id="addSecondBlockBtn" onclick="toggleSecondBlock()">Añadir segundo bloque</button>
            <div id="secondBlock" style="display: none;">
                <label class="label-form-act-admin">Encabezado(2)</label>
                <input id="inputNoticiaTitulo2" value="" name="titulo2" class="input-form-act-admin" type="text" placeholder="Ingrese un encabezado que corresponda al contenido 2" />
                <label class="label-form-act-admin">Contenido(2)</label>
                <textarea id="inputNoticiaContenido2" style="display:none;" name="contenido2"></textarea>
                <div id="editor2" style="height: 200px;"></div>

                <label class="label-form-act-admin">Imagen(2)</label>
                <label class="label-form-act-admin">Formato Horizontal - Escala de imagen recomendada 16:9 </label>
                <input id="inputNoticiaImagen2" name="imagen-contenido2" class="input-form-act-admin inputImagen" type="file" accept=".jpg, .webp, .png" onchange="mostrarImagen(this, 'previsua2')" />
                <img id="previsua2" src="" style="display: block; width: 320px; height: 180px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />
            </div>

            <button type="button" id="addSecondBlockBtn" onclick="toggleVideoBlock()">Añadir video</button>
            <div id="videoBlock" style="display: none;">
                <label class="label-form-act-admin">Url - Youtube</label>
                <input id="inputNoticiaVideo" name="video" class="input-form-act-admin" type="text"
                    placeholder="Ej: https://www.youtube.com/watch?v=V1bFr2SWP1I&list=RDV1bFr2SWP1I"/>

                <label class="label-form-act-admin">Titulo del Video</label>
                <input id="inputTituloVideo" name="tvideo" class="input-form-act-admin" type="text"
                    placeholder="Titulo de Video" maxlength="300" />

                <label class="label-form-act-admin">Descripcion del Video</label>
                <textarea id="inputContenidoVideo" name="cvideo" class="input-form-act-admin" type="text"
                    placeholder="Texto informacion sobre video"></textarea>
            </div>
            <input name="accion" value="crear" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Crear Noticia</button>
        </form>
    </div>
</div>
<script>
    function toggleSecondBlock() {
        var block = document.getElementById("secondBlock");
        var addSecondBlockBtn = document.getElementById("addSecondBlockBtn");
        block.style.display = block.style.display === "block" ? "none" : "block";
        addSecondBlockBtn.style.display = addSecondBlockBtn.style.display === "none" ? "block" : "none";
    }

    function toggleVideoBlock() {
        var block = document.getElementById("videoBlock");
        block.style.display = block.style.display === "none" ? "block" : "none";
    }
    function initializeQuillEditor(editorId, textAreaId) {
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }],
            [{
                'color': []
            }]
        ];

        var quill = new Quill(editorId, {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });

        var container = document.querySelector(textAreaId);

        quill.on('text-change', function() {
            container.value = quill.root.innerHTML;
        });

        // Actualizar el textarea con el contenido inicial de Quill
        container.value = quill.root.innerHTML;
    }

    initializeQuillEditor('#editor1', '#inputNoticiaContenido1');
    initializeQuillEditor('#editor2', '#inputNoticiaContenido2');

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