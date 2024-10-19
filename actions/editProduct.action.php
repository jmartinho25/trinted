<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/database/connection.db.php');
    require_once(dirname(__DIR__).'/classes/session.class.php');
    require_once(dirname(__DIR__).'/utils/validation.php');
    require_once(dirname(__DIR__).'/classes/product.class.php');
    $session = new Session();

    if (!$session->LoggedIn()) {
        $session->addMessage('error', "Ação não disponível");
        die(header('Location: ../denied.php'));
    }
    
    $_SESSION['input']['name oldProduct']=htmlentities($_POST['name']);
    $_SESSION['input']['category oldProduct']=htmlentities($_POST['category']);
    $_SESSION['input']['brand oldProduct']=htmlentities($_POST['brand']);
    $_SESSION['input']['size oldProduct']=htmlentities($_POST['size']);
    $_SESSION['input']['condition oldProduct']=htmlentities($_POST['condition']);
    $_SESSION['input']['description oldProduct']=htmlentities($_POST['description']);
    $_SESSION['input']['price oldProduct']=htmlentities($_POST['price']);

    $id=intval($_GET['id']);
    $db=getDatabaseConnection();
    $product=Product::getProduct($db, $id);

    if($product){
        if(!(valid_ProductName($_POST['name']) && valid_brand($_POST['brand'])&& valid_description($_POST['description'])&&valid_price($_POST['price'])&&valid_CSRF($_POST['csrf']))){
            unset($_SESSION['input']);
            die(header('Location: ../editProductPage.php?id='.$id));
        }
    
        $product->name=$_POST['name'];
        $product->category=$_POST['category'];
        $product->brand=$_POST['brand'];
        $product->size=$_POST['size'];
        $product->condition=$_POST['condition'];
        $product->description=$_POST['description'];
        $product->price=(float)$_POST['price'];
        $product->save($db);
    
        unset($_SESSION['input']);
        $session->addMessage('success', 'Produto editado com sucesso');
        die(header('Location: ../productPage.php?id='.$id));
    }

    

    $session->addMessage('error', 'Não tem permissões necessárias para editar o porduto em questão');
    header('Location: ../product.php?id='.$_GET['id']);
?>