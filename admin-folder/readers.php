<?php 
require_once('lib/include.php'); 
session_start(); 

if (isset($_COOKIE['PHPSESSID']) AND isset($_SESSION[$_COOKIE['PHPSESSID']]) AND !empty($_SESSION[$_COOKIE['PHPSESSID']]) AND $_SESSION[$_COOKIE['PHPSESSID']] !== "LogedOut" AND isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("Location: " . url('/login'));
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <base href="/martin/CMS/bootstrap/sb-admin-2/">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php sidebarRendrer("readers"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

               <?php topbarRender($user); ?>
                <form action="<?= url('/backend/readersEdit.php?action=edit') ?>" method="post">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Readers</h6>
                            <button type="submit" class="btn btn-sm btn-success shadow-sm">
                                <i class="fas fa-save mr-1"></i> Uložit změny
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>email</th>
                                            <th>deleted</th>
                                            <th>role</th>
                                            <th>credits</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php readerTbody(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                    if (isset($_GET['error'])) {       
                        if ($_GET['error'] == 'badCreditsValue') {
                echo '
                            <div class="float-left col-xl-12 col-md-6 mt-3 mb-4">
                                <div class="text-center row no-gutters align-items-center">
                                    <div class=" bg-danger rounded p-2 h5 mb-0 font-weight-bold text-gray-400">Bad credits value</div>
                                </div>
                            </div>
                ';
                        } elseif ($_GET['error'] == 'badRoleValue') {
                echo '
                            <div class="float-left col-xl-12 col-md-6 mt-3 mb-4">
                                <div class="text-center row no-gutters align-items-center">
                                    <div class=" bg-danger rounded p-2 h5 mb-0 font-weight-bold text-gray-400">Bad role value</div>
                                </div>
                            </div>
                ';
                        } elseif ($_GET['error'] == 'success') {
                echo '
                            <div class="float-left col-xl-12 col-md-6 mt-3 mb-4">
                                <div class="text-center row no-gutters align-items-center">
                                    <div class=" bg-success rounded p-2 h5 mb-0 font-weight-bold text-gray-800">success</div>
                                </div>
                            </div>
                ';
                        }
                    }

        ?>

            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>