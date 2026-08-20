<?php
session_start();
include_once("../lib/include.php");
loginCheck();
checkInactivity();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>account delete</title>
</head>
<body>
<?php
    if (isset($_SESSION['user'])) {
        echo "<h1>Acc delete for $_SESSION[user]</h1>";
        echo '  
        <form action="backend/accDelete-process.php" method="post">
            <div>
                <label for="password">Enter password to delete your account: </label>
                <input type="password" name="password" placeholder="password...">
            </div>
            <div>
                <button type="submit">Delete accout</button>
            </div>
        </form>
        ';
    } elseif (isset($_GET['delNotSuccessful'])) {
        echo "<p class='error'>Deletation was not succesfull</p>";
    } 
    else {
        header("Location: " . url("/login"));
    }
?>      
<a href="accSettings">back</a>

</body>
</html>
