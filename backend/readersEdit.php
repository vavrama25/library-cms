<?php
require_once('../lib/include.php'); 
session_start(); 
global $db;
if (isset($_COOKIE['PHPSESSID']) AND isset($_SESSION[$_COOKIE['PHPSESSID']]) AND !empty($_SESSION[$_COOKIE['PHPSESSID']]) AND $_SESSION[$_COOKIE['PHPSESSID']] !== "LogedOut" AND isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("Location: " . url('/login'));
    exit;
}


if (isset($_GET['action']) AND $_GET['action'] == 'edit') {

    if (isset($_POST['users']) && is_array($_POST['users'])) {
        $post = $_POST['users'];
    } else {
        header("Location: " . url('/admin/readers'));
        exit();
    }

    $AllowedRoles = ['user', 'worker', 'admin'];

    foreach ($post as $ID_login => $value) {
        foreach ($value as $key => $value) {
            if ($key == "role") {

                if (!in_array($value, $AllowedRoles)) {
                    header("Location: " . url('/admin/readers?error=badRoleValue'));
                    exit();
                } else {
                    $role = $value;
                }
            } elseif ($key == "credits") {
                if ($value >= 0 AND $value < 9999) {
                    $credits = $value;
                } else {
                    header("Location: " . url("/admin/readers?error=badCreditsValue"));
                    exit();
                }
            }
            
        }

    bulkUsersUpdate($role, $credits, $ID_login);

    }


    header("Location: " . url('/admin/readers?success'));
    exit();
} elseif (isset($_GET['action']) AND $_GET['action'] == 'delete') {


    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];
    } else {
        header("Location: " . url('/admin/readers'));
        exit();
    }
    $userInfo = getUserInfoById($user_id);
    $userEmail = $userInfo[0]['email'];
    deleteAcc($db, $userEmail);
    header("Location: " . url('/admin/readers?success'));
}


?>