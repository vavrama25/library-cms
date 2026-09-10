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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="<?= url('/bootstrap/sb-admin-2/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= url('/bootstrap/sb-admin-2/css/sb-admin-2.min.css') ?>" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= url('/bootstrap/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= url('/bootstrap/sb-admin-2/css/custom.css') ?>">
</head>
<body>
    <div class="row d-flex justify-content-center flex-wrap align-content-center">
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <form class="user" action="<?php echo url('/backend/login-process.php'); ?>" method="post">
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user"
                            name="email" aria-describedby="emailHelp"
                            placeholder="Enter Email Address..." value="<?php emailPrefill(); ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user"
                            name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>
                    <hr>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="<?php echo url('/cantLogIn'); ?>">Forgot Password?</a>
                </div>
                <div class="text-center">
                    <a class="small" href="<?php echo url('/register'); ?>">Create an Account!</a>
                </div>
                <div class="text-center">
                <?php 
                if (isset($_COOKIE["PHPSESSID"])){
                    if (isset($_GET['logOut'])) {
                        $_SESSION[$_COOKIE["PHPSESSID"]] = "LogedOut";
                    }
                    if (isset($_GET['regSucess'])) {
                        echo "<p class='mt-5 text fs-3 text-bg-danger rounded-4'>Registration was a sucess you can now log in</p>"; 
                    }
                    if (isset($_GET['smtIsWrong'])) {
                        echo "<p class='mt-5 text fs-3 text-bg-danger rounded-4'>Something went wrong try again</p>"; 
                    }    
                    if (isset($_GET['emailSent'])) {
                        echo "<p class='mt-5 text fs-3 text-bg-danger rounded-4'>Email sent succesfully.</p>"; 
                    } 
                    if (isset($_GET['sessionExpired'])) {
                        echo "<p class='mt-5 text fs-3 text-bg-danger rounded-4'>Logged out due to inactivity.</p>"; 
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/bootstrap.bundle.min.js"></script>
</body>
</html>


