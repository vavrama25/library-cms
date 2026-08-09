<?php
session_start();
include_once("../lib/include.php");
loginCheck();
checkInactivity();
global $db;
if (!isAdmin($db, $_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../secured_page/config/styles.css">
</head>
<body>
    <h1>Admin Panel</h1>
    <h2>Active users</h2>
    <?php
        $data1 = activeUsersTable($db);

        usersTableGen($data1);
    ?>
    <h2>Deleted users</h2>
    <?php
        $data2 = deletedUsersTable($db);

        usersTableGen($data2);
    ?>
    <a href="../secured_page/form.php">back</a>
</body>
</html>