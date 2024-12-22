<?php
require_once './contenido/clases/galeriaNosotros.php';
$nosotrosInicio = new galeriaNosotros();
$nosotrosInicio->identificador = $msg;

$nosotrosF = galeriaNosotros::buscaNosotrosInicio('galeria', $nosotrosInicio);
?>
<link
    href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css"
    rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR "NOSOTROS"</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxNosotrosInicio.php" enctype="multipart/form-data">
            <label class="label-form-act-admin">Imagen de fondo:</label>
            <img id="previsua" src="<?php echo $rutaFinalAssets . '/contenido/assets/' . $nosotrosF['imagen']; ?>" style="display: block; height: 200px; background-position: center; background-size: contain; background-repeat: no-repeat; margin: 5px auto;" />
            <input id="inputNoticiaImagen" name="imagen" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />
            <label style="font-size: smaller; text-align: center;">Formato Vertical - Escala de imagen recomendada 9:16</label>

            <div>
                <label class="label-form-act-admin">Texto:</label>
                <textarea id="inputNosotrosNoticia" name="texto" style="display:none;"><?php echo htmlspecialchars_decode($nosotrosF['texto']); ?></textarea>
                <div id="editor1"><?php echo htmlspecialchars_decode($nosotrosF['texto']); ?></div>
            </div>

            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $nosotrosF['identificador']; ?>" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Editar</button>
        </form>
    </div>
</div>

<script>
    // Inicializa Quill y sincroniza con el textarea oculto
    function initializeQuillEditor(editorSelector, textAreaSelector) {
        // Opciones de la barra de herramientas
        const toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'], // Opciones básicas
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }], // Listas
            [{
                'color': []
            }] // Colores
        ];

        // Crear instancia de Quill
        const quill = new Quill(editorSelector, {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });

        // Sincronizar contenido inicial
        const textArea = document.querySelector(textAreaSelector);
        quill.root.innerHTML = textArea.value;

        // Actualizar el textarea cada vez que cambie el contenido
        quill.on('text-change', function() {
            textArea.value = quill.root.innerHTML;
        });
    }

    // Inicializar Quill para el editor de texto
    initializeQuillEditor('#editor1', '#inputNosotrosNoticia');

    // Mostrar imagen seleccionada en el input
    function mostrarImagen(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const filePreview = document.getElementById('previsua');
                filePreview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Asignar evento al input de imagen
    document.getElementById('inputNoticiaImagen').addEventListener('change', function(e) {
        mostrarImagen(e.target);
    });
</script>