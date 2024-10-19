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
  $stmt = $db->prepare('SELECT * FROM Favorites WHERE UserId = ? AND ProductId= ?');
  $stmt->execute(array($_SESSION['id'], $_POST['id']));

  $a = $stmt->fetch();
  if (!$a) {
    $stmt = $db->prepare('INSERT INTO Favorites VALUES (?, ?)');
    $stmt->execute(array($_SESSION['id'], $_POST['id']));
  }
?>