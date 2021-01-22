<?php
/** @var $categorias */
?>

<a href="<?=base_url?>categoria/crear" class="button button-small">Crear categoria</a>
<h1>Gestionar categorias</h1>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
    </tr>
    <?php while ($cat = $categorias->fetch()): ?>
        <tr>
            <td><?=$cat["id"]?></td>
            <td><?=$cat["nombre"]?></td>
        </tr>
    <?php endwhile; ?>
</table>
