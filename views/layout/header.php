<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tienda de ropa</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
</head>
<body>
<!-- HEADER -->
<div id="container">

    <header id="header">
        <div id="logo">
            <img src="<?=base_url?>assets/img/camiseta.png" alt="camiseta">
            <a href="<?=base_url?>">
                Tienda de ropa
            </a>
        </div>
    </header>
    <!-- MENU -->

    <?php $categorias = Utils::ShowCategorias()?>
    <nav id="menu">
        <ul>
            <li>
                <a href="<?=base_url?>">Inicio</a>
            </li>
            <?php while ($cat = $categorias->fetch()): ?>
                <li>
                    <a href="<?=base_url?>categoria/ver&id=<?=$cat["id"]?>"><?=$cat["nombre"]?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    </nav>

    <div id="content">