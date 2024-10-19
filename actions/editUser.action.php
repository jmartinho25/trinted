<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/database/connection.db.php');
    require_once(dirname(__DIR__).'/classes/session.class.php');
    require_once(dirname(__DIR__).'/utils/validation.php');
    require_once(dirname(__DIR__).'/classes/user.class.php');

    $session=new Session();

    $_SESSION['input']['userName oldUser']= htmlentities($_POST['userName']);
    $_SESSION['input']['email oldUser']=  htmlentities($_POST['email']);
    $_SESSION['input']['password1 oldUser']= htmlentities($_POST['password1']);
    $_SESSION['input']['password2 oldUser']= htmlentities($_POST['password2']);
    $_SESSION['input']['firstName oldUser']= htmlentities($_POST['firstName']);
    $_SESSION['input']['lastName oldUser']= htmlentities($_POST['lastName']);
    $_SESSION['input']['userAddress oldUser']= htmlentities($_POST['userAddress']);
    $_SESSION['input']['phone oldUser']= htmlentities($_POST['phone']);

    if(!(valid_username($_POST['userName']) && valid_email($_POST['email'])
    && valid_name($_POST['firstName']) && valid_name($_POST['lastName']) && valid_address($_POST['userAddress']) && valid_number($_POST['phone']))){
        die(header('Location: ../registerPage.php'));
    }

    $id=intval($_GET['id']);
    $db=getDatabaseConnection();
    $user=User::getUser($db,$id);

    if($user){

        if(!(valid_username($_POST['userName']) && valid_email($_POST['email'])
        && valid_name($_POST['firstName']) && valid_name($_POST['lastName']) && valid_address($_POST['userAddress']) && valid_number($_POST['phone']))){
            die(header('Location: ../registerPage.php'));
        }

            $user->userName=$_POST['userName'];
            $user->email=$_POST['email'];
            $user->irstName=$_POST['firstName'];
            $user->lastName=$_POST['lastName'];
            $user->address=$_POST['userAddress'];
            $user->phoneNumber=$_POST['phone'];

            if($_POST['password1']!="" && password_verify($_POST['password1'], $user->password)){
                if(!valid_password($_POST['password2'])){
                    $session->addMessage('warning', "Password nova não é válida");
                    die(header('Location: ../EditUserPage.php?id='.$user->id));
                }else{
                    $user->password=password_hash($_POST['password2'], PASSWORD_DEFAULT);
                }
            } else if($_POST['password1']!="" && !password_verify($_POST['password1'], $user->password)){
                $session->addMessage('warning', "A password antiga não corresponde");
                die(header('Location: ../EditUserPage.php?id='.$user->id));
            }
            $a=$user->address;
            $user->save($db);


            $_SESSION['name']=$user->getName();
            $_SESSION['photo']=$user->getPhoto($user->id);

            unset($_SESSION['input']);
            $session->addMessage('success', "Dados alterados com sucesso");
            die(header('Location: ../sellerPage.php?id='.$user->id));
    }

    $session->addMessage('error', 'Não tem permissões necessárias para editar o porduto em questão');
    header('Location: ../sellerPage.php?id='.$_GET['id']);
?>
    