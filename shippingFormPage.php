<?php declare(strict_types=1);



require_once('database/connection.db.php');
require_once('classes/product.class.php');


require_once('templates/common.tpl.php');
require_once('templates/product.tpl.php');

require_once('classes/session.class.php');

$session = new Session();



$id=intval($_GET['id']);

$db = getDatabaseConnection();




drawHeader();
if (count($session->getMessages())) drawMessages($session);
drawShippingForm($id);
drawFooter();

?>