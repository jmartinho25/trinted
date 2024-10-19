<?php
  declare(strict_types = 1);
  require_once(dirname(__DIR__).'/database/connection.db.php');
  require_once(dirname(__DIR__).'/classes/session.class.php');
  require_once(dirname(__DIR__).'/utils/validation.php');
  $session = new Session();

  if (!$session->LoggedIn()) {
    $session->addMessage('error', "Ação não disponível");
    die(header('Location: ../index.php'));
  } 

  $db = getDatabaseConnection();
  $stmt = $db->prepare('SELECT * FROM Cart WHERE UserId = ?');
  $stmt->execute(array($_SESSION['id']));
  $items = array();
  while ($purchase = $stmt->fetch()) {
      $items[] = array (
          $purchase['UserId'],
          $purchase['ProductId'],
          date('Y-m-d H:i')
      );
  };

  $stmt = $db->prepare('INSERT INTO Purchase (UserId, ProductId, Date) VALUES (?, ?, ?)');
  foreach ($items as $purchase) {
    $stmt->execute($purchase);
  }

  $stmt = $db->prepare('UPDATE Products SET Sold = 1 WHERE Products.ProductId IN (SELECT Cart.ProductId FROM Cart WHERE UserId = ?)');
  $stmt->execute(array($_SESSION['id']));

  $stmt = $db->prepare('DELETE FROM Cart WHERE UserId = ?');
  $stmt->execute(array($_SESSION['id']));
  
  $session->addMessage('success', 'Compra efetuada. Pode ver os produtos comprados no seu perfil');
  header('Location: ../index.php');
  ?>