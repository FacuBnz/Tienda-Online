<h1>Registrarse</h1>

<?php if(isset($_SESSION["register"]) && $_SESSION["register"] == "complete"){ ?>
    <strong class="alert_green">Registro completado correctamente</strong>
<?php }elseif(isset($_SESSION["register"]) && $_SESSION["register"] == "failed"){?>
    <strong class="alert_red">Registro Fallido</strong>
<?php } ?>

<?php if(isset($_SESSION["register"])){
    Utils::DeleteSession("register");
}?>

<form action="<?=base_url?>/usuario/save" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" required>

    <input type="submit" value="Registrar">
</form>