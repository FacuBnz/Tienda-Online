<?php if(isset($_SESSION["pedido"]) && $_SESSION["pedido"] == "completed"):?>
    <h1>Tu pedido ha sido confirmando</h1>
    <p>Tu pedido ha sido guardado con exito, una vez que realices la tranferencia bancaria a la cuenta 48552121JFBGR156 con el coste del pedido, será procesado y enviado.</p>
    <br>
    <?php if(isset($pedido) && isset($pedido_productos)):?>
        <h3>Datos del pedido</h3>
        <br>
        <p>Numero de pedido: <?=$pedido["id"]?></p>
        <p>Total a pagar: <?="$".$pedido["coste"]." ARS"?></p>
        <p>Productos:</p>
        <br>
        <table>
            <tr>
                <th>IMAGEN</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>UNIDADES</th>
            </tr>
            <?php foreach ($pedido_productos as $i=>$value): ?>
                <tr>

                    <?php if($value["imagen"] == ""):?>

                        <td>
                            <img src="assets/img/camiseta.png" alt="camiseta" class="img_carrito">
                        </td>

                    <?php else:?>
                        <td>
                            <img src="<?=base_url?>uploads/images/<?=$value["imagen"]?>" alt="<?=$value["nombre"]?>" class="img_carrito">
                        </td>
                    <?php endif;?>

                    <td><?=$value["nombre"]?></td>
                    <td>$<?=$value["precio"]?> ARS</td>
                    <td><?=$value["unidades"]?></td>

                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif;?>
<?php Utils::deleteCarrito(); ?>
<?php elseif(isset($_SESSION["pedido"]) && $_SESSION["pedido"] == "failed"):?>
    <h1>Tu pedido ha fallado</h1>
    <p>Por favor vuelva a intententarlo mas tarde</p>
<?php endif;?>

