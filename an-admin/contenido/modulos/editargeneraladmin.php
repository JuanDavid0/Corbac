<?php
require_once './contenido/clases/general.php';
$general = new General();
$general->identificador = $msg;
$generalF = General::buscarGeneral('general',$general);
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR VALOR</h2>           
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxGeneral.php" enctype="multipart/form-data">                              
            <label class="label-form-act-admin">Nombre:</label>
            <input name="clase" class="input-form-act-admin" type="text" required readonly value="<?php echo $generalF['clase']; ?>"> 
            <label class="label-form-act-admin">Valor:</label>
            <input name="variable" class="input-form-act-admin" type="text" required value="<?php echo $generalF['variable']; ?>">            
            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="activo" <?php if($generalF['estado'] === 'activo' ){  echo 'selected=""' ;}?>>Activo</option>
                <option value="inactivo" <?php if($generalF['estado'] === 'inactivo' ){  echo 'selected=""'; } ?>>Inactivo</option>               
            </select>  
            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="identificador" value="<?php echo $generalF['identificador']; ?>" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit" >Editar</button>   
        </form>
    </div>
</div>