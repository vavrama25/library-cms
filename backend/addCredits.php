<?php
global $db;

require_once('../lib/include.php'); 
session_start(); 

if (isset($_COOKIE['PHPSESSID']) AND isset($_SESSION[$_COOKIE['PHPSESSID']]) AND !empty($_SESSION[$_COOKIE['PHPSESSID']]) AND $_SESSION[$_COOKIE['PHPSESSID']] !== "LogedOut" AND isset($_SESSION['user']) AND isset($_POST['creditsBought']) AND isset($_POST['password'])) {
    $user = $_SESSION['user'];
    $password = $_POST['password'];
    $creditsBought = $_POST['creditsBought'];
} else {
    header("Location: " . url('/login'));
}

if ($creditsBought <= 0) {
    header("Location: " . url('/credits?invalidCreditAmount'));
    exit();
}

$userInfo = getUserInfo($user);

$hash = customHash($password, $user);
if ($hash == getHash($db, $user)) {
    addCredits($user, $creditsBought);  
    header("Location: " . url("/credits?creditsAdded")); 

} else {
    header("Location: " . url("/credits?wrongPass"));
}   

?>