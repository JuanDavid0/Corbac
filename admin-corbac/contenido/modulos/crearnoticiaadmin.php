<link
    href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css"
    rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
<div id="contenedor-AreaTrabjo-Admin">
    <div id="Partes-noticia">
        <h2>PARTES DE LA NOTICIA</h2>
        <div id="opciones-menu">
            <button class="btn-crear-noticia" id="btn1" onclick="toggleMainBlock()">Bloque principal</button>
            <button class="btn-crear-noticia" id="btn2" onclick="toggleSecondBlock()">Añadir segundo bloque</button>
            <button class="btn-crear-noticia" id="btn3" onclick="toggleVideoBlock()">Añadir video</button>
        </div>

    </div>

    <div id="AreaTrabjo-Admin-cont">
        <h2>NUEVA NOTICIA</h2>
        <form id="contenedor-form-Admin" method="post" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxNoticia.php"
            enctype="multipart/form-data">
            <div id="Bloque-principal" style="display:block">
                <div class="Titulos">
                    <label class="label-form-act-admin">Titulo de la noticia:</label>
                    <input id="inputNoticiaTitulo" onkeyup="crearUrl(this.value);" name="nombre" class="input-form-act-admin"
                        type="text" placeholder="Titulo Noticia" required />
                </div>

                <div id="bloque0">
                    <div class="bloque0-1">
                        <label class="label-form-act-admin">Imagen Presentacion </label>
                        <img id="previsua" src=""
                            style="display: block; width: 70%; height: 100%; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto; max-height:350px" />
                        <input id="inputNoticiaImagen" name="imagen-presentacion" class="input-form-act-admin inputImagen" type="file"
                            accept=".jpg, .webp, .png" required onchange="mostrarImagen(this, 'previsua')"/>
                        <label style="font-size: smaller; text-align: center; ">Formato Vertical - Escala de imagen recomendada 9:16 </label>
                    </div>
                    <input id="inputNoticiaUrl" style="display: none;" name="url_amigable" class="input-form-act-admin"
                        type="text" placeholder="Url_amigable" required />
                    <div class="bloque0-2">
                        <div class="bloque0-2-1">
                            <label class="label-form-act-admin">Presentacion</label>
                            <textarea id="inputNoticiaPresentacion" name="presentacion" class="input-form-act-admin" type="text"
                                placeholder="Presentacion corta de la noticia (max 25 palabras)" maxlength="300" required rows="7"></textarea>
                        </div>
                        <div class="bloque0-2-2">
                            <label class="label-form-act-admin">Descripcion</label>
                            <textarea id="inputNoticiaDescripcion" name="descripcion" class="input-form-act-admin" type="text"
                                placeholder="Descripcion global de la noticia" required rows="7"></textarea>
                        </div>
                    </div>
                </div>
                <div class="Titulos">
                    <label class="label-form-act-admin">Encabezado(1)</label>
                    <input id="inputNoticiaTitulo1" name="titulo1" class="input-form-act-admin" type="text"
                        placeholder="Ingrese un encabezado que corresponda al contenido 1" maxlength="200" required />
                </div>
                <div id="bloque1">
                    <div class="bloque1-1">
                        <label class="label-form-act-admin">Contenido1</label>
                        <label style="font-size:smaller"> Ingresa el primer bloque de texto de la noticia </label>
                        <textarea id="inputNoticiaContenido1" style="display:none;" name="contenido1"></textarea>
                        <div id="editor1" style="height: 200px;"></div>
                    </div>
                    <div class="bloque1-2">
                        <label class="label-form-act-admin">Imagen(1)</label>
                        <img id="previsua1" src=""
                            style="display: block; width: 100%; height: 180px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />
                        <input id="inputNoticiaImagen" name="imagen-contenido1" class="input-form-act-admin inputImagen" type="file"
                            accept=".jpg, .webp, .png" required onchange="mostrarImagen(this, 'previsua1')" />
                        <label style="font-size: smaller; text-align: center; ">Formato Horizontal - Escala de imagen recomendada 16:9 </label>
                    </div>
                </div>
            </div>

            <div id="secondBlock" style="display: none;">
                <div class="Titulos">
                    <label class="label-form-act-admin">Encabezado(2)</label>
                    <input id="inputNoticiaTitulo2" value="" name="titulo2" class="input-form-act-admin" type="text" placeholder="Ingrese un encabezado que corresponda al contenido 2" />
                </div>
                <div id="bloque1">
                    <div class="bloque1-1">
                        <label class="label-form-act-admin">Contenido(2)</label>
                        <textarea id="inputNoticiaContenido2" style="display:none;" name="contenido2"></textarea>
                        <div id="editor2" style="height: 200px;"></div>
                    </div>
                    <div class="bloque1-2">
                        <label class="label-form-act-admin">Imagen(2)</label>
                        <img id="previsua2" src="" style="display: block; width: 100%; height: 180px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />
                        <input id="inputNoticiaImagen2" name="imagen-contenido2" class="input-form-act-admin inputImagen" type="file" accept=".jpg, .webp, .png" onchange="mostrarImagen(this, 'previsua2')" />
                        <label style="font-size: smaller; text-align: center; ">Formato Horizontal - Escala de imagen recomendada 16:9 </label>
                    </div>
                </div>
            </div>
            <div id="videoBlock" style="display: none;">
                <div id="bloque2">
                    <label class="label-form-act-admin">Url - Youtube</label>
                    <input id="inputNoticiaVideo" name="video" class="input-form-act-admin" type="text"
                        placeholder="Ej: https://youtu.be/V1bFr2SWP1I" />
                    <label class="label-form-act-admin">Titulo del Video</label>
                    <input id="inputTituloVideo" name="tvideo" class="input-form-act-admin" type="text"
                        placeholder="Titulo de Video" maxlength="300" />
                    <label class="label-form-act-admin">Descripcion del Video</label>
                    <textarea id="inputContenidoVideo" style="display:none;" name="cvideo"></textarea>
                    <div id="editor3" style="height: 150px;"></div>
                </div>
            </div>
            <input name="accion" value="crear" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Crear Noticia</button>
        </form>
    </div>
</div>
<script>
    var block = document.getElementById("Bloque-principal");
    var secondBlock = document.getElementById("secondBlock");
    var videoBlock = document.getElementById("videoBlock");
    var btn1 = document.getElementById("btn1");
    var btn2 = document.getElementById("btn2");
    var btn3 = document.getElementById("btn3");

    function toggleMainBlock() {
        block.style.display = block.style.display = "block";
        secondBlock.style.display = "none";
        videoBlock.style.display = "none";
        btn1.style.backgroundColor = 'rgba(6, 38, 63, 1)';
        btn2.style.backgroundColor = 'rgba(6, 38, 63, 0.8)';
        btn3.style.backgroundColor = 'rgba(6, 38, 63, 0.8)';
    }

    function toggleSecondBlock() {
        secondBlock.style.display = secondBlock.style.display = "block";
        block.style.display = "none";
        videoBlock.style.display = "none";
        btn1.style.backgroundColor = 'rgba(6, 38, 63, 0.8)';
        btn2.style.backgroundColor = 'rgba(6, 38, 63, 1)';
        btn3.style.backgroundColor = 'rgba(6, 38, 63, 0.8)';
    }

    function toggleVideoBlock() {
        videoBlock.style.display = videoBlock.style.display = "flex";
        block.style.display = "none";
        secondBlock.style.display = "none";
        btn1.style.backgroundColor = 'rgba(6, 38, 63, 0.8)';
        btn2.style.backgroundColor = 'rgba(6, 38, 63, 0.8)';
        btn3.style.backgroundColor = 'rgba(6, 38, 63, 1)';
    }

    function initializeQuillEditor(editorId, textAreaId) {
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],
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
        container.value = quill.root.innerHTML;
        quill.root.innerHTML = container.value;

        quill.on('text-change', function() {
            container.value = quill.root.innerHTML;
        });
    }

    initializeQuillEditor('#editor1', '#inputNoticiaContenido1');
    initializeQuillEditor('#editor2', '#inputNoticiaContenido2');
    initializeQuillEditor('#editor3', '#inputContenidoVideo');

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