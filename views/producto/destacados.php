<?php  /** @var $algunos */?>
<h1>Algunos de nuestros productos</h1>
    <?php if($algunos):?>
        <?php while ($pro = $algunos->fetch()):?>
            <div class="product">
                <?php if($pro["imagen"] == ""):?>
                    <a href="<?=base_url?>producto/ver&id=<?=$pro["id"]?>">
                        <img src="assets/img/camiseta.png" alt="camiseta" class="img_carrito">
                    </a>

                <?php else: ?>
                    <a href="<?=base_url?>producto/ver&id=<?=$pro["id"]?>">
                        <img src="<?=base_url?>uploads/images/<?=$pro["imagen"]?>" alt="<?=$pro["nombre"]?>" class="img_carrito">
                    </a>

                <?php endif;?>

                <h2><?=$pro["nombre"]?></h2>
                <p>$<?=$pro["precio"]?> ARS</p>
                <a href="<?=base_url?>carrito/add&id=<?=$pro["id"]?>" class="button">Agregar al carrito</a>
            </div>
        <?php endwhile;?>
    <?php else:?>
        <h3>No hay productos cargados </h3>
    <?php endif;?>

</main>
