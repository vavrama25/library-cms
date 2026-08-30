<?php 
require_once('lib/include.php'); 
session_start(); 

if (isset($_COOKIE['PHPSESSID']) AND isset($_SESSION[$_COOKIE['PHPSESSID']]) AND !empty($_SESSION[$_COOKIE['PHPSESSID']]) AND $_SESSION[$_COOKIE['PHPSESSID']] !== "LogedOut" AND isset($_SESSION['user']) AND isAdmin($_SESSION['user'])) {
    $user = $_SESSION['user'];
} elseif ((isset($_COOKIE['PHPSESSID']) AND isset($_SESSION[$_COOKIE['PHPSESSID']]) AND !empty($_SESSION[$_COOKIE['PHPSESSID']]) AND $_SESSION[$_COOKIE['PHPSESSID']] !== "LogedOut" AND isset($_SESSION['user']) AND isWorker($_SESSION['user']))) {
    header("Location: " . url('/admin'));
    exit;   
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

        <?php sidebarRendrer("settings"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="d-flex flex-column flex-grow-1 w-100">

               <?php topbarRender($user); ?>
                <div class="container-fluid py-4 flex-grow-1 d-flex flex-column justify-content-center align-items-center" id="borrowRules">
    

                    <div class="mb-5 w-100" style="max-width: 75%;">

                        <form action="<?= url('/backend/settingsEdit.php'); ?>" method="POST">


                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800 fw-bold">Nastavení výpůjček</h1>
                            </div>

                            <div class="card shadow mb-5 border-0">
                                <div class="card-header py-3 bg-white border-bottom d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-sliders-h mr-2"></i>Pravidla půjčování a poplatků
                                    </h6>
                                </div>
                                
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label for="borrowPeriod" class="form-label font-weight-bold text-gray-800 mb-1">
                                            Maximální doba výpůjčky
                                        </label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-light border-gray-300 text-gray-500">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>
                                            <input type="number" 
                                                id="borrowPeriod"
                                                name="borrowPeriod" 
                                                class="form-control" 
                                                min="1" 
                                                value="<?= getBorrowDayLimit(); ?>" 
                                                required>
                                            <span class="input-group-text bg-light border-gray-300 text-gray-600 font-weight-bold">
                                                dnů
                                            </span>
                                        </div>
                                        <small class="form-text text-muted">Standardní počet dní, po které může mít čtenář knihu bez sankce.</small>
                                    </div>

                                    <div class="mb-4">
                                        <label for="fine" class="form-label font-weight-bold text-gray-800 mb-1">
                                            Sankce za překročení termínu
                                        </label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-light border-gray-300 text-gray-500">
                                                <i class="fas fa-coins"></i>
                                            </span>
                                            <input type="number" 
                                                id="fine"
                                                name="fine" 
                                                class="form-control" 
                                                min="0" 
                                                value="<?= getFineValue(); ?>" 
                                                required>
                                            <span class="input-group-text bg-light border-gray-300 text-gray-600 font-weight-bold">
                                                kreditů / den
                                            </span>
                                        </div>
                                        <small class="form-text text-muted">Poplatek účtovaný automaticky za každý započatý den prodlení.</small>
                                    </div>

                                    <div class="mb-4">
                                        <label for="booksBorrowLimit" class="form-label font-weight-bold text-gray-800 mb-1">
                                            Limit výpůjček
                                        </label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-light border-gray-300 text-gray-500">
                                                <i class="fas fa-book"></i>
                                            </span>
                                            <input type="number" 
                                                id="booksBorrowLimit"
                                                name="booksBorrowLimit" 
                                                class="form-control" 
                                                min="1" 
                                                value="<?= getBooksBorrowedLimit(); ?>" 
                                                required>
                                            <span class="input-group-text bg-light border-gray-300 text-gray-600 font-weight-bold">
                                                knih
                                            </span>
                                        </div>
                                        <small class="form-text text-muted">Počet knih, který si uživatel může mít půjčené v jeden moment.</small>
                                    </div>
                                </div>
                            </div>


                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800 fw-bold">Systémové nastavení</h1>
                            </div>

                            <div class="card shadow mb-4 border-0">
                                <div class="card-header py-3 bg-white border-bottom d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-desktop mr-2"></i>Frontend a vzhled
                                    </h6>
                                </div>
                                
                                <div class="card-body">
                                    <!-- Nadpis webu -->
                                    <div class="mb-4">
                                        <label for="pageHeading" class="form-label font-weight-bold text-gray-800 mb-1">
                                            Nadpis stránky
                                        </label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-light border-gray-300 text-gray-500">
                                                <i class="fas fa-heading"></i>
                                            </span>
                                            <input type="text" 
                                                id="pageHeading"
                                                name="pageHeading" 
                                                class="form-control" 
                                                value="<?= getPageHeading(); ?>" 
                                                required>
                                            <span class="input-group-text bg-light border-gray-300 text-gray-600 font-weight-bold">
                                                Text
                                            </span>
                                        </div>
                                        <small class="form-text text-muted">Hlavní titulek v hlavičce a navigaci webu.</small>
                                    </div>

                                    <div class="mb-4">
                                        <label for="logo" class="form-label font-weight-bold text-gray-800 mb-1">
                                            Cesta k logu
                                        </label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-light border-gray-300 text-gray-500">
                                                <i class="fas fa-image"></i>
                                            </span>
                                            <input type="text" 
                                                id="logo"
                                                name="logo" 
                                                class="form-control" 
                                                value="<?= getLogo(); ?>" 
                                                required>
                                            <span class="input-group-text bg-light border-gray-300 text-gray-600 font-weight-bold">
                                                URL / Cesta
                                            </span>
                                        </div>
                                        <small class="form-text text-muted">Relativní nebo absolutní cesta k obrázku loga.</small>
                                    </div>
                                </div>

                                <div class="card-footer bg-light py-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary shadow-sm px-4 font-weight-bold">
                                        <i class="fas fa-save mr-2 text-white-50"></i>Uložit veškeré nastavení
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>              
                                    

                </div>
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