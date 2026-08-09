<?php 
include_once("lib/include.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="config/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="form-wrapper">
        <h1 class="h1">Register</h1>
        <form class="form" action="backend/register-process.php" method="post">

            <label for="email">Email</label><br>
            <input class="input" <?php emailPrefill(); ?> type="email" name="email" id="email" placeholder="Email..."><br>

            <label for="password">Password</label><br>
            <input class="input" type="password" name="password" id="password" placeholder="Password..."><br>


            <label for="password-confirm">Password Confirmation</label><br>
            <input class="input" type="password" name="password-confirm" id="password-confirm" placeholder="Password Confirmation..."><br>

            <button type="submit">Submit</button>
                
        </form>
        <a href="login">Login</a>
    </div>
    <p class='info'>A password must contain at least 12 characters, a number and one special character</p>

    <?php 

        if (isset($_GET['PasswordsDoNotMatch'])) {
            echo "<p class='error'>Passwords are not matching</p>";
        }
        if (isset($_GET['emailNotVerified'])) {
            echo "<p class='error'>There is a mistake in yor email</p>";
        }
        if (isset($_GET['PasswordTooWeak'])) {
            echo "<p class='error'>Password does not meet the requirments</p>";
        }

    ?>
</body>
</html>


