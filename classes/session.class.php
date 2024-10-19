<?php
class Session{

    private array $messages;

    public function __construct(){
        session_start();
        if(!isset($_SESSION['csrf'])){
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }
        $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages']:array();
        unset($_SESSION['messages']);
    }

    public function LoggedIn():bool{
        return isset($_SESSION['id']);
    }

    public function Logout(){
        session_destroy();
    }

    public function GetMessages(){
        return $this->messages;
    }

    public function addMessage(string $type, string $text){
        $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
    }

    

}
?>