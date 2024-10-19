<?php
  declare(strict_types = 1);
  require_once(dirname(__DIR__).'/database/connection.db.php');
  require_once(dirname(__DIR__).'/classes/session.class.php');
  require_once(dirname(__DIR__).'/utils/validation.php');
  require_once(dirname(__DIR__).'/classes/product.class.php');
  $session = new Session();

  if (!$session->LoggedIn()) {
    $session->addMessage('error', "Ação não disponível");
    die(header('Location: ../index.php'));
  }

  
  $db = getDatabaseConnection();

  $product=Product::getProduct($db,intval($_POST['id']));
  
  if($product->sold!=0){
    $session->addMessage('error', "Produto indisponível");
    die(header('Location: ../productPage.php?='.$product->id));
  }

  if($product->seller_id==$_SESSION['id']){
    $session->addMessage('error', "Não pode adicionar um produto seu ao carrinho");
    die(header('Location: ../productPage.php?='.$product->id));
  }
  
  $stmt = $db->prepare('SELECT * FROM Cart WHERE UserId = ? AND ProductId= ?');
  $stmt->execute(array($_SESSION['id'], $_POST['id']));

  $a = $stmt->fetch();
  if (!$a) {
    $stmt = $db->prepare('INSERT INTO Cart VALUES (?, ?)');
    $stmt->execute(array($_SESSION['id'], $_POST['id']));
  }
?>