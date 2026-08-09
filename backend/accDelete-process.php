<?php
session_start();
include_once("../lib/include.php");
global $db;
loginCheck();
checkInactivity();

if (isset($_POST['password']) AND !empty($_POST['password'])) {
    $email = $_SESSION['user'];
    $password = $_POST['password'];


    $hash = customHash($password, $email);
    if ($hash == getHash($db, $email)) {
        #zadal spravne mazeme acc  
        deleteAcc($db, $email);
        session_destroy();
        header("Location: ../index.php?delWasSuccessful");        
    } else {
        #zadal spatne 
        header("Location: ../public/acc-delete.php?delNotSuccessful");
    }
} else {
    header("Location: ../public/acc-delete.php");
}
?>