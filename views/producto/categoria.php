<?php
/** @var $productos */
/** @var $titulo */
?>

<?php
    if($titulo){
        $tittle = $titulo->fetch();
        echo "<h1>{$tittle["nombre"]}</h1>";
    }
?>

<?php if($productos):?>
    <?php while ($pro = $productos->fetch()):?>
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
            <a href="<?=base_url?>carrito/add&id=<?=$pro["id"]?>" class="button">Comprar</a>
        </div>
    <?php endwhile;?>
<?php else:?>
    <h3>No hay productos cargados </h3>
<?php endif;?>

</main>

