<?php

require_once('lib/include.php'); 
session_start(); 

if (isset($_COOKIE['PHPSESSID']) AND isset($_SESSION[$_COOKIE['PHPSESSID']]) AND !empty($_SESSION[$_COOKIE['PHPSESSID']]) AND $_SESSION[$_COOKIE['PHPSESSID']] !== "LogedOut" AND isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("Location: " . url('/login'));
    exit();
}

$userInfo = getUserInfo($user);
$user_id = $userInfo[0]['ID_login'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>History</title>

</head>
<body>
    <?php 
    publicPageHeader();
    ?>
    <main class="container py-5">
        <?php 
                
        if (isset($_GET['TooManyBooks'])) {
            echo '
                <div class="float-left col-xl-12 col-md-6 mt-3 mb-4">
                    <div class="text-center row no-gutters align-items-center">
                        <div class=" bg-danger rounded p-2 h5 mb-0 font-weight-bold text-gray-800">You have reached the limit of borrowed books (' . getBooksBorrowedLimit() . ') You can borrow more after you return some.</div>
                    </div>
                </div>
            ';
        }

        listBorrowedContent($user_id); 
        ?>
    </main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>