
<!--BARRA LATERAL-->
<aside id="lateral">

    <div id="login" class="block_aside">
        <?php if(!isset($_SESSION["identity"])) :?>
            <h3>Entrar en la web</h3>
            <form action="<?=base_url?>usuario/login" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">

                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">

                <input type="submit" value="Entrar">
            </form>

        <?php else:  ?>
            <h3><?=$_SESSION["identity"]["nombre"]?> <?=$_SESSION["identity"]["apellidos"]?></h3>
        <?php endif; ?>

        <ul>
            <?php if(!isset($_SESSION["admin"]) || !isset($_SESSION["identity"])):?>
                <li><a href="<?=base_url?>usuario/register">Registrate Aquí</a></li>
            <?php endif;?>
            <?php if(isset($_SESSION["admin"])): ?>
                <li><a href="<?=base_url?>pedido/gestion">Gestionar pedidos</a></li>
                <li><a href="<?=base_url?>categoria/index">Gestionar categorias</a></li>
                <li><a href="<?=base_url?>producto/gestion"">Gestionar productos</a></li>
                <li><a href="<?=base_url?>usuario/logout">Cerrar sesión</a></li>
            <?php endif; ?>

            <?php if(isset($_SESSION["identity"]) && !isset($_SESSION["admin"])) :?>
                <li><a href="<?=base_url?>carrito/index">Mi carrito</a></li>
                <li><a href="<?=base_url?>pedido/misPedidos">Mis pedidos</a></li>
                <li><a href="<?=base_url?>usuario/logout">Cerrar sesión</a></li>
            <?php endif;?>
        </ul>

    </div>
</aside>

<!--CONTENIDO CENTRAL-->
<main id="central">
