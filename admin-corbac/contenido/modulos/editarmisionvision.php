<?php
require_once './contenido/clases/misionvision.php';

$misionvision = new MisionVision();
$misionvision->identificador = $msg;

$misionvisionF = MisionVision::buscaMisionVision('contenido', $misionvision);
?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR MISION/VISION</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxMisionVision.php" enctype="multipart/form-data">
            <label class="label-form-act-admin">Contenido:</label>
            <textarea id="contenido" style="height: 200px; display: none;" name="contenido" class="input-form-act-admin" type="text"></textarea>
            <div id="editor" name="editor" style="height: 200px;"><?php print $misionvisionF['contenido']; ?></div>

            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $misionvisionF['identificador']; ?>" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Editar</button>
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
    var container = document.getElementById('contenido');
    update();

    function update(delta) {
        var html = quill.root.innerHTML;
        container.value = html;
    }
</script>