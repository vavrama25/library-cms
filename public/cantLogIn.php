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
    <title>Cant log in</title>
</head>
<body>
    <div class="form-wrapper">
        <h1 class="h1">Cant log in</h1>
        <p class='info'>Give us your email and we will send you a restore link</p>
        <form class="form" action="backend/cantLogin-process.php" method="post">

            <label for="email">Email</label><br>
            <input class="input" type="email" name="email" id="email" placeholder="Email..."><br>
            <button type="submit">Submit</button>
                
        </form>
        <?php


    
        if (isset($_GET['emailInvalid'])) {
            echo "<p class='error'>Email is not valid</p>";
        }
        if (isset($_GET['emailAlredySent'])) {
            echo "<p class='error'>Email has been sent alredy</p>";
        }
        ?>
    </div>
</body>
</html>