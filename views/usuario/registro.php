<h1>Registrarse</h1>

<?php if(isset($_SESSION['completado'])):?>
    <!-- <strong class="alert_green">Registro completado correctamente</strong> -->
    <strong class="alert_green"><?= $_SESSION['completado']; ?></strong>
<?php elseif(isset($_SESSION['errores']) && $_SESSION['errores'] == 'failed'): ?>
    <!-- <strong class="alert_red">Registro fallido, introduce bien los datos</strong> -->
    <strong class="alert_red"><?= $_SESSION['errores']['general']; ?></strong> 
<?php endif; ?>



<form action="<?=base_url?>usuario/save" method="post">
    <label for="nombre">Nombre: </label>

    <!-- el require es para que el campo sea obligatoria -->
    <input type="text" name="nombre" require>
    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''?>

    <label for="apellidos">Apellidos: </label>
    <input type="text" name="apellidos" require>
    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''?>
    
    <label for="email">Email: </label>
    <input type="email" name="email" require>
    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''?>

    <label for="password">Password: </label>
    <input type="password" name="password" require>
    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''?>

    <input type="submit" value="Registrarse">
</form>

<?php Utils::deleteSession('completado'); ?>
<?php Utils::deleteSession('errores'); ?>