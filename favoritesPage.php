<?php 
    declare(strict_types = 1);


    require_once('database/connection.db.php');
    require_once('classes/product.class.php');
    require_once('templates/common.tpl.php');
    require_once('templates/product.tpl.php');
    require_once('classes/session.class.php');

    $session = new Session();

    if (!$session->LoggedIn()) {
        $session->addMessage('error', 'Para aceder a este conteúdo necessita de estar registado');
        die(header('Location: ../loginPage.php'));
    };


    
    $db = getDatabaseConnection();
    $products = Product::getFavProducts($db, $_SESSION['id']);

    drawHeader();
    if (count($session->getMessages())) drawMessages($session);
    drawFavoritesList($products,"Favoritos");
    drawFooter();
?>