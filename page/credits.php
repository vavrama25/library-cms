<?php

require_once('lib/include.php'); 
session_start(); 

if (isset($_COOKIE['PHPSESSID']) AND isset($_SESSION[$_COOKIE['PHPSESSID']]) AND !empty($_SESSION[$_COOKIE['PHPSESSID']]) AND $_SESSION[$_COOKIE['PHPSESSID']] !== "LogedOut" AND isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("Location: " . url('/login'));
}

$userInfo = getUserInfo($user);
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
    <title>Credits</title>
    <!-- Custom fonts for this template -->
    <link href="/martin/CMS/bootstrap/sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/martin/CMS/bootstrap/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/martin/CMS/bootstrap/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/martin/CMS/bootstrap/sb-admin-2/css/custom.css">
</head>
<body>
    <?php 
    publicPageHeader();
    ?>
    <main class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-3">
            <div>
                <h1 class="h3 fw-bold mb-1">Kredity uživatele <b><?php echo $user; ?></b></h1>
            </div>
        </div>
        <div class="float-left col-xl-5 col-md-6 mb-4 mt-5">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Balance</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $userInfo[0]['credits'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="float-right w-50 pr-5 pl-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Dobití kreditů</h1>
            </div>
            <form class="user" action="<?php echo url('backend/addCredits.php'); ?>" method="post">
                <div class="form-group">
                    <input type="number" class="form-control form-control-user"
                        id="creditsBought" name="creditsBought" aria-describedby="creditsBought"
                        placeholder="Částka dobití ...">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user"
                        id="exampleInputPassword" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Dobít
                </button>
            </form>
        </div>
        <?php
        if (isset($_GET['wrongPass'])) {
echo '
            <div class="float-left col-xl-5 col-md-6 mt-3 mb-4">
                <div class="text-center row no-gutters align-items-center">
                    <div class=" bg-danger rounded p-2 h5 mb-0 font-weight-bold text-gray-400">You typed your password wrong</div>
                </div>
            </div>
';
        } elseif (isset($_GET['creditsAdded'])) {
echo '
            <div class="float-left col-xl-5 col-md-6 mt-3 mb-4">
                <div class="text-center row no-gutters align-items-center">
                    <div class=" bg-success rounded p-2 h5 mb-0 font-weight-bold text-gray-800">Your credits were added successfully</div>
                </div>
            </div>
';
        } elseif (isset($_GET['invalidCreditAmount'])) {
echo '
            <div class="float-left col-xl-5 col-md-6 mt-3 mb-4">
                <div class="text-center row no-gutters align-items-center">
                    <div class=" bg-danger rounded p-2 h5 mb-0 font-weight-bold text-gray-800">You inputed invalid credit amount</div>
                </div>
            </div>
';
        } elseif (isset($_GET['lowOnCredits'])) {
echo '
            <div class="float-left col-xl-5 col-md-6 mt-3 mb-4">
                <div class="text-center row no-gutters align-items-center">
                    <div class=" bg-danger rounded p-2 h5 mb-0 font-weight-bold text-gray-800">You dont have enough credits buy more</div>
                </div>
            </div>
';
        }

        ?>

    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
