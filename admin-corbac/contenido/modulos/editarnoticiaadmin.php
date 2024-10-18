<?php
require_once './contenido/clases/noticia.php';
$noticia = new Noticia();
$noticia->identificador = $msg;
$noticiaF = Noticia::buscarNoticia('noticia', $noticia);
?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>NOTICIA</h2>
        <form id="contenedor-form-Admin" method="post" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxNoticia.php" enctype="multipart/form-data">

            <label class="label-form-act-admin">Titulo Noticia</label>
            <input id="inputNoticiaTitulo" onkeyup="crearUrl(this.value);" value="<?php echo $noticiaF['nombre']; ?>" name="nombre" class="input-form-act-admin" type="text" placeholder="Titulo Noticia" required />

            <label class="label-form-act-admin">Imagen Presentacion </label>
            <label class="label-form-act-admin">Tamaño Recomendado: 600px * 600px</label>
            <input id="inputNoticiaImagen" name="imagen-presentacion" class="input-form-act-admin inputImagen" type="file" accept=".jpg, .webp" onchange="mostrarImagen(this, 'previsua')" />
            <img id="previsua" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $noticiaF['imagen_p']; ?>" style="display: block; width: 60%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />

            <label class="label-form act-admin">Url Amigable</label>
            <input id="inputNoticiaUrl" name="url_amigable" value="<?php echo $noticiaF['url_amigable']; ?>" class="input-form-act-admin" type="text" placeholder="Url_amigable" required />

            <label class="label-form-act-admin">Presentacion</label>
            <textarea id="inputNoticiaPresentacion" name="presentacion" class="input-form-act-admin" type="text" placeholder="Presentacion corta de la noticia" maxlength="250" required><?php echo $noticiaF['presentacion']; ?></textarea>

            <label class="label-form-act-admin">Descripcion</label>
            <textarea id="inputNoticiaDescripcion" name="descripcion" class="input-form-act-admin" type="text" placeholder="Descripcion global de la noticia" maxlength="300" required><?php echo $noticiaF['descripcion']; ?></textarea>

            <label class="label-form-act-admin">Primer Titulo</label>
            <input id="inputNoticiaTitulo" value="<?php echo $noticiaF['titulo1']; ?>" name="titulo1" class="input-form-act-admin" type="text" placeholder="Primer Titulo" required />

            <label class="label-form-act-admin">Primer Contenido</label>
            <div id="editor" name="contenido1" style="height: 200px;"><?php print $noticiaF['contenido1']; ?> </div>

            <label class="label-form-act-admin">Imagen del primer contenido </label>
            <label class="label-form-act-admin">Tamaño Recomendado: 750px * 750px</label>
            <input id="inputNoticiaImagen1" name="imagen-contenido1" class="input-form-act-admin inputImagen" type="file" accept=".jpg, .webp" onchange="mostrarImagen(this, 'previsua1')" />

            <img id="previsua1" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $noticiaF['imagen1']; ?>" style="display: block; width: 70%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />

            <?php if ($noticiaF['contenido2'] != '') { ?>
                <div id="secondBlock" style="display: block;">
                    <label class="label-form-act-admin">Segundo Titulo</label>
                    <input id="inputNoticiaTitulo2" value="<?php echo $noticiaF['titulo2']; ?>" name="titulo2" class="input-form-act-admin" type="text" placeholder="Segundo Titulo" />

                    <label class="label-form-act-admin">Segundo Contenido</label>
                    <textarea id="inputNoticiaContenido2" name="contenido2" class="input-form-act-admin" type="text" placeholder="Presentacion corta de la noticia" maxlength="250" required><?php echo $noticiaF['contenido2']; ?></textarea>

                    <label class="label-form-act-admin">Imagen del segundo contenido </label>
                    <label class="label-form-act-admin">Tamaño Recomendado: 750px * 750px</label>
                    <input id="inputNoticiaImagen2" name="imagen-contenido2" class="input-form-act-admin inputImagen" type="file" accept=".jpg, .webp" onchange="mostrarImagen(this, 'previsua2')" />
                    <img id="previsua2" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $noticiaF['imagen2']; ?>" style="display: block; width: 70%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />
                </div>
            <?php } else { ?>
                <button type="button" id="addSecondBlockBtn" onclick="toggleSecondBlock()">Añadir segundo bloque</button>
                <div id="newsecondBlock" style="display: none;">
                    <label class="label-form-act-admin">Segundo Titulo</label>
                    <input id="inputNoticiaTitulo2" value="<?php echo $noticiaF['titulo2']; ?>" name="titulo2" class="input-form-act-admin" type="text" placeholder="Segundo Titulo" />

                    <label class="label-form-act-admin">Segundo Contenido</label>
                    <div id="editor2" name="editor2" style="height: 200px;"><?php print $noticiaF['contenido2']; ?> </div>
                    <textarea id="inputNoticiaContenido2" name="contenido2" class="input-form-act-admin" type="text" placeholder="Presentacion corta de la noticia" maxlength="250" required><?php echo $noticiaF['contenido2']; ?></textarea>

                    <label class="label-form-act-admin">Imagen del segundo contenido </label>
                    <label class="label-form-act-admin">Tamaño Recomendado: 750px * 750px</label>
                    <input id="inputNoticiaImagen2" name="imagen-contenido2" class="input-form-act-admin inputImagen" type="file" accept=".jpg, .webp" onchange="mostrarImagen(this, 'previsua2')"/>
                    <img id="previsua2" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $noticiaF['imagen2']; ?>" style="display: block; width: 70%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;" />
                </div>
            <?php } ?>
            
            <?php if ($noticiaF['video'] != '') { ?>
            <div id="videoBlock" style="display: block;">
                <label class="label-form-act-admin">Url Youtube</label>
                <textarea id="inputNoticiaVideo" name="video" class="input-form-act-admin" type="text" placeholder="Url del video"><?php echo $noticiaF['video']; ?></textarea>

                <label class="label-form-act-admin">Titulo Video</label>
                <input id="inputTituloVideo" name="tvideo" class="input-form-act-admin" type="text" value="<?php echo $noticiaF['tvideo']; ?>" placeholder="Titulo de Video" maxlength="200" />

                <label class="label-form-act-admin">Contenido Video</label>
                <textarea id="inputContenidoVideo" name="cvideo" class="input-form-act-admin" type="text" placeholder="Texto informacion sobre video"><?php echo $noticiaF['cvideo']; ?></textarea>
            </div>
            <?php } else { ?>
                <button type="button" id="addVideoBlockBtn" onclick="toggleVideoBlock()">Añadir video</button>

                <div id="newvideoBlock" style="display: none;">
                <label class="label-form-act-admin">Url Youtube</label>
                <textarea id="inputNoticiaVideo" name="video" class="input-form-act-admin" type="text" placeholder="<iframe </iframe>"><?php echo $noticiaF['video']; ?></textarea>

                <label class="label-form-act-admin">Titulo Video</label>
                <input id="inputTituloVideo" name="tvideo" class="input-form-act-admin" type="text" value="<?php echo $noticiaF['tvideo']; ?>" placeholder="Titulo de Video" maxlength="200" />

                <label class="label-form-act-admin">Contenido Video</label>
                <textarea id="inputContenidoVideo" name="cvideo" class="input-form-act-admin" type="text" placeholder="Texto informacion sobre video"><?php echo $noticiaF['cvideo']; ?></textarea>
                </div>
                <?php } ?>

            <label class="label-form-act-admin">Fecha</label>
            <input id="fecha" name="fecha" class="input-form-act-admin" type="date" value="<?php echo $noticiaF['fecha']; ?>" required />
            <label class="label-form-act-admin">Idioma</label>
            <select name="idioma" class="input-form-act-admin">
                <option value="es" <?php if ($noticiaF['idioma'] === 'es') {
                                        echo 'selected';
                                    } ?>>Español</option>
                <option value="en" <?php if ($noticiaF['idioma'] === 'en') {
                                        echo 'selected';
                                    } ?>>Inglés</option>
            </select>
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
        block.style.display = block.style.display === "none" ? "block" : "none";
    }

    function toggleVideoBlock() {
        var block = document.getElementById("newvideoBlock");
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

    var quill2 = new Quill('#editor2', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
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