<?php
    declare(strict_types = 1);


    require_once('database/connection.db.php');
    require_once('classes/product.class.php');
    require_once('classes/session.class.php');

    require_once('templates/common.tpl.php');
    require_once('templates/product.tpl.php');

    $session = new Session();

    $db = getDatabaseConnection();

    $recommended = Product::getRecommendedProducts($db);
    
    $products = Product::getProducts($db, 30);

    drawHeader();

    if (count($session->getMessages())) drawMessages($session);
    drawRecommended($recommended, "Recomendados");
    drawProducts($products, "Todos os Produtos");
    drawFooter();
    
?>