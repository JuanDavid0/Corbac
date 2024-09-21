<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>REGISTRAR NUEVO USUARIO</h2>           
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxUsuario.php" enctype="multipart/form-data">                              
            <label class="label-form-act-admin">Correo:</label>
            <input name="correo" class="input-form-act-admin" type="email" required placeholder="info@anbu.com.co"> 
            <label class="label-form-act-admin">Contraseña:</label>
            <input name="contrasena" class="input-form-act-admin" type="password" required>                  
            <input name="accion" value="crear" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit" >Crear</button>   
        </form>
    </div>
</div>