<?php
require_once './contenido/clases/oferta.php';
$oferta = new oferta();
$oferta->identificador = $msg;

$ofertaF = Oferta::buscarOferta('oferta_academica', $oferta);
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR OFERTA</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxOfertaA.php"
            enctype="multipart/form-data">
            <label class="label-form-act-admin">Imagen de fondo:</label>


            <img id="previsua" src="<?php echo $rutaFinalAssets . 'contenido/assets/' . $ofertaF['imagen_p']; ?>"
                style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;" />
            <input id="inputBannerImagen" name="imagen_p" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" />
            <label style="font-size: smaller; text-align: center;">Formato Horizontal - Escala de imagen recomendada 16:9</label>

            <label class="label-form-act-admin">Nombre:</label>
            <input name="nombre" onkeyup="crearUrl(this.value);" class="input-form-act-admin" type="text" required
                value="<?php echo $ofertaF['nombre']; ?>">

            <input id="inputOfertaUrl" name="url_amigable" value="<?php echo $ofertaF['url_amigable']; ?>" class="input-form-act-admin" type="text" placeholder="Url_amigable" style="display: none;" />


            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="activo" <?php if ($ofertaF['estado'] === 'activo') {
                                            echo 'selected=""';
                                        } ?>>Activo
                </option>
                <option value="inactivo" <?php if ($ofertaF['estado'] === 'inactivo') {
                                                echo 'selected=""';
                                            } ?>>Inactivo
                </option>
            </select>
            <input name="accion" value="editarA" type="hidden" readonly required>
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

    function crearUrl(cadena) {
        document.getElementById('inputOfertaUrl').value = normalizar(cadena);
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
</script>