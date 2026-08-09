<?php

require_once('../lib/include.php'); 
session_start(); 

if (isset($_GET['title'])) {    
    $id = $_GET['title'];
    if (isset($_POST['email']) AND isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        bookOrder($email, $password, $id);
    }
    $detail = getBookDetail($id);
} else {
    header("Location: " . url('/'));
}





?>