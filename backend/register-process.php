<?php
session_start();
include_once("../lib/include.php");
global $db;

if (isset($_POST['email'], $_POST['password'], $_POST['password-confirm'])) {
    #dostal jsi se sem pres register
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password-confirm'];
    
    $_SESSION['user'] = $email;


    if ($password !== $password_confirm){
        header('Location: ' . url('/register?PasswordsDoNotMatch'));
        exit;
    } else {
        if (passVerify($password) !== "OK") {
            header('Location: ' . url('/register?PasswordTooWeak'));
            exit;        
        } 
    }

    if (emailVerify($email)) {
        #email je v pohode
        if (duplicateVerify($db, $email) == "OK"){
            #email je v pohode a neni to duplikat
            $hash = customHash($password, $email);
            importToDb($db, $hash, $email);
            header("Location: " . url('/login?regSucess'));
        } else {
            #email je duplikat
            if (!isActive($db, $email)) {
                ################################################################aktivace uctu ktery uz byl smazan
            }
            header("Location: " . url('/login'));
        }
    } else {
        #email neni v pohode
        duplicateVerify($db, $email);
        header("Location: " . url('/register?emailNotVerified'));
    }

} else {
    header("Location: " . url("/register?error=DoNotTryToAccessBackendByYourSelf"));
}

?>