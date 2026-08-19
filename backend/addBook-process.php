<?php

include_once('../lib/include.php'); 
session_start(); 

if (isset($_COOKIE['PHPSESSID']) AND isset($_SESSION[$_COOKIE['PHPSESSID']]) AND !empty($_SESSION[$_COOKIE['PHPSESSID']]) AND $_SESSION[$_COOKIE['PHPSESSID']] !== "LogedOut" AND isset($_SESSION['user']) AND isAdmin($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("Location: " . url('/login'));
    exit();
}

$_SESSION['form_data'] = $_POST;

if (
    isset($_POST['bookTitle']) AND trim($_POST['bookTitle']) !== '' AND
    isset($_POST['Autor']) AND trim($_POST['Autor']) !== '' AND
    isset($_POST['Genre']) AND trim($_POST['Genre']) !== '' AND
    isset($_POST['forma']) AND trim($_POST['forma']) !== '' AND
    isset($_POST['Description']) AND trim($_POST['Description']) !== '' AND
    isset($_POST['imgLink']) AND trim($_POST['imgLink']) !== '' AND
    isset($_POST['price']) AND is_numeric($_POST['price'])
) {
    // Všechna data byla v pořádku poslána a nejsou prázdná
    $bookTitle = $_POST['bookTitle'];
    $autor = $_POST['Autor'];
    $genre = $_POST['Genre'];
    $form = $_POST['forma'];
    $description = $_POST['Description'];
    $imgUrl = $_POST['imgLink'];
    $price = $_POST['price'];



} else {
    header("Location: " . url('/admin/addBook&error=missingFields'));
    exit();
}

$allowedForms = ['beletrie', 'naucna'];
if (!in_array($_POST['forma'], $allowedForms, true)) {
    header("Location: " . url('/admin/addBook&error=BadSelect'));
    exit();
}
if (mb_strlen($_POST['bookTitle']) > 100 || mb_strlen($_POST['Autor']) > 100 || mb_strlen($_POST['Description']) > 1000) {
    header("Location: " . url('/admin/addBook&error=TextTooLong'));
    exit();
}
$price = filter_var($_POST['price'], FILTER_VALIDATE_INT);
if ($price === false || $price < 0 || $price > 999999) {
    header("Location: " . url('/admin/addBook&error=FalsePrice'));
    exit();
}

$booksCount = checkDuplicateContant($autor, $bookTitle);

if ($booksCount > 0) {
    header("Location: " . url('/admin/addBook&error=BookDuplicate'));
    exit();
}

addBookToDb($bookTitle, $autor, $genre, $form, $description, $imgUrl, $price);

header("Location: " . url('/'));

?>