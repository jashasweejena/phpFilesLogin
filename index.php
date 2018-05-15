<?php

include_once 'user.php';

$username = "";
$email = "";
$password = "";

if(isset($_POST['username'])) {
    $username = $_POST['username'];
}

if(isset($_POST['email'])) {
    $email = $_POST['email'];
}

if(isset($_POST['password'])) {
    $password = password;
}

$userLogin = new User();

//registration
if(!empty($username) && !empty($email) && !empty($password)) {
    $md5_pass = md5($password);
    $login = $userLogin->createNewRegisterUser($username, $password, $email);
    echo json_encode($login);
}

//login
if(!empty($username) && !empty($email) && empty($password)) {
    $md5_pass = md5($password);
    $login = $userLogin->loginUser($username, $password);
    echo json_encode($login);
    echo "fsbdkhjfbd";
}

?>