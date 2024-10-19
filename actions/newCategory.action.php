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
  $stmt = $db->prepare('SELECT * FROM Categories WHERE CategoryName= ?');
  $stmt->execute(array($_POST['name']));

  if(!valid_category($_POST['name'])){
    die(header('Location: ../sellerPage.php?='.$_SESSION['id']));
  }

  $a = $stmt->fetch();
  if (!$a) {

    $stmt = $db->prepare('INSERT INTO Categories(CategoryName) VALUES (?)'); 
    $stmt->execute(array($_POST['name']));
  }

  $session->addMessage('success', "Categoria adicionada com sucesso");
  die(header('Location: ../index.php'));
  
?>