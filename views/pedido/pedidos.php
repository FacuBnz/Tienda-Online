<?php $valor=""?>
<?php if (isset($gestion)):?>
    <h1>Gestionar Pedidos</h1>
<?php else:?>
    <h1>Mis pedidos</h1>
<?php endif;?>

<table>
    <tr>
        <th>ID PEDIDO</th>
        <th>DIRECCION</th>
        <th>FECHA</th>
        <th>ESTADO</th>
    </tr>
    <?php foreach ($pedidos as $i=>$value): ?>
        <?php if ($value["id"] != $valor):?>
            <tr>
                <td><a href="<?=base_url?>pedido/detalle&id=<?=$value["id"]?>"><?=$value["id"]?></a></td>
                <td><?=$value["provincia"]?>, <?=$value["localidad"]?>, <?=$value["direccion"]?></td>
                <td><?=$value["fecha"]?></td>
                <td><?=Utils::ShowEstatus($value["estado"])?></td>
            </tr>
        <?php $valor = $value["id"]?>
        <?php endif;?>
    <?php endforeach; ?>
</table>