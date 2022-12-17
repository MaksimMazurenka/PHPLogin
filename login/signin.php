<?php
session_start();
require_once '../entity/CRUD.php';
require_once '../entity/User.php';


$login = $_POST['login'];
$password = $_POST['password'];

$error_fields = [];

$database = new CRUD();
$password1 = md5($password . "соль");
$us = new User($login,$password1);
$check_user = $database->getUserByLogin($login);

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
if($password==""){
    $error_fields[] = 'password';
    $response = [
        "status" => false,
        "type" => 2,
        "message" => "password field is required",
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

if ($database->checkPassword($us)==0 || $check_user == null) {
    $error_fields[] = 'login';
    $error_fields[] = 'password';
    $response = [
        "status" => false,
        "type" => 2,
        "message" => "Invalid username or password",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}else{
    setcookie ('login',$login,time()+3600, '/');
    $_COOKIE['login'] = $login;
    $_SESSION['user'] = [
        "name" => $check_user->name
    ];
    $response = [
        "status" => true,
    ];
    echo json_encode($response);
}
?>
