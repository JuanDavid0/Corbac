<?php
date_default_timezone_set("America/Bogota");
require_once './conexion/bdconexion.php';
require_once './contenido/clases/distribuidores.php';
$objDistribuidores = new distribuidores();
$resultado = $objDistribuidores->buscarDistribuidor($msg);
?>
<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>Editar Contenido</h2>           
        <form id="contenedor-form-Admin" method="post" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxNoticia.php" enctype="multipart/form-data">        
            <label class="label-form-act-admin">Titulo Noticia</label>
            <input id="inputNoticiaTitulo" onkeyup="crearUrl(this.value);" value="<?php echo $noticiaF['nombre']; ?>" name="nombre" class="input-form-act-admin" type="text" placeholder="Titulo Noticia" required/>                
            <input id="inputNoticiaUrl"  style="display: none;" name="url_amigable" value="<?php echo $noticiaF['url_amigable']; ?>"  class="input-form-act-admin" type="text" placeholder="Url_amigable" required/>  
            <label class="label-form-act-admin">Descripcion</label>
            <textarea id="inputNoticiaDescripcion" name="descripcion" class="input-form-act-admin" type="text" placeholder="Descripcion global de la noticia" maxlength="300" required><?php echo $noticiaF['descripcion']; ?></textarea>                   
            <label class="label-form-act-admin">Presentacion</label>
            <textarea id="inputNoticiaPresentacion" name="presentacion"  class="input-form-act-admin" type="text" placeholder="Presentacion corta de la noticia" maxlength="250" required><?php echo $noticiaF['presentacion']; ?></textarea>                       
            <label class="label-form-act-admin">Contenido</label>
            <textarea id="inputProyectoContenido" style="height: 200px; display:none;"  name="contenido" class="input-form-act-admin" type="text" ></textarea>    
            <div id="editor" name="editor" style="height: 200px;"><?php print $noticiaF['contenido']; ?> </div>
            <label class="label-form-act-admin">Frame Youtube</label>
            <textarea id="inputNoticiaVideo" name="video" class="input-form-act-admin" type="text"  placeholder="<iframe  https://www.youtube.com/embed/zTmaY_zUCsI> </iframe>"><?php echo $noticiaF['video']; ?></textarea>
            <label class="label-form-act-admin">Titulo Video</label>
            <input id="inputTituloVideo" name="tvideo" class="input-form-act-admin" type="text" value="<?php echo $noticiaF['tvideo']; ?>" placeholder="Titulo de Video" maxlength="200"/>
            <label class="label-form-act-admin">Contenido Video</label>
            <textarea id="inputContenidoVideo" name="cvideo" class="input-form-act-admin"  type="text" placeholder="Texto informacion sobre video" ><?php echo $noticiaF['cvideo']; ?></textarea>                                              
            <label class="label-form-act-admin">Imagen </label>
            <label class="label-form-act-admin">Tamaño Recomendado: 600px * 600px</label>
            <input id="inputNoticiaImagen" name="imagen" class="input-form-act-admin inputImagen" type="file" accept=".jpg"/>          
            <img id="previsua" src="<?php echo $rutaFinal.'contenido/assets/'.$noticiaF['imagen']; ?>" style="display: block; width: 60%; height: 150px; background-position: center; background-size:contain; background-repeat:no-repeat; margin:0px auto;"/>
            <label class="label-form-act-admin">Fecha</label>
            <input id="fecha" name="fecha" class="input-form-act-admin" type="date"  value="<?php echo $noticiaF['fecha']; ?>" required/>
            <label class="label-form-act-admin">Idioma</label>
            <select name="idioma" class="input-form-act-admin">
                <option value="es" <?php if($bannerF['idioma'] === 'es' ){  echo 'selected=""' ;}?>>Español</option>
                <option value="en" <?php if($bannerF['idioma'] === 'en' ){  echo 'selected=""'; } ?>>Ingles</option>               
            </select> 
            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="suscrito" <?php if($noticiaF['estado'] === 'activo' ){  echo 'selected=""' ;}?>>Activo</option>
                <option value="inactivo" <?php if($noticiaF['estado'] === 'inactivo' ){  echo 'selected=""'; } ?>>Inactivo</option>               
            </select>  
            <input name="identificador" value="<?php echo $noticiaF['identificador']; ?>" type="hidden" readonly required>
            <input name="accion" value="editar" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit" >Editar Noticia</button>
        </form>
    </div>
</div>