<?php

session_start();
require_once '../entity/CRUD.php';
require_once '../entity/User.php';

$name = $_POST['name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$Crud = new CRUD();

$error_fields = [];

if($login==""){
    $error_fields[] = 'login';
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Login field is required",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}
if(strlen($login)<6){
    $error_fields[] = 'login';
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Login field min length 6",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}
if(!preg_match("#^[a-zA-Z0-9]+$#", $login)){
    $error_fields[] = 'login';
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Login can contain only letters and numbers",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}
if ($Crud->getUserByLogin($login) !=  null) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Such login already exist",
        "fields" => ['login']
    ];
    echo json_encode($response);
    die();
}
if($password==""){
    $error_fields[] = 'password';
    $response = [
        "status" => false,
        "type" => 2,
        "message" => "Password field is required",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}
if(strlen($password)<6){
    $error_fields[] = 'password';
    $response = [
        "status" => false,
        "type" => 2,
        "message" => "Password field min length 6",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}
if(!preg_match("#^[a-zA-Z0-9£$%&*()}{@?><>,|=_+¬-]+$#", $password)){
    $error_fields[] = 'password';
    $response = [
        "status" => false,
        "type" => 2,
        "message" => "Pasword can contain only letters, numbers and £$%&*()}{@?><>,|=_+¬- symbols",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}
if ($password != $password_confirm) {
    $error_fields[] = 'password_confirm';
    $error_fields[] = 'password';
    $response = [
        "status" => false,
        "type" => 5,
        "message" => "Passwords don't match",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}
if($email==""){
    $error_fields[] = 'email';
    $response = [
        "status" => false,
        "type" => 3,
        "message" => "Email field is required",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error_fields[] = 'email';
    $response = [
        "status" => false,
        "type" => 3,
        "message" => "Wrong email format",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}
if ($Crud->getUserByEmail($email) !=  null) {
    $response = [
        "status" => false,
        "type" => 3,
        "message" => "Such email already exist",
        "fields" => ['email']
    ];
    echo json_encode($response);
    die();
}
if($name===""){
    $error_fields[] = 'name';
    $response = [
        "status" => false,
        "type" => 4,
        "message" => "Name field is required",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}
if(strlen($name)<2){
    $error_fields[] = 'name';
    $response = [
        "status" => false,
        "type" => 4,
        "message" => "Name field min length 2",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}
if(!preg_match("#^[a-zA-Z]+$#", $name)){
    $error_fields[] = 'name';
    $response = [
        "status" => false,
        "type" => 4,
        "message" => "Name can contain only letters",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}

if ($password === $password_confirm) {
    $password = md5($password . "соль");
    $New_User = new User($login,$password,$email,$name);
    $Crud->setUser($New_User);
    $response = [
        "status" => true,
        "message" => "Success",
    ];
    echo json_encode($response);
}
?>
