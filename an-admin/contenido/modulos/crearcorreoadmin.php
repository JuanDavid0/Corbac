<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>REGISTRAR NUEVO CORREO</h2>           
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxCorreo.php" enctype="multipart/form-data">                              
            <label class="label-form-act-admin">Nombre:</label>
            <input name="nombre" class="input-form-act-admin" type="text" required placeholder="informacion"> 
            <label class="label-form-act-admin">Correo:</label>
            <input name="correo" class="input-form-act-admin" type="email" required placeholder="informacion">      
            <label class="label-form-act-admin">Telefono:</label>
            <input name="telefono" class="input-form-act-admin" type="number" required placeholder="informacion">
            <input name="accion" value="crear" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit" >Crear</button>   
        </form>
    </div>
</div>