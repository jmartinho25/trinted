<?php
declare(strict_types=1);
require_once(dirname(__DIR__).'/classes/session.class.php');

function valid_username(String $name){ 
    if(!preg_match('/^[A-z0-9_\-]+$/', $name)){ //confirma se o nome que está no input contém caracteres ou espaços em branco
        $session = new Session();
        $session->addMessage('warning', 'Username em formato inválido');
        return false;
    }
    return true;
}

function valid_name(String $name){ 
    if(!preg_match('/^[A-zÀ-ú]+$/', $name)){ //confirma se o nome que está no input contém caracteres ou espaços em branco
        $session = new Session();
        $session->addMessage('warning', 'Nome em formato inválido');
        return false;
    }
    return true;
}

function valid_email(String $email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){ //confirma se o email que está no input é válido, esta função em específico verifica se está de acordo com dois standards (RFC 822 e RFC2822)
        $session = new Session();
        $session->addMessage('warning', 'Email em formato inválido');
        return false;
    }
    return true;
}

function valid_number(String $number){
    if(!preg_match('/^[0-9]{9}+$/', $number)){ //confirma se o número que está no formato certo e contém exatamente 9 caracteres
        $session = new Session();
        $session->addMessage('warning', 'Número em formato inválido');
        return false;
    } 
    return true;
}

function valid_text(String $text){
    if(!preg_match('/^[A-zÀ-ú0-9\s.,!? ]+$/', $text)){ //verifica se o texto contém apenas unicode letters, ou seja, letras do alfabeto e caracteres com acentos 
        $session = new Session();
        $session->addMessage('warning', 'Texto em formato inválido');
        return false;
    }
    return true;
}
function valid_description(String $text){
    if(!preg_match('/^[A-zÀ-ú0-9\s.,!?\n\- ]+$/', $text)){ //verifica se o texto contém apenas unicode letters, ou seja, letras do alfabeto e caracteres com acentos 
        $session = new Session();
        $session->addMessage('warning', 'Descrição em formato inválido');
        return false;
    }
    return true;
}

function valid_condition(String $condition){
    if(!preg_match('/^[A-zÀ-ú\- ]+$/', $condition)){ //confirma se o nome que está no input contém caracteres ou espaços em branco
        $session = new Session();
        $session->addMessage('warning', 'Condição em formato inválido');
        return false;
    }
    return true;
}


function valid_price(String $price){
    if(!preg_match('/^\d+(\.\d{1,2})?$/', $price)){ //verifica se o preço contém apenas números , com no máximo duas casas decimais
        $session = new Session();
        $session->addMessage('warning', 'Preço em formato inválido');
        return false;
    }
    return true;
}

function valid_rating(String $rating){
    if (!preg_match('/^(10|\d+(\.\d+)?)$/', $rating)) { // verifica se o rating contém aapenas números de 0 a 10, com no máximo uma casa decimal
        $session = new Session();
        $session->addMessage('warning', "Classificação em formato inválido");
        return false;
    }
    return true;
}

function valid_password(String $password){

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);

    if (!$uppercase || !$lowercase || !$number || strlen(($password)) < 8) {
        $session = new Session();
        $session->addMessage('warning', "A palavra passe deve conter pelo menos 8 caracteres, ter uma letra maiúscula, uma letra minúscula e um número");
        return false; 
    }
    return true;
}

function valid_CSRF(String $csrf) : bool {
    if ($_SESSION['csrf'] !== $csrf) {
        $session = new Session();
        $session->addMessage('error', "Operação inválida");
        return false;
    }
    return true;
}

function filter_text(String $text) : String {
    return preg_replace ("/[^a-zA-Z0-9\s]/", '', $text);
}

function valid_address(String $name){ 
    if(!preg_match('/^[A-zÀ-ú0-9_\-, ]+$/', $name)){ //confirma se o nome que está no input contém caracteres ou espaços em branco
        $session = new Session();
        $session->addMessage('warning', 'Morada em formato inválido');
        return false;
    }
    return true;
}

function valid_ProductName(String $name){ 
    if(!preg_match('/^[A-zÀ-ú0-9_\-, ]+$/', $name)){ 
        $session = new Session();
        $session->addMessage('warning', 'Nome do produto em formato inválido');
        return false;
    }
    return true;
}

function valid_brand(String $brand){
    if(!preg_match('/^[A-zÀ-ú0-9\- ]+$/', $brand)){
        $session = new Session();
        $session->addMessage('warning', 'Marca do produto em formato inválido');
        return false;
    }
    return true;
}

function valid_size(String $size){ 
    if(!preg_match('/^[A-z0-9-]+$/', $size)){ //confirma se o nome que está no input contém caracteres ou espaços em branco
        $session = new Session();
        $session->addMessage('warning', 'Tamanho em formato inválido');
        return false;
    }
    return true;
}

function valid_category(String $category){
    if(!preg_match('/^[A-zÀ-ú\- ]+$/', $category)){ //confirma se o nome que está no input contém caracteres ou espaços em branco
        $session = new Session();
        $session->addMessage('warning', 'Categoria em formato inválido');
        return false;
    }
    return true;
}


?>