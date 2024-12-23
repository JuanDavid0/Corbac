<?php
require_once './contenido/clases/oferta.php';
$oferta = new oferta();
$oferta->identificador = $msg;

$ofertaF = Oferta::buscarOferta('oferta_academica', $oferta);
?>

<link
    href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css"
    rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR OFERTA ACADEMICA</h2>
        <form id="contenedor-form-Admin" method="post" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxOferta.php" enctype="multipart/form-data">
            <label class="label-form-act-admin">Imagen de presentación:</label>

            <img id="previsua" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $ofertaF['imagen_p']; ?>" style="display: block; width: 100%; height: 200px; background-position: center; background-size: contain; background-repeat: no-repeat; margin: 5px auto;" />

            <input id="inputBannerImagen" name="imagen_p" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />
            <label style="font-size: smaller; text-align: center;">Formato Horizontal - Escala de imagen recomendada 16:9</label>

            <input id="inputOfertaUrl" name="url_amigable" value="<?php echo $ofertaF['url_amigable']; ?>" class="input-form-act-admin" type="text" placeholder="Url_amigable" style="display: none;" />

            <label class="label-form-act-admin">Título:</label>
            <input name="nombre" onkeyup="crearUrl(this.value);" class="input-form-act-admin" type="text" required value="<?php echo $ofertaF['nombre']; ?>">

            <label class="label-form-act-admin">Texto:</label>
            <input name="descripcion" class="input-form-act-admin" type="text" required value="<?php echo $ofertaF['descripcion']; ?>">

            <label class="label-form-act-admin">Titulo que otorga la oferta:</label>
            <input name="contenido1" class="input-form-act-admin" type="text" required value="<?php echo $ofertaF['contenido1']; ?>">

            <label class="label-form-act-admin">Duración formación:</label>
            <textarea id="contenido_duracion" style="display: none;" name="contenido_duracion"></textarea>
            <div id="editor-1" style="height: 200px;">
                <?php echo htmlspecialchars_decode($ofertaF['contenido_duracion']); ?>
            </div>

            <label class="label-form-act-admin">Modalidad:</label>
            <input name="contenido_modalidad" class="input-form-act-admin" type="text" required value="<?php echo $ofertaF['contenido_modalidad']; ?>">

            <label class="label-form-act-admin">Resolución del ministerio:</label>
            <input name="contenido_aprobado" class="input-form-act-admin" type="text" required value="<?php echo $ofertaF['contenido_aprobado']; ?>">

            <label class="label-form-act-admin">Imagen de la institución:</label>
            <input id="inputImagen1" name="imagen1" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />

            <img id="previsua1" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $ofertaF['imagen1']; ?>" style="display: block; width: 100%; height: 200px; background-position: center; background-size: contain; background-repeat: no-repeat; margin: 5px auto;" />

            <label class="label-form-act-admin">Perfil profesional:</label>
            <input name="contenido2" class="input-form-act-admin" type="text" required value="<?php echo $ofertaF['contenido2']; ?>">

            <label class="label-form-act-admin">Imagen perfil profesional:</label>
            <input id="inputImagen2" name="imagen2" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />

            <img id="previsua2" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $ofertaF['imagen2']; ?>" style="display: block; width: 100%; height: 200px; background-position: center; background-size: contain; background-repeat: no-repeat; margin: 5px auto;" />

            <label class="label-form-act-admin">Plan de estudios:</label>
            <input name="contenido3" class="input-form-act-admin" type="text" required value="<?php echo $ofertaF['contenido3']; ?>">

            <label class="label-form-act-admin">Enlace al plan de estudios:</label>

            <input name="plan_enlace" id="inputURL" class="input-form-act-admin" type="url" pattern="https?://.+"
                title="Ingrese una URL válida que comience con http:// o https://"
                value="<?php echo $ofertaF['plan_enlace']; ?>"
                onchange="toggleField('inputPDF', this)" />

            <input name="archivo_pdf" id="inputPDF" class="input-form-act-admin" type="file" accept=".pdf"
                onchange="toggleField('inputURL', this)" />

            <label class="label-form-act-admin">Costos:</label>
            <textarea id="contenido4" style="height: 200px; display: none;" name="contenido4" class="input-form-act-admin" type="text"></textarea>
            <div id="editor-2" name="editor-2" style="height: 200px;"><?php print $ofertaF['contenido4']; ?></div>

            <label class="label-form-act-admin">Requisitos de admisión:</label>
            <textarea id="contenido5" style="height: 200px; display: none;" name="contenido5" class="input-form-act-admin" type="text"></textarea>
            <div id="editor-3" name="editor-3" style="height: 200px;"><?php print $ofertaF['contenido5']; ?></div>

            <label class="label-form-act-admin">Oferta padre:</label>
            <select name="oferta_padre" class="input-form-act-admin" required>
                <?php
                $ofertaPadre = Oferta::cargarOfertaPadre();
                foreach ($ofertaPadre as $campo) {
                    echo '<option value="' . $campo['url_amigable'] . '"' . ($campo['identificador'] === $ofertaF['oferta_padre'] ? ' selected' : '') . '>' . $campo['nombre'] . '</option>';
                }
                ?>
            </select>

            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="activo" <?php if ($ofertaF['estado'] === 'activo') echo 'selected'; ?>>Activo</option>
                <option value="inactivo" <?php if ($ofertaF['estado'] === 'inactivo') echo 'selected'; ?>>Inactivo</option>
            </select>

            <input name="accion" value="editarE" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $ofertaF['identificador']; ?>" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Editar</button>
        </form>
    </div>
</div>

<script>
    function mostrarImagen(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var filePreview = document.getElementById(previewId);
                filePreview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('inputBannerImagen').onchange = function(e) {
        mostrarImagen(e.target, 'previsua');
    };
    document.getElementById('inputImagen1').onchange = function(e) {
        mostrarImagen(e.target, 'previsua1');
    };
    document.getElementById('inputImagen2').onchange = function(e) {
        mostrarImagen(e.target, 'previsua2');
    };
</script>

<script>
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

    initializeQuillEditor('#editor-1', '#contenido_duracion');
    initializeQuillEditor('#editor-2', '#contenido4');
    initializeQuillEditor('#editor-3', '#contenido5');


    function crearUrl(cadena) {
        document.getElementById('inputOfertaUrl').value = normalizar(cadena);
        console.log(normalizar(cadena));
    }
    var normalizar = (function() {
        var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç",
            to = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
            mapa = {};
        for (var i = 0, j = from.length; i < j; i++)
            mapa[from.charAt(i)] = to.charAt(i);
        return function(str) {
            var cadenaFinal = [];
            for (var i = 0, j = str.length; i < j; i++) {
                var c = str.charAt(i);
                if (mapa.hasOwnProperty(str.charAt(i))) {
                    cadenaFinal.push(mapa[c]);
                } else {
                    cadenaFinal.push(c);
                }
            }
            return cadenaFinal.join('').replace(/[^-A-Za-z0-9]+/g, '-').toLowerCase();
        };
    })();

    function toggleField(otherFieldId, currentField) {
        var otherField = document.getElementById(otherFieldId);
        if (currentField.value) {
            otherField.disabled = true;
        } else {
            otherField.disabled = false;
        }
    }
</script>