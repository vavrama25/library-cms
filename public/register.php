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
    <div class="card-body p-0 ">
        <!-- Nested Row within Card Body -->
        <div class="row d-flex justify-content-center">
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form method="post" action="<?php echo url('/backend/register-process.php'); ?>" class="user">
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email"
                                placeholder="Email Address">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user"
                                    name="password" placeholder="Password">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user"
                                    name="password-confirm" placeholder="Repeat Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Register Account
                        </button>
                        <hr>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?php echo url('/cantLogIn'); ?>">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="<?php echo url('/login'); ?>">Already have an account? Login!</a>
                    </div>
                    <div class="text-center">
                    <?php 

                        if (isset($_GET['PasswordsDoNotMatch'])) {
                            echo "<p class='mt-5 text fs-3 text-bg-danger rounded-4'>Passwords are not matching</p>";
                        }
                        if (isset($_GET['emailNotVerified'])) {
                            echo "<p class='mt-5 text fs-3 text-bg-danger rounded-4'>There is a mistake in your email</p>";
                        }
                        if (isset($_GET['PasswordTooWeak'])) {
                            echo "<p class='mt-5 text fs-3 text-bg-danger rounded-4'>A password must contain at least 12 characters, a number and one special character</p>";
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


