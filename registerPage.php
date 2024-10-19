<?php declare(strict_types = 1);


require_once('templates/common.tpl.php');
require_once('templates/register.tpl.php');
require_once('classes/session.class.php');

$session = new Session();

$_SESSION['input']['userName newUser']= $_SESSION['input']['userName newUser'] ?? "";
$_SESSION['input']['email newUser']= $_SESSION['input']['email newUser'] ?? "";
$_SESSION['input']['password1 newUser']= $_SESSION['input']['password1 newUser'] ?? "";
$_SESSION['input']['password2 newUser']= $_SESSION['input']['password2 newUser'] ?? "";
$_SESSION['input']['firstName newUser']= $_SESSION['input']['firstName newUser'] ?? "";
$_SESSION['input']['lastName newUser']= $_SESSION['input']['lastName newUser'] ?? "";
$_SESSION['input']['userAddress newUser']= $_SESSION['input']['userAddress newUser'] ?? "";
$_SESSION['input']['phone newUser']= $_SESSION['input']['phone newUser'] ?? "";

drawHeader();

if (count($session->getMessages())) drawMessages($session);
drawRegister();
drawFooter();
?>