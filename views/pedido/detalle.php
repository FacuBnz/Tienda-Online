<h1>Detalle del pedido</h1>
<?php if (isset($detalle) && isset($productos)):?>

    <?php if(isset($_SESSION["admin"])):?>
        <h3>Cambiar estado del pedido</h3>
        <form action="<?=base_url?>pedido/estado" method="post">
            <select name="estado" id="estado">
                <option value="confirm" <?=$detalle["estado"] == "confirm" ? "selected" : ""?>>Pendiente</option>
                <option value="preparation" <?=$detalle["estado"] == "preparation" ? "selected" : ""?>>En preparacion</option>
                <option value="ready" <?=$detalle["estado"] == "ready" ? "selected" : ""?>>Preparado para enviar</option>
                <option value="sended" <?=$detalle["estado"] == "sended" ? "selected" : ""?>>Enviado</option>
            </select>

            <input type="submit" value="Cambiar estado">
            <input type="hidden" name="id_pedido" value="<?=$detalle["id"]?>">
        </form>
        <br>
    <?php endif; ?>
    <h3>Datos del pedido</h3>
    <br>
    <p>Numero de pedido: <?=$detalle["id"]?></p>
    <p>Total a pagar: <?="$".$detalle["coste"]." ARS"?></p>
    <p>Estado: <?=Utils::ShowEstatus($detalle["estado"])?></p>
    <p>Productos:</p>
    <br>
    <table>
        <tr>
            <th>IMAGEN</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>UNIDADES</th>
        </tr>
        <?php foreach ($productos as $i=>$value): ?>
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
<?php else:?>
    <h3>Hubo un error, por favor vuelva a intentarlo mas tarde</h3>
<?php endif;?>
