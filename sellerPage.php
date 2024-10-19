<?php 
    declare(strict_types = 1);



    require_once('templates/common.tpl.php');
    require_once('templates/seller.tpl.php');
    require_once('classes/session.class.php');

    $session=new Session();

    $id=intval($_GET['id']);

    drawHeader();
    if(count($session->getMessages())) drawMessages($session);
    drawSeller($id);
    drawFooter();
?>