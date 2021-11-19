<?php

require 'includes/config.php';
require 'includes/connect.php';

// Login form
if(isset($_POST['submitLog'])){
    if (!empty($_POST['userName']) && !empty($_POST['userPassword'])) {
        $username = htmlspecialchars(trim($_POST['userName']));
        $password = htmlspecialchars(trim($_POST['userPassword']));
    } else {
        header('Location:login.php?error=missingInput');
        exit();
    }
}

try {
    $verifUsername = "SELECT * FROM user WHERE username = :userName LIMIT 1";
    $reqVerifUsername = $connexion->prepare($verifUsername);
    $reqVerifUsername->bindValue(':userName', $username, PDO::PARAM_STR);
    $reqVerifUsername->execute();

    $user = $reqVerifUsername->fetch();
   
} catch (PDOException $e) {
    $connexion = null;
    echo 'Erreur : ' . $e->getMessage();
}

if ($user) {

    if (!password_verify($password, $user['password'])) {
        header('Location:login.php?error=passwordNotMatch');
        exit();
    } else {
        $_SESSION['user'] = $user["username"];
        header('Location:index.php?Loginsucces');
        exit();
    }
}

// Register form 

if (isset($_POST['submitSign'])){
    if (!empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['pass2'])) {
    $username = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars($_POST['pass']);
    $password2 = htmlspecialchars($_POST['pass2']);
    
    } else {
        header('Location:login.php?error=missingInput');
    exit();  
    }
}
$verifUsername = "SELECT COUNT(*) FROM user WHERE username = :email";
$reqVerifUsername = $connexion->prepare($verifUsername);
$reqVerifUsername->bindValue(':email', $username, PDO::PARAM_STR);
$reqVerifUsername->execute();

$resultatVerifUsername = $reqVerifUsername->fetchColumn();

if ($resultatVerifUsername > 0) {
    header('Location:login.php?error=usernameExists');
    exit();
}

if ($password !== $password2) {
    header('Location:login.php?error=differentPasswords');
    exit();
}

$password = password_hash($password, PASSWORD_DEFAULT);

$insertUser = "INSERT INTO user (username,password) VALUES (:email,:pass)";
$reqInsertUser = $connexion->prepare($insertUser);

$reqInsertUser->bindValue(':email', $username, PDO::PARAM_STR);
$reqInsertUser->bindValue(':pass', $password, PDO::PARAM_STR);

$resultatInsertUser = $reqInsertUser->execute();

if ($resultatInsertUser) {
    header('Location:index.php?success=loginSuccessful');
    exit();
}