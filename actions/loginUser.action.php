<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/database/connection.db.php');
    require_once(dirname(__DIR__).'/utils/validation.php');
    require_once(dirname(__DIR__).'/classes/user.class.php');
    require_once(dirname(__DIR__).'/classes/session.class.php');

    $session = new Session();

    $_SESSION['input']['email login']= htmlentities($_POST['email']);
    $_SESSION['input']['password login']= htmlentities($_POST['password']);

    if(!(valid_email($_POST['email']))||!valid_password($_POST['password'])){
        unset($_SESSION['input']['password login']);
        die(header('Location: ../loginPage.php'));
    }

    $db=getDatabaseConnection();
    $user=User::getUserByEmail($db,$_POST['email'],$_POST['password']);
    /*var_dump($user);
    die();*/

    if($user){
        $_SESSION['id']=$user->id;
        $_SESSION['name']=$user->getName();
        $_SESSION['photo']=$user->getPhoto($user->id);

        unset($_SESSION['input']['email login']);
        unset($_SESSION['input']['password login']);

        $session->addMessage('success', "Login efetuado com sucesso. Bem-vindo, " . $user->getName() . "!");

        header('Location: ../index.php');
    }else {
        $session->addMessage('error', "Email ou password errados!");
        unset($_SESSION['input']['password login']);
        die(header('Location: ../loginPage.php'));
    }
?>