<?php
/** @var $productos */
?>

<h1>Gestionar productos</h1>
<a href="<?=base_url?>producto/crear" class="button button-small">Agregar</a>

<?php if(isset($_SESSION["producto"]) && $_SESSION["producto"] == "completed"):?>
    <strong class="alert_green">El producto se ha guardado correctamente</strong>
<?php elseif(isset($_SESSION["producto"]) && $_SESSION["producto"] != "completed"):?>
    <strong class="alert_red">El producto NO se guardado correctamente</strong>
<?php endif;?>

<?php Utils::DeleteSession("producto");?>

<?php if(isset($_SESSION["delete"]) && $_SESSION["delete"] == "completed"):?>
    <strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION["delete"]) && $_SESSION["delete"] != "completed"):?>
    <strong class="alert_red">El producto NO se borrado correctamente</strong>
<?php endif;?>

<?php Utils::DeleteSession("delete");?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>DESCRIPCION</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>FECHA</th>
        <th>ACCIONES</th>
    </tr>
    <?php while ($pro = $productos->fetch()): ?>
        <tr>
            <td><?=$pro["id"]?></td>
            <td><?=$pro["nombre"]?></td>
            <td><?=$pro["descripcion"]?></td>
            <td><?=$pro["precio"]?></td>
            <td><?=$pro["stock"]?></td>
            <td><?=$pro["fecha"]?></td>
            <td>
                <a href="<?=base_url?>producto/editar&id=<?=$pro["id"]?>" class="button button-gestion">Editar</a>
                <a href="<?=base_url?>producto/eliminar&id=<?=$pro["id"]?>" class="button button-gestion button-red">Borrar</a>
            </td>
            
        </tr>
    <?php endwhile; ?>
</table>








