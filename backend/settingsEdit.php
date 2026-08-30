<?php
require_once('../lib/include.php'); 
session_start(); 
global $db;
if (isset($_COOKIE['PHPSESSID']) AND isset($_SESSION[$_COOKIE['PHPSESSID']]) AND !empty($_SESSION[$_COOKIE['PHPSESSID']]) AND $_SESSION[$_COOKIE['PHPSESSID']] !== "LogedOut" AND isset($_SESSION['user']) AND isAdmin($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("Location: " . url('/login'));
    exit;
}

if (isset($_POST['borrowPeriod']) AND isset($_POST['fine']) AND isset($_POST['booksBorrowLimit']) AND isset($_POST['pageHeading']) AND isset($_POST['logo'])) {
    $borrowPeriod = $_POST['borrowPeriod'];
    $fine = $_POST['fine'];
    $booksBorrowLimit = $_POST['booksBorrowLimit'];
    $pageHeading = $_POST['pageHeading'];
    $logo = $_POST['logo'];
    settingsBulkUpdate($borrowPeriod, $fine, $booksBorrowLimit, $pageHeading, $logo);
    header("Location: " . url('/admin/settings'));
    exit();
} else {
    header("Location: " . url('/admin/settings'));
    exit();
}
?>