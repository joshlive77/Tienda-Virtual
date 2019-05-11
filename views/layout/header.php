<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda de camisetas</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css"/>
</head>
<body>

    <!-- CONTENEDOR -->
    <div id="container">
    
        <!-- CABECERA -->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta Logo"/>
                <a href="index.php">
                    Tienda de ropa
                </a>
            </div>
        </header>
        <!-- FIN DE LA CABECERA -->

        <!-- MENU -->
        <?php $categorias = Utils::showCategorias();?>
        <nav id="menu">
            <ul>
                <li><a href="<?=base_url?>">Inicio</a></li>
                <?php while($cat = $categorias->fetch_object()): ?>
                    <li><a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a></li>
                <?php endwhile; ?>
            </ul>
        </nav>
        <!-- FIN DE MENU -->

        <div id="content">