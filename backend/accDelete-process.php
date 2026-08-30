<?php
include_once('../lib/include.php'); 
session_start();

global $db;
loginCheck();

if (isset($_POST['password']) && $_POST['password'] !== '') {
    $email = $_SESSION['user'];
    $password = $_POST['password'];


    $hash = customHash($password, $email);
    if ($hash == getHash($db, $email)) {
        #zadal spravne mazeme acc  
        deleteAcc($db, $email);
        session_destroy();
        header("Location: " . url('/?delWasSuccessful'));        
    } else {
        #zadal spatne 
        header("Location: " . ('/accDelete?delNotSuccessful'));
    }
} else {
    header("Location: " . url("/accDelete"));
}
?>