<?php declare(strict_types = 1);


require_once('templates/common.tpl.php');
require_once('templates/login.tpl.php');
require_once('classes/session.class.php');

$session=new Session();

$_SESSION['input']['email login'] = $_SESSION['input']['email login'] ?? "";
$_SESSION['input']['password login'] = $_SESSION['input']['password login'] ?? "";

drawHeader();

if (count($session->getMessages())) drawMessages($session);
drawLogin();
drawFooter();


?>