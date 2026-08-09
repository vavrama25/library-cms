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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 ">
                <div class="p-5 ">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                            and we'll send you a link to reset your password!</p>
                    </div>
                    <form class="user" action="<?php echo url('backend/cantLogin-process.php'); ?>" method="post">
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user"
                                name="email" aria-describedby="emailHelp"
                                placeholder="Enter Email Address..." value="<?php emailPrefill(); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Reset Password
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?php echo url('/register'); ?>">Create an Account!</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="<?php echo url('/login'); ?>">Already have an account? Login!</a>
                    </div>
                    <div class="text-center">
                    <?php


                
                    if (isset($_GET['emailInvalid'])) {
                        echo "<p class='mt-5 text fs-3 text-bg-danger rounded-4'>Email is not valid</p>";
                    }
                    if (isset($_GET['emailAlredySent'])) {
                        echo "<p class='mt-5 text fs-3 text-bg-danger rounded-4'>Email has been sent alredy</p>";
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/bootstrap.bundle.min.js"></script>

</body>
</html>