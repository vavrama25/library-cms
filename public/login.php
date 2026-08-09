<?php 
session_start();
include_once("lib/include.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="config/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="form-wrapper">
        <h1 class="h1">Login</h1>

        <form class="form" action="backend/login-process.php" method="post">

            <label for="email">Email</label><br>
            <input class="input" <?php emailPrefill(); ?> type="email" name="email" id="email" placeholder="Email..."><br>

            <label for="password">Password</label><br>
            <input class="input" type="password" name="password" id="password" placeholder="Password..."><br>


            <button type="submit">Submit</button>
                
        </form>
    
        <a href="register">Register</a>
        <a href="cantLogIn">Cant log in</a>
    </div>
    <?php 
    if (isset($_COOKIE["PHPSESSID"])){
        if (isset($_GET['logOut'])) {
            $_SESSION[$_COOKIE["PHPSESSID"]] = "LogedOut";
        }
        if (isset($_GET['regSucess'])) {
            echo "<p class='error'>Registration was a sucess you can now log in</p>"; 
        }
        if (isset($_GET['smtIsWrong'])) {
            echo "<p class='error'>Something went wrong try again</p>"; 
        }    
        if (isset($_GET['emailSent'])) {
            echo "<p class='error'>Email sent succesfully.</p>"; 
        } 
        if (isset($_GET['sessionExpired'])) {
            echo "<p class='error'>Logged out due to inactivity.</p>"; 
        }
    }
    ?>
</body>
</html>


