<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
    <h2>CREAR NUEVA OFERTA</h2>
    <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxOfertaA.php" enctype="multipart/form-data">                  
            <label class="label-form-act-admin">Imagen de fondo:</label>
            <label class="label-form-act-admin">Tamaño recomendado: 1600px X 800px</label>
            <input id="inputBannerImagen" name="imagen_p" class="input-form-act-admin" type="file" accept=".jpg, .webp, .png" required onchange="mostrarImagen(this)"/>       

            <img id="previsua" src="" style="display: block; width: 100%; height: 200px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:5px auto;"/>

            <label class="label-form-act-admin">Nombre:</label>
            <input name="nombre" onkeyup="crearUrl(this.value);" class="input-form-act-admin" type="text" required placeholder="información">

            <input id="inputOfertaUrl" name="url_amigable" class="input-form-act-admin" type="text" placeholder="Url_amigable" style="display: none;" />

            <input name="accion" value="crearA" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Crear</button>
        </form>
    </div>
</div>
<script>
    function mostrarImagen(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var filePreview = document.getElementById('previsua');
                filePreview.id = 'file-preview';
                filePreview.src = e.target.result;
                var previewZone = document.getElementById('file-preview-zone');
                previewZone.appendChild(filePreview);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    var fileUpload = document.getElementById('inputBannerImagen');
    fileUpload.onchange = function () {
        mostrarImagen(this);
    };

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
</script>

