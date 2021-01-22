<h1>Carrito de compra</h1>

<?php if (isset($_SESSION["carrito"])):?>
    <table>
        <tr>
            <th>IMAGEN</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>UNIDADES</th>
        </tr>
        <?php foreach ($_SESSION["carrito"] as $i=>$value): ?>
            <tr>
                <?php if($_SESSION["carrito"][$i]["producto"]["imagen"] == ""):?>
                    <td>
                        <img src="assets/img/camiseta.png" alt="camiseta" class="img_carrito">
                    </td>

                <?php else:?>
                    <td>
                        <img src="<?=base_url?>uploads/images/<?=$_SESSION["carrito"][$i]["producto"]["imagen"]?>" alt="<?=$_SESSION["carrito"][$i]["producto"]["nombre"]?>" class="img_carrito">
                    </td>
                <?php endif;?>

                <td><?=$_SESSION["carrito"][$i]["producto"]["nombre"]?></td>
                <td><?=$_SESSION["carrito"][$i]["producto"]["precio"]?></td>
                <td><?=$_SESSION["carrito"][$i]["unidades"]?></td>
                <td>
                    <a href="<?=base_url?>carrito/add&id=<?=$_SESSION["carrito"][$i]["producto"]["id"]?>" class="button button-gestion">+</a>
                    <a href="<?=base_url?>carrito/remove&id=<?=$_SESSION["carrito"][$i]["producto"]["id"]?>" class="button button-gestion button-red">-</a>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
    <?php $stats = Utils::statsCarrito();?>

    <h3>Cantidad de productos: <?=$stats["count"]?></h3>
    <h3>Total a pagar: $<?=$stats["total"]?> ARS</h3>
    <a href="<?=base_url?>carrito/deleteCarrito?>" class="button button-red">Eliminar carrito</a>
    <div class="total-carrito">
        <a href="<?=base_url?>pedido/hacer?>" class="button button-pedido">Pagar</a>
    </div>
<?php else:?>
    <h3>Debes agregar productos al carrito</h3>
<?php endif;?>



