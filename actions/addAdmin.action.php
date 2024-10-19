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
  $stmt = $db->prepare('SELECT * FROM Users WHERE UserId = ? AND UserType=?');
  $stmt->execute(array($_POST['id'],1));

  $a = $stmt->fetch();
  if (!$a) {
    $stmt = $db->prepare('UPDATE Users SET UserType = 1 WHERE UserId = ?');
    $stmt->execute(array($_POST['id']));
  }

  $session->addMessage('success', "Utilizador promovido a admin");
  die(header('Location: ../index.php'));

?>