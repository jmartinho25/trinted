<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/classes/session.class.php');
    require_once(dirname(__DIR__).'/database/connection.db.php');
    require_once(dirname(__DIR__).'/utils/validation.php');
    $session = new Session();

    $db = getDatabaseConnection();
    $stmt = $db->prepare('SELECT Seller_id FROM Products   
    WHERE ProductId = ? AND Seller_id = ?');
    $stmt->execute(array($_GET['id'], $_SESSION['id']));
    $ok = $stmt->fetchAll();

    if(!$ok){
        $session->addMessage('error', "Apenas o vendedor pode adicionar uma foto ao produto");
    }

    if($_FILES['image']['tmp_name'][0] == ""){
        $session->addMessage('warning', "Selecione a foto");
        die(header('Location: ../newProductPage.php'));
    }

    $file_path="../resources/images/products/".$_GET['id']."_01.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $file_path);

    $session->addMessage('success', 'Atualização da foto efetuada com sucesso');

    header("Location: ../productPage.php?id=" . $_GET['id']);

?>