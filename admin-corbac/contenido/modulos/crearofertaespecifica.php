<?php
require_once './contenido/clases/oferta.php';
?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>CREAR NUEVA OFERTA</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxOferta.php" enctype="multipart/form-data">
            <label class="label-form-act-admin">Imagen de presentación:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 600px</label>
            <input id="inputBannerImagen" name="imagen_p" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" required onchange="mostrarImagen(this)" />
            <img id="previsua" src="" style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;" />

            <label class="label-form-act-admin">Url amigable:</label>
            <input name="url_amigable" class="input-form-act-admin" type="text" required placeholder="información">

            <label class="label-form-act-admin">Título:</label>
            <input name="nombre" class="input-form-act-admin" type="text" required placeholder="información">

            <label class="label-form-act-admin">Texto:</label>
            <input name="descripcion" class="input-form-act-admin" type="text" required placeholder="información">

            <label class="label-form-act-admin">Titulo que otorga la oferta:</label>
            <input name="contenido1" class="input-form-act-admin" type="text" required placeholder="información">

            <label class="label-form-act-admin">Duración formación:</label>
            <textarea id="contenido_duracion" style="height: 200px; display: none;" name="contenido_duracion" class="input-form-act-admin" type="text" placeholder="Contenido duración"></textarea>
            <div id="editor-1" name="editor-1" style="height: 200px;"></div>

            <label class="label-form-act-admin">Modalidad:</label>
            <input name="contenido_modalidad" class="input-form-act-admin" type="text" required placeholder="información">

            <label class="label-form-act-admin">Resolución del ministerio:</label>
            <input name="contenido_aprobado" class="input-form-act-admin" type="text" required placeholder="información">

            <label class="label-form-act-admin">Imagen de la institución:</label>
            <input id="inputImagen1" name="imagen1" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />

            <img id="previsua1" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $ofertaF['imagen1']; ?>" style="display: block; width: 100%; height: 200px; background-position: center; background-size: contain; background-repeat: no-repeat; margin: 5px auto;" />

            <label class="label-form-act-admin">Perfil profesional:</label>
            <input name="contenido2" class="input-form-act-admin" type="text" required placeholder="información">

            <label class="label-form-act-admin">Imagen perfil profesional:</label>
            <input id="inputImagen2" name="imagen2" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" required onchange="mostrarImagen(this)" />
            <img id="previsua2" src="" style="display: block; width: 100%; height: 200px; background-position: center; background-size: contain; background-repeat: no-repeat; margin: 5px auto;" />

            <label class="label-form-act-admin">Plan de estudios:</label>
            <input name="contenido3" class="input-form-act-admin" type="text" required placeholder="información">

            <label class="label-form-act-admin">Enlace al plan de estudios:</label>
            <input name="plan_enlace" class="input-form-act-admin" type="text" required placeholder="información">

            <label class="label-form-act-admin">Costos:</label>
            <textarea id="contenido4" style="height: 200px; display: none;" name="contenido4" class="input-form-act-admin" type="text" placeholder="Contenido costos"></textarea>
            <div id="editor-2" name="editor-2" style="height: 200px;"></div>

            <label class="label-form-act-admin">Requisitos de admisión:</label>
            <textarea id="contenido5" style="height: 200px; display: none;" name="contenido5" class="input-form-act-admin" type="text" placeholder="Contenido requisitos"></textarea>
            <div id="editor-3" name="editor-3" style="height: 200px;"></div>

            <label class="label-form-act-admin">Oferta padre:</label>
            <select name="oferta_padre" class="input-form-act-admin" required>
                <?php
                $ofertaPadre = Oferta::cargarOfertaPadre();
                foreach ($ofertaPadre as $campo) {
                    echo '<option value="' . $campo['url_amigable'] . '"' . ($campo['identificador'] === $ofertaF['oferta_padre'] ? ' selected' : '') . '>' . $campo['nombre'] . '</option>';
                }
                ?>
            </select>

            <input name="accion" value="crearE" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Crear oferta</button>
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
    var toolbarOptions1 = [
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
        [{
            'color': []
        }, {
            'background': []
        }],
        [{
            'font': []
        }]
    ];
    var quill1 = new Quill('#editor-1', {
        modules: {
            toolbar: toolbarOptions1
        },
        theme: 'snow'
    });
    quill1.on('text-change', update1);
    var container1 = document.getElementById('contenido_duracion');
    update1();

    function update1(delta) {
        var html = quill1.root.innerHTML; // Acceder al contenido HTML directamente
        container1.value = html;
    }

    var toolbarOptions2 = [
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
        [{
            'color': []
        }, {
            'background': []
        }],
        [{
            'font': []
        }]
    ];
    var quill2 = new Quill('#editor-2', {
        modules: {
            toolbar: toolbarOptions2
        },
        theme: 'snow'
    });
    quill2.on('text-change', update2);
    var container2 = document.getElementById('contenido4');
    update2();

    function update2(delta) {
        var html = quill2.root.innerHTML; // Acceder al contenido HTML directamente
        container2.value = html;
    }

    var toolbarOptions3 = [
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
        [{
            'color': []
        }, {
            'background': []
        }],
        [{
            'font': []
        }]
    ];
    var quill3 = new Quill('#editor-3', {
        modules: {
            toolbar: toolbarOptions3
        },
        theme: 'snow'
    });
    quill3.on('text-change', update3);
    var container3 = document.getElementById('contenido5');
    update3();

    function update3(delta) {
        var html = quill3.root.innerHTML; // Acceder al contenido HTML directamente
        container3.value = html;
    }
</script>