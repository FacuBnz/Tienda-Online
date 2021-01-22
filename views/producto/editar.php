<h1>Editar producto</h1>
<?php
/** @var $product */


$pro = $product->fetch();
?>
<div class="form_container">
    <form action="<?=base_url."producto/save"?>" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?=$pro["nombre"]?>">

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" id="descripcion"><?=$pro["descripcion"]?></textarea>

        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio" value="<?=$pro["precio"]?>">

        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" value="<?=$pro["stock"]?>">

        <label for="categoria">Categoria</label>
        <?php $categorias = Utils::ShowCategorias();?>
        <select name="categoria" id="categoria">
            <?php while ($cat = $categorias->fetch()): ?>
                <option value="<?=$cat["id"]?>" <?=$cat["id"]==$pro["id"]?"selected":""?> ><?=$cat["nombre"]?></option>
            <?php endwhile; ?>
        </select>

        <label for="imagen">Imagen</label>
        <?php if(isset($pro) && !empty($pro["imagen"])):?>
            <img src="<?=base_url?>uploads/images/<?=$pro["imagen"]?>" alt="<?=$pro["imagen"]?>" class="thumb">
        <?php endif;?>
        <input type="file" name="imagen" id="imagen">


        <input type="submit" value="Editar">
        <input type="hidden" name="id_borrar" value="<?=$_GET["id"]?>">
    </form>
</div>

