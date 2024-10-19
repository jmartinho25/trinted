<?php declare(strict_types = 1);


require_once('templates/common.tpl.php');
require_once('templates/product.tpl.php');
require_once('classes/session.class.php');
require_once('database/connection.db.php');

$session = new Session();
$_SESSION['input']['name newProduct']= $_SESSION['input']['name newProduct'] ?? "";
$_SESSION['input']['category newProduct']= $_SESSION['input']['category newProduct'] ?? "";
$_SESSION['input']['brand newProduct']= $_SESSION['input']['brand newProduct'] ?? "";
$_SESSION['input']['size newProduct']= $_SESSION['input']['size newProduct'] ?? "";
$_SESSION['input']['condition newProduct']= $_SESSION['input']['condition newProduct'] ?? "";
$_SESSION['input']['description newProduct']= $_SESSION['input']['description newProduct'] ?? "";
$_SESSION['input']['price newProduct']= $_SESSION['input']['price newProduct'] ?? "";

$categories=array();
$category='';
$db=getDatabaseConnection();
$stmt= $db->prepare('SELECT CategoryName FROM Categories');
$stmt->execute(array());
while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $categories[] = $category['CategoryName']; 
}
$conditions=array();
$condition='';
$db=getDatabaseConnection();
$stmt= $db->prepare('SELECT ConditionName FROM Conditions');
$stmt->execute(array());
while ($condition = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $conditions[] = $condition['ConditionName']; 
}
drawHeader();
if (count($session->getMessages())) drawMessages($session, $conditions);
drawProductRegister($categories, $conditions);
drawFooter();
?>