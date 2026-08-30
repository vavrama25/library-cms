<?php

require_once('../lib/include.php'); 
session_start(); 

if (isset($_GET['book_id']) AND isset($_SESSION['user']) AND isset($_GET['id'])) {
    $book_id = $_GET['book_id'];
    $ID_cms_user_orders = $_GET['id'];
    $user = $_SESSION['user'];

    $userInfo = getUserInfo($user);

    $userId = $userInfo[0]['ID_login'];



    $BookDetail = getSpecificBorrowedBookById($ID_cms_user_orders);

    if ($BookDetail[0]['user_id'] !== $userId AND !isAdmin($_SESSION['user'])) {
        header("Location: " . url('/'));
        exit();
    }

    if ($BookDetail[0]['status'] !== 'borrowed') {
        header("Location: " . url('/'));
        exit();
    }
    returnBook($book_id, $userId, $ID_cms_user_orders);

    if (isAdmin($_SESSION['user']) && $BookDetail[0]['user_id'] != $userId) {
        header("Location: " . url("/admin/borrowed?filter=returned"));
        exit();
    } 
    

    header("Location: " . url("/history"));
    exit();

} elseif (isset($_GET['lost_book_id']) AND isset($_SESSION['user']) AND isset($_GET['id'])) {
    $book_id = $_GET['book_id'];
    $ID_cms_user_orders = $_GET['id'];
    $user = $_SESSION['user'];

    $userInfo = getUserInfo($user);

    $userId = $userInfo[0]['ID_login'];

    $BookDetail = getSpecificBorrowedBookById($ID_cms_user_orders);

    if ($BookDetail[0]['user_id'] !== $userId AND !isAdmin($_SESSION['user'])) {
        header("Location: " . url('/'));
        exit();
    }

    if ($BookDetail[0]['status'] !== 'borrowed') {
        header("Location: " . url('/'));
        exit();
    }

    lostBook($book_id, $userId, $ID_cms_user_orders);


    if (isAdmin($_SESSION['user']) && $BookDetail[0]['user_id'] != $userId) {
        header("Location: " . url("/admin/borrowed?filter=lost"));
        exit();
    } 
    

    header("Location: " . url("/history"));
    exit();

} else {
    header("Location: " . url('/'));
    exit();
}





?>