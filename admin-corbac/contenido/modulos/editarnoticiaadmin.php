<?php
require_once './contenido/clases/noticia.php';
$noticia = new Noticia();
$noticia->identificador = $msg;
$noticiaF = Noticia::buscarNoticia('noticia', $noticia);
function limpiarHTML($html)
{
    $html = preg_replace('/<[^\/>]*>([\s]?)*<\/[^>]*>/', '', $html);
    return trim($html);
}
?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>NOTICIA</h2>
        <form id="contenedor-form-Admin" method="post" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxNoticia.php" enctype="multipart/form-data">

            <label class="label-form-act-admin">Titulo de la noticia:</label>
            <input id="inputNoticiaTitulo" onkeyup="crearUrl(this.value);" value="<?php echo $noticiaF['nombre']; ?>" name="nombre" class="input-form-act-admin" type="text" placeholder="Titulo Noticia" required />

            <label class="label-form-act-admin">Imagen de presentacion</label>
            <label class="label-form-act-admin">Formato Vertical - Escala de imagen recomendada 9:16 </label>
            <input id="inputNoticiaImagen" name="imagen-presentacion" class="input-form-act-admin inputImagen" type="file" accept=".jpg, .webp, .png" onchange="mostrarImagen(this, 'previsua')" />
            <img id="previsua" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $noticiaF['imagen_p']; ?>" style="display: block; width: 180px; height: 320px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />

            <input id="inputNoticiaUrl" name="url_amigable" value="<?php echo $noticiaF['url_amigable']; ?>" class="input-form-act-admin" type="text" placeholder="Url_amigable" style="display: none;" />

            <label class="label-form-act-admin">Presentacion</label>
            <textarea id="inputNoticiaPresentacion" name="presentacion" class="input-form-act-admin" type="text" placeholder="Presentacion corta de la noticia (max 25 palabras)" maxlength="300" required><?php echo $noticiaF['presentacion']; ?></textarea>

            <label class="label-form-act-admin">Descripcion</label>
            <textarea id="inputNoticiaDescripcion" name="descripcion" class="input-form-act-admin" type="text" placeholder="Descripcion global de la noticia" required><?php echo $noticiaF['descripcion']; ?></textarea>

            <label class="label-form-act-admin">Encabezado(1)</label>
            <input id="inputNoticiaTitulo" value="<?php echo $noticiaF['titulo1']; ?>" name="titulo1" class="input-form-act-admin" type="text" placeholder="Primer Titulo" required />

            <label class="label-form-act-admin">Contenido(1)</label>
            <textarea id="inputNoticiaContenido1" style="display:none;" name="contenido1"></textarea>
            <div id="editor1" style="height: 200px;"><?php print $noticiaF['contenido1']; ?></div>

            <label class="label-form-act-admin">Imagen(1)</label>
            <label class="label-form-act-admin">Formato Horizontal - Escala de imagen recomendada 16:9 </label>
            <input id="inputNoticiaImagen1" name="imagen-contenido1" class="input-form-act-admin inputImagen" type="file" accept=".jpg, .webp, .png" onchange="mostrarImagen(this, 'previsua1')" />
            <img id="previsua1" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $noticiaF['imagen1']; ?>" style="display: block; width: 320px; height: 180px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />

            <?php
            $contenido2 = limpiarHTML($noticiaF['contenido2']); 
            if ($contenido2 != '') {
            ?>
                <div id="secondBlock" style="display: block;">
                    <label class="label-form-act-admin">Encabezado(2)</label>
                    <input id="inputNoticiaTitulo2" value="<?php echo $noticiaF['titulo2']; ?>" name="titulo2" class="input-form-act-admin" type="text" placeholder="Segundo Titulo" />

                    <label class="label-form-act-admin">Contenido(2)</label>
                    <textarea id="inputNoticiaContenido2" style="display:none;" name="contenido2"></textarea>
                    <div id="editor2" style="height: 200px;"><?php print $noticiaF['contenido2']; ?></div>

                    <label class="label-form-act-admin">Imagen(2)</label>
                    <label class="label-form-act-admin">Formato Horizontal - Escala de imagen recomendada 16:9 </label>
                    <input id="inputNoticiaImagen2" name="imagen-contenido2" class="input-form-act-admin inputImagen" type="file" accept=".jpg, .webp, .png" onchange="mostrarImagen(this, 'previsua2')" />
                    <img id="previsua2" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $noticiaF['imagen2']; ?>" style="display: block; width: 320px; height: 180px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />
                    <button type="button" onclick="limpiarCampos()">Eliminar contenido</button>
                </div>
            <?php } else { ?>
                <button type="button" id="addSecondBlockBtn" style="display: block;" onclick="toggleSecondBlock()">Añadir segundo bloque</button>
                <div id="newsecondBlock" style="display: none;">
                <label class="label-form-act-admin">Encabezado(2)</label>
                    <input id="inputNoticiaTitulo2" value="<?php echo $noticiaF['titulo2']; ?>" name="titulo2" class="input-form-act-admin" type="text" placeholder="Segundo Titulo" />

                    <label class="label-form-act-admin">Contenido(2)</label>
                    <textarea id="inputNoticiaContenido2" style="display:none;" name="contenido2"></textarea>
                    <div id="editor2" style="height: 200px;"><?php print $noticiaF['contenido2']; ?></div>

                    <label class="label-form-act-admin">Imagen(2)</label>
                    <label class="label-form-act-admin">Formato Horizontal - Escala de imagen recomendada 16:9 </label>
                    <input id="inputNoticiaImagen2" name="imagen-contenido2" class="input-form-act-admin inputImagen" type="file" accept=".jpg, .webp, .png" onchange="mostrarImagen(this, 'previsua2')" />
                    <img id="previsua2" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $noticiaF['imagen2']; ?>" style="display: block; width: 70%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />
                    <button type="button" onclick="limpiarCampos()">Eliminar contenido</button>
                </div>
            <?php } ?>

            <?php if ($noticiaF['video'] != '') { ?>
                <div id="videoBlock" style="display: block;">
                    <label class="label-form-act-admin">Url - Youtube</label>
                    <input id="inputNoticiaVideo" name="video" class="input-form-act-admin" type="text" placeholder="Ej: https://www.youtube.com/watch?v=V1bFr2SWP1I&list=RDV1bFr2SWP1I" value="<?php echo $noticiaF['video'];?>" />

                    <label class="label-form-act-admin">Titulo del Video</label>
                    <input id="inputTituloVideo" name="tvideo" class="input-form-act-admin" type="text" value="<?php echo $noticiaF['tvideo']; ?>" placeholder="Titulo de Video" maxlength="300" />

                    <label class="label-form-act-admin">Descripcion del Video</label>
                    <textarea id="inputContenidoVideo" name="cvideo" class="input-form-act-admin" type="text" placeholder="Texto informacion sobre video"><?php echo $noticiaF['cvideo']; ?></textarea>
                </div>
            <?php } else { ?>
                <button type="button" id="addVideoBlockBtn" onclick="toggleVideoBlock()">Añadir video</button>
                <div id="newvideoBlock" style="display: none;">
                <label class="label-form-act-admin">Url - Youtube</label>
                    <textarea id="inputNoticiaVideo" name="video" class="input-form-act-admin" type="text" placeholder="Ej: https://www.youtube.com/watch?v=V1bFr2SWP1I&list=RDV1bFr2SWP1I"><?php echo $noticiaF['video'];?></textarea>

                    <label class="label-form-act-admin">Titulo del Video</label>
                    <input id="inputTituloVideo" name="tvideo" class="input-form-act-admin" type="text" value="<?php echo $noticiaF['tvideo']; ?>" placeholder="Titulo de Video" maxlength="300" />

                    <label class="label-form-act-admin">Descripcion del Video</label>
                    <textarea id="inputContenidoVideo" name="cvideo" class="input-form-act-admin" type="text" placeholder="Texto informacion sobre video"><?php echo $noticiaF['cvideo']; ?></textarea>
                </div>
            <?php } ?>

            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="activo" <?php if ($noticiaF['estado'] === 'activo') {
                                            echo 'selected';
                                        } ?>>Activo</option>
                <option value="inactivo" <?php if ($noticiaF['estado'] === 'inactivo') {
                                                echo 'selected';
                                            } ?>>Inactivo</option>
            </select>
            <input name="identificador" value="<?php echo $noticiaF['identificador']; ?>" type="hidden" readonly required>
            <input name="accion" value="editar" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Editar Noticia</button>
        </form>
    </div>
</div>
<script>
    function toggleSecondBlock() {
        var block = document.getElementById("newsecondBlock");
        var addSecondBlockBtn = document.getElementById("addSecondBlockBtn");
        block.style.display = block.style.display === "none" ? "block" : "none";
        addSecondBlockBtn.style.display = addSecondBlockBtn.style.display === "none" ? "block" : "none";
    }

    function toggleVideoBlock() {
        var block = document.getElementById("newvideoBlock");
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

    function limpiarCampos() {
        document.getElementById('inputNoticiaTitulo2').value = '';
        document.getElementById('inputNoticiaContenido2').value = '';
        document.getElementById('editor2').innerHTML = '';
        document.getElementById('previsua2').src = '';
        document.getElementById('inputNoticiaImagen2').value = null;
    }

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