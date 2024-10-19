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
  $stmt = $db->prepare('UPDATE Users SET UserType = 0 WHERE UserId = ?');
  $stmt->execute(array($_POST['id']));

  $session->addMessage('success', "Utilizador removido de Admin");
  die(header('Location: ../index.php'));

?>