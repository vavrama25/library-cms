<?php
session_start();
include_once("../lib/include.php");
global $db;
if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $_SESSION['user'] = $email;

    if (duplicateVerify($db, $email) !== "OK"){
        #email je duplikat
        if (isActive($db, $email)) {
            $hash = customHash($password, $email);
            if ($hash == getHash($db, $email)) {
                $_SESSION[$_COOKIE['PHPSESSID']] = 'logged in';
                header("Location: ../index.php");           
            } else {
                header("Location: " . url("/login?smtIsWrong"));
            }   
        } else {
            header("Location: " . url("/login.php"));
        }
    } else {
        #email neni to duplikat
        header("Location: " . url("/login.php"));
    }
}
?>