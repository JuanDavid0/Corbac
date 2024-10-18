<div id="cont-general">
    <div id="cont-login">
        <div id="login" style="background-image: url(<?php echo $rutaFinal; ?>contenido/assets/background.jpg)">
            <div id="login-capa"></div>
        </div>
        <div id="contenedor-login">
            <img src="<?php echo $rutaFinal; ?>contenido/assets/logo.webp" alt="Logo">
            <!-- <img src="contenido/assets/logo.webp" alt="Logo"> -->
            <h2>Iniciar Sesión</h2>
            <form class="formulario" method="post" action="" onsubmit="logUsuario(); return false;">                
                <label class="usuario" for="inputUsuario">Usuario</label>
                <input id="inputUsuario" class="inputForm" type="text" name="inputUsuario" required>
                <label class="passw" for="inputContrasena">Contraseña</label>
                <input id="inputContrasena" class="inputForm" type="password" required>
                <button class="botonForm" type="submit" value="Ingresar.">Ingresar</button>
                <div class="alerta">
                    <div class="alerta-titulo"></div>
                    <div class="alerta-icono"></div>
                    <p id="respuestaLogin" class="alerta-texto"></p>
                    <div class="alerta-boton" onclick="ocultarAlerta()">
                        <p>Cerrar</p>
                    </div>	
                </div>
            </form>
        </div>
    </div>
</div>