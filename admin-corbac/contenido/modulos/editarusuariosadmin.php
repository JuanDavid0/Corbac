<?php
require_once './contenido/clases/usuario.php';
$usuario = new Usuario();
$usuario->correo_p = $msg;
$correoF = Usuario::buscarusuario('admin_users', $usuario);
?>

<div id="contenedor-AreaTrabjo-Admin">
    <div class="contenedor-Agregar-minas"></div>
    <div id="AreaTrabjo-Admin-cont">
        <h2>EDITAR USUARIO</h2>
        <form id="contenedor-form-Admin" method="POST" action="<?php echo $rutaFinal ?>contenido/ajax/ajaxUsuario.php" enctype="multipart/form-data">
            <label class="label-form-act-admin">Correo:</label>
            <input name="correo" class="input-form-act-admin" type="email" required value="<?php echo $correoF['correo']; ?>" readonly>
            <label class="label-form-act-admin">Nueva Contraseña:</label>
            <input name="contrasena" class="input-form-act-admin" type="password" value="<?php echo $correoF['contrasena']; ?>">
            <label class="label-form-act-admin">Estado</label>
            <select name="estado" class="input-form-act-admin">
                <option value="Activo" <?php if ($correoF['estado'] === 'Activo') {
                                            echo 'selected=""';
                                        } ?>>Activo</option>
                <option value="Inactivo" <?php if ($correoF['estado'] === 'Inactivo') {
                                                echo 'selected=""';
                                            } ?>>Inactivo</option>
            </select>
            <input name="accion" value="editar" type="hidden" readonly required>
            <input name="correo_p" value="<?php echo $correoF['correo_p']; ?>" type="hidden" readonly required>
            <button class="inputSubmitForm" type="submit">Editar</button>
        </form>
    </div>
</div>