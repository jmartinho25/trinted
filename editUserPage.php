<?php declare(strict_types = 1);


require_once('templates/common.tpl.php');
require_once('templates/user.tpl.php');
require_once('classes/session.class.php');
require_once('classes/user.class.php');
require_once('database/connection.db.php');

$session = new Session();

$db=getDatabaseConnection();
$id=intval($_GET['id']);
$user=User::getUser($db,$id);

$_SESSION['input']['userName oldUser']= $_SESSION['input']['userName oldUser'] ?? $user->userName;
$_SESSION['input']['email oldUser']= $_SESSION['input']['email oldUser'] ?? $user->email;
$_SESSION['input']['password1 oldUser']= $_SESSION['input']['password1 oldUser'] ?? "";
$_SESSION['input']['password2 oldUser']= $_SESSION['input']['password2 oldUser'] ?? "";
$_SESSION['input']['firstName oldUser']= $_SESSION['input']['firstName oldUser'] ?? $user->firstName;
$_SESSION['input']['lastName oldUser']= $_SESSION['input']['lastName oldUser'] ?? $user->lastName;
$_SESSION['input']['userAddress oldUser']= $_SESSION['input']['userAddress oldUser'] ?? $user->address;
$_SESSION['input']['phone oldUser']= $_SESSION['input']['phone oldUser'] ?? $user->phoneNumber;

drawHeader();

if (count($session->getMessages())) drawMessages($session);
drawUserEdit($id);
drawFooter();
?>