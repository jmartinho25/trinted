<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/classes/session.class.php');
    require_once(dirname(__DIR__).'/database/connection.db.php');
    require_once(dirname(__DIR__).'/utils/validation.php');
    require_once(dirname(__DIR__).'/classes/user.class.php');
    $session = new Session();

    $db=getDatabaseConnection();
    $user=User::getUser($db, intval($_GET['id']));

    if(!$session->LoggedIn()){
        $session->addMessage('error', 'Necessário estar logado para acessar esta página');
        die(header('Location: ../index.php'));
    }

    if(!valid_CSRF($_POST['csrf'])){
        die(header('Location: ../index.php'));
    }

    if($_FILES['image']['tmp_name'][0]==""){
        $session->addMessage('warning', 'Nenhuma foto selecionada');
        die(header("Location: ../editUserPage.php"));
    }

    $file_path="../resources/images/users/".$_GET['id'].".jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $file_path);
    
    $_SESSION['photo']=$user->getPhoto(intval($_GET['id']));
    $session->addMessage('success', 'Atualização da foto efetuada com sucesso');

    header("Location: ../sellerPage.php?id=" . $_GET['id']);

?>