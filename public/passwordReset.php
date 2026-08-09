<?php
session_start();
include_once("lib/include.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <?php
        if (isset($_SESSION["token"]) AND isset($_SESSION['user'])) {

            $email = $_SESSION['user'];
            $tokenPost = $_SESSION["token"];

            if (tokenMatch($tokenPost, $email, $db)) {
                ResetPassForm($email);
                if (isset($_GET['PasswordsDoNotMatch'])) {
                    echo "Password do not match";
                } elseif (isset($_GET['PasswordTooWeak'])) {
                    echo "Password Too weak";
                }
            }
             else {
                header("Location: index.php");
            }
        } else {
            echo "email is not set";
            header("Location: index.php");
        }
    ?>
    
</body>
</html>