<?php

session_start();
include_once("lib/include.php");

if (isset($_GET['delWasSuccessful'])) {
    echo "<p class='info'>You have deleted your account it no longer exists</p>";
}
if (isset($_COOKIE['PHPSESSID'], $_SESSION['user'])) {
    loginCheck();
    checkInactivity();
    echo "<h1>Settings for $_SESSION[user]</h1>";
    echo "<h2>Account delete</h2>";
    echo "<a href='accDelete'>delete accout</a><br>";
    echo '<a href="' . url('CMS/') . '">back</a>';
    exit;
}

?>  