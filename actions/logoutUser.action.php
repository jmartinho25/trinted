<?php
declare(strict_types=1);
require_once(dirname(__DIR__).'/classes/session.class.php');
$session = new Session();

unset($_SESSION['input']['email login']);
unset($_SESSION['input']['password login']);
if($session->LoggedIn()) {
    $session->logout();
}
header('Location: ../index.php');
?>