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

    $_SESSION['input']['name newProduct']=htmlentities($_POST['name']);
    $_SESSION['input']['category newProduct']=htmlentities($_POST['category']);
    $_SESSION['input']['brand newProduct']=htmlentities($_POST['brand']);
    $_SESSION['input']['size newProduct']=htmlentities($_POST['size']);
    $_SESSION['input']['condition newProduct']=htmlentities($_POST['condition']);
    $_SESSION['input']['description newProduct']=htmlentities($_POST['description']);
    $_SESSION['input']['price newProduct']=htmlentities($_POST['price']);

    if(!(valid_ProductName($_POST['name']) && valid_brand($_POST['brand'])&& valid_description($_POST['description'])&&valid_price($_POST['price'])&&valid_CSRF($_POST['csrf']))){
        die(header('Location: ../newProductPage.php'));
    }

    $db=getDatabaseConnection();
    $stmt=$db->prepare('INSERT INTO Products (ProductName,Category,Brand,Size,Condition,Product_description,Price,Seller_id) VALUES(?,?,?,?,?,?,?,?)');
    $stmt->execute(array($_POST['name'],$_POST['category'],$_POST['brand'],$_POST['size'],$_POST['condition'],$_POST['description'],$_POST['price'],$_SESSION['id']));

    unset($_SESSION['input']);

    $session->addMessage('success', 'Produto registado com sucesso');
    header('Location: ../index.php');
?>