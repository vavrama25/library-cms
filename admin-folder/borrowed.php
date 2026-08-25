<?php 
require_once('lib/include.php'); 
session_start(); 

if (isset($_COOKIE['PHPSESSID']) AND isset($_SESSION[$_COOKIE['PHPSESSID']]) AND !empty($_SESSION[$_COOKIE['PHPSESSID']]) AND $_SESSION[$_COOKIE['PHPSESSID']] !== "LogedOut" AND isset($_SESSION['user']) AND (isAdmin($_SESSION['user']) OR isWorker($_SESSION['user']))) {
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

        <?php  
            sidebarRendrer("borrowed");
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php 
                    topbarRender($user); 
                    if (isset($_GET['book-search'])) {
                        $bookSearch = $_GET['book-search'];
                    } else {
                        $bookSearch = '';
                    }
                    if (isset($_GET['user-search'])) {
                        $userSearch = $_GET['user-search'];
                    } else {
                        $userSearch = '';
                    }
                ?>

                <form action="<?= url('/admin/borrowed?') ?>" method="get" class="justify-content-between d-flex flex-row form-inline mr-3 ml-md-3 my-2 my-md-0 mw-100">
                    <div class="input-group shadow-sm float-left" style="max-width: 320px;">
                        <input type="text" 
                            class="form-control bg-light border-0 small" 
                            list="booksList" 
                            name="book-search" 
                            placeholder="Hledat knihu..." 
                            aria-label="Book-search" 
                            style="font-size: 0.85rem; padding: 0.6rem 1rem;"
                            <?= (isset($bookSearch)) ? "value='$bookSearch'" : "" ?>
                        >
                        

                    

                    <datalist id="booksList">
                        <?php 
                            $getAllFromCmsContent = getAllFromCmsContent();
                            foreach ($getAllFromCmsContent as $var) {
                                foreach ($var as $key => $value) {
                                    if ($key == "title") {
                                        echo "<option value='$value'>";
                                    }
                                }
                            }
                        ?>
                    </datalist>
                    
                        <input type="text" 
                            class="form-control bg-light border-0 small" 
                            list="UserList" 
                            name="user-search" 
                            placeholder="Hledat uživatele..." 
                            aria-label="User-search" 
                            style="font-size: 0.85rem; padding: 0.6rem 1rem;"
                            <?= (isset($userSearch)) ? "value='$userSearch'" : "" ; ?>
                            >
                        
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" style="background-color: #4e73df; border-color: #4e73df;">
                                <i class="fas fa-search fa-sm text-white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="shadow-sm rounded" style="max-width: 320px;">

                        <datalist id="UserList">
                            <?php 
                                $getAllFromCmsLogin = getAllFromCmsLogin();
                                
                                foreach ($getAllFromCmsLogin as $var) {
                                    foreach ($var as $key => $value) {
                                        if ($key == "email") {
                                            echo "<option value='$value'>";
                                        }
                                    }
                                }
                            ?>
                        </datalist>


                    </div>
                    <div class="input-group shadow-sm float-right" style="max-width: 320px;">

                        <select name="filter" id="booksList" class='form-select bg-light border-0 small text-muted' onchange='this.form.submit()'>
                            <option <?= (($_GET['filter'] ?? '') === 'borrowed') ? 'selected' : '' ?> value="borrowed">Borrowed</option>
                            <option <?= (($_GET['filter'] ?? '') === 'returned') ? 'selected' : '' ?> value="returned">Returned</option>
                            <option <?= (($_GET['filter'] ?? '') === 'lost') ? 'selected' : '' ?> value="lost">Lost</option>
                        </select>
                    </div>
                </form>                
                <?php 
                    if (isset($_GET['filter'])) {
                        $filter = $_GET['filter'];
                        listAllBorrowedContent($filter, $userSearch, $bookSearch);
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