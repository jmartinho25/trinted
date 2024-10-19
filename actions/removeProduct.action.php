<?php
    declare(strict_types=1);
    require_once(dirname(__DIR__).'/database/connection.db.php');
    require_once(dirname(__DIR__).'/classes/session.class.php');
    require_once(dirname(__DIR__).'/utils/validation.php');
    require_once(dirname(__DIR__).'/classes/product.class.php');
    $session = new Session();

    if (!$session->LoggedIn()) {
        $session->addMessage('error', "Ação não disponível");
        die(header('Location: ../index.php'));
    } 

    

    $id = intval($_GET['id']); 

    $db = getDatabaseConnection();

    $product=Product::getProduct($db,$id);

    $image="..".$product->getPhoto($id);

    if ($image!="../resources/images/products/produto.jpg") {
        if(unlink($image)); 
    }

    // Prepara e executa a query para remover o produto
    $stmt = $db->prepare('DELETE FROM Products WHERE ProductId = ?');
    $stmt->execute([$id]);

    // Verifica se o produto foi removido com sucesso
    if ($stmt->rowCount() > 0) {
        $session->addMessage('success', "Produto removido com sucesso");
    } else {
        $session->addMessage('error', "Falha ao remover produto");
    }

    // Redireciona de volta para a página anterior
    header('Location: /index.php');
?>