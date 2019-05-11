<?php if(isset($_SESSION['identity'])): ?>
    <h1>Hacer pedido</h1>
    <p>
        <a href="<?=base_url?>carrito/index">Ver productos</a>
    </p>
    <br>
    <h3>Direccion para el envio</h3>
    <form action="<?=base_url.'pedido/add'?>" method="post">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" required>
        <label for="ciudad">Ciudad</label>
        <input type="text" name="localidad" required>
        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" required>
        <input type="submit" value="confirmar pedido">
    </form>
<?php else: ?>
    <h1>Necesitas loguearte</h1>
    <p>necesitas identificarte para realizar el pedido</p>
<?php endif; ?>