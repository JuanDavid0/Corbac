<?php
require_once './contenido/clases/correo.php';
$correo = new Correo();
$correo->id = $msg;
$correoF = Correo::buscarCorreo('correo',$correo);
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR TESTIMONIO</h2>           
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxCorreo.php" enctype="multipart/form-data">                              
            <label class="label-form-act-admin">Nombre:</label>
            <input name="nombre" class="input-form-act-admin" type="text" required value="<?php echo $correoF['nombre']; ?>"> 
            <label class="label-form-act-admin">Correo:</label>
            <input name="correo" class="input-form-act-admin" type="email" required value="<?php echo $correoF['correo']; ?>">
            <label class="label-form-act-admin">Telefono:</label>
            <input name="telefono" class="input-form-act-admin" type="number" value="<?php echo $correoF['telefono']; ?>">             
            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="suscrito" <?php if($correoF['estado'] === 'suscrito' ){  echo 'selected=""' ;}?>>Suscrito</option>
                <option value="inactivo" <?php if($correoF['estado'] === 'inactivo' ){  echo 'selected=""'; } ?>>Inactivo</option>               
            </select>  
            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="id" value="<?php echo $correoF['id']; ?>" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit" >Editar</button>   
        </form>
    </div>
</div>