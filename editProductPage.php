<?php declare(strict_types = 1);


require_once('templates/common.tpl.php');
require_once('templates/product.tpl.php');
require_once('classes/session.class.php');
require_once('classes/product.class.php');
require_once('database/connection.db.php');

$session = new Session();

$db=getDatabaseConnection();
$id=intval($_GET['id']);
$product=Product::getProduct($db,$id);

if($_SESSION['id']==$product->seller_id)

$_SESSION['input']['name oldProduct']= $_SESSION['input']['name oldProduct'] ?? $product->name;
$_SESSION['input']['category oldProduct']= $_SESSION['input']['category oldProduct'] ?? $product->category;
$_SESSION['input']['brand oldProduct']= $_SESSION['input']['brand oldProduct'] ?? $product->brand;
$_SESSION['input']['size oldProduct']= $_SESSION['input']['size oldProduct'] ?? $product->size;
$_SESSION['input']['condition oldProduct']= $_SESSION['input']['condition oldProduct'] ?? $product->condition;
$_SESSION['input']['description oldProduct']= $_SESSION['input']['description oldProduct'] ?? $product->description;
$_SESSION['input']['price oldProduct']= $_SESSION['input']['price oldProduct'] ?? $product->price;

drawHeader();
if (count($session->getMessages())) drawMessages($session);
drawProductEdit($product->id);
drawFooter();
?>