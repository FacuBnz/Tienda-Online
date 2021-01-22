<?php
/** @var $product */

if($product){ $producto = $product->fetch();?>
        <h1><?=$producto["nombre"]?></h1>
    <div id="detail-product">
        <div class="image">
            <?php if($producto["imagen"] == ""):?>
                <img src="assets/img/camiseta.png" alt="camiseta">
            <?php else:?>
                <img src="<?=base_url?>uploads/images/<?=$producto["imagen"]?>" alt="<?=$producto["nombre"]?>">
            <?php endif;?>
        </div>
        <div class="data">
            <p class="description"><?=$producto["descripcion"]?></p>
            <p class="price">$<?=$producto["precio"]?> ARS</p>
            <a href="<?=base_url?>carrito/add&id=<?=$producto["id"]?>" class="button">Comprar</a>
        </div>

    </div>
<?php }else{ ?>
    <h3>No se encuentra disponible el producto</h3>
<?php
}
?>


