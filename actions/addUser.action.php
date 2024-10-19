<?php 
    declare(strict_types=1);
    require_once(dirname(__DIR__).'/database/connection.db.php');
    require_once(dirname(__DIR__).'/classes/session.class.php');
    require_once(dirname(__DIR__).'/utils/validation.php');
    $session =new Session();

    $_SESSION['input']['userName newUser']= htmlentities($_POST['userName']);
    $_SESSION['input']['email newUser']=  htmlentities($_POST['email']);
    $_SESSION['input']['password1 newUser']= htmlentities($_POST['password1']);
    $_SESSION['input']['password2 newUser']= htmlentities($_POST['password2']);
    $_SESSION['input']['firstName newUser']= htmlentities($_POST['firstName']);
    $_SESSION['input']['lastName newUser']= htmlentities($_POST['lastName']);
    $_SESSION['input']['userAddress newUser']= htmlentities($_POST['userAddress']);
    $_SESSION['input']['phone newUser']= htmlentities($_POST['phone']);
    
    if(!(valid_username($_POST['userName']) && valid_email($_POST['email'])
    && valid_name($_POST['firstName']) && valid_name($_POST['lastName']) && valid_address($_POST['userAddress']) && valid_number($_POST['phone']))){
        die(header('Location: ../registerPage.php'));
    }

    $db = getDatabaseConnection();
    if( $_POST['password1'] === $_POST['password2']){
        if(!valid_password($_POST['password1'])){
            die(header('Location: ../registerPage.php'));
        }
        $stmt = $db->prepare('INSERT INTO Users (UserName, UserPassword, FirstName, LastName, Email, User_address, PhoneNumber) VALUES (?,?,?,?,?,?,?)');
        $stmt->execute(array($_POST['userName'],password_hash($_POST['password1'], PASSWORD_DEFAULT), $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['userAddress'], $_POST['phone']));
    } else{
        $session->addMessage('warning', "As palavras-passe devem coincidir");
        die(header('Location: ../registerPage.php'));
    }
    unset($_SESSION['input']);
    $a=$_POST['phone'];
    $session->addMessage('success', "Registo efetuado com sucesso");
    header('Location: ../loginPage.php');
?>