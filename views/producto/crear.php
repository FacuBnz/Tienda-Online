<h1>Agragar producto</h1>

<div class="form_container">
    <form action="<?=base_url."producto/save"?>" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" id="descripcion"></textarea>

        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio">

        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock">

        <label for="categoria">Categoria</label>
        <?php $categorias = Utils::ShowCategorias();?>
        <select name="categoria" id="categoria">
            <?php while ($cat = $categorias->fetch()): ?>
                <option value="<?=$cat["id"]?>"><?=$cat["nombre"]?></option>
            <?php endwhile; ?>
        </select>

        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" id="imagen">

        <input type="submit" value="Crear">
    </form>
</div>
