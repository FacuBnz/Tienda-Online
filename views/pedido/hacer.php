<?php if (isset($_SESSION["identity"])):?>
    <h1>Hacer pedido</h1>
    <a href="<?=base_url?>carrito/index">Ver los productos y el precio del pedido</a>;
    <h3>Direccion para el envio</h3>
    <form action="<?=base_url?>pedido/add" method="post">
        
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" id="provincia" required>

        <label for="localidad">Localidad</label>
        <input type="text" name="localidad" id="localidad" required>

        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" id="direccion" required>

        <input type="submit" value="Confirmar pedido">
    </form>
<?php else:?>
    <h1>Necesitas estar indetificado</h1>
    <p>Necesitas estar logueado en la web para poder realizar el pedido</p>
<?php endif;?>
