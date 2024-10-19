<?php
  declare(strict_types = 1);
  require_once(dirname(__DIR__).'/database/connection.db.php');
  require_once(dirname(__DIR__).'/classes/product.class.php');
  require_once(dirname(__DIR__).'/classes/session.class.php');
  $session = new Session();

  $db = getDatabaseConnection();

  $products = Product::search($db, $_GET['search'], $_GET['type']);

  echo json_encode($products);
?>