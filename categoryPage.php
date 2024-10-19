<?php
  declare(strict_types = 1);


  require_once('database/connection.db.php');
  require_once('classes/product.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/product.tpl.php');
  require_once('classes/session.class.php');

  $session=new Session();

  $db = getDatabaseConnection();

    $name=$_GET['name'];
    
    $products=Product::getProductsByCategory($db, $name);

  drawHeader();
  drawProducts($products,$name);
  drawFooter();

?>
            
          
        