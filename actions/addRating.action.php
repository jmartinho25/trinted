<?php
declare(strict_types=1);

require_once(dirname(__DIR__).'/database/connection.db.php');
require_once(dirname(__DIR__).'/utils/validation.php');
require_once(dirname(__DIR__).'/classes/user.class.php');
require_once(dirname(__DIR__).'/classes/product.class.php');
$session=new Session();

if (!isset($_POST['rating'], $_POST['id'])) {
    $session->addMessage('error', "Ação não disponível");
    header('Location: ../productPage.php?id=' . $_POST['id']);
}

// Validate the rating
if (!valid_rating($_POST['rating'])) {
    // Redirect back to the product page with an error message if the rating is invalid
    $session->addMessage('error', "Classificação inválida");
    header('Location: ../productPage.php?id=' . $_POST['id'] . '&error=invalid_rating');
}

$id = $_POST['id'];
$rating = $_POST['rating'];


$db = getDatabaseConnection();

$product=Product::getProduct($db,intval($id));
$user=User::getUser($db, $product->seller_id);

$stmt = $db->prepare('UPDATE Purchase SET Rating = ? WHERE ProductId = ?');
$stmt->execute([$rating, $id]);

$stmt = $db->prepare('UPDATE Users SET User_rating = ? WHERE UserId=?');
$stmt->execute([$user->getUserRating(),$user->id]);

$session->addMessage('success', "Classificação adicionada com sucesso");
header('Location: ../productPage.php?id=' . $id);

