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
    <base href="/martin/CMS/admin-folder/">
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

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo url('admin'); ?>">
                <div class="sidebar-brand-icon">
                    <img src="vendor/fontawesome-free/svgs/regular/logo.svg" alt="Logo" class="logo">
                </div>
                <div class="sidebar-brand-text mx-3">Knihovna admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo url('admin'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Books -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo url('/admin/books-manager'); ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Books</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Readers -->
            <li class="nav-item ">
                <a class="nav-link" href="readers.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Readers</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Borrowed -->
            <li class="nav-item ">
                <a class="nav-link" href="borrowed.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Borrowed</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                       
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $user;   ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>


                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <!-- Obrázek knihy -->
                        <div class="text-center px-3 pt-2">
                            <img src="<?php $book['cover_url'] ?? 'img/default-book.png'; ?>" 
                                class="card-img-top img-fluid rounded" 
                                alt="<?php $book['title']; ?>" 
                                style="max-height: 220px; object-fit: contain;">
                        </div>

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <!-- Žánr (Badge) -->
                                <div class="mb-2">
                                    <span class="badge badge-primary text-uppercase px-2 py-1">
                                        <?php $book['genre'] ?? 'Žánr neuveden'; ?>
                                    </span>
                                </div>

                                <!-- Název knihy -->
                                <div class="h5 font-weight-bold text-gray-800 mb-1 text-truncate" title="<?php $book['title']; ?>">
                                    <?php $book['title']; ?>
                                </div>

                                <!-- Autor -->
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-3">
                                    <i class="fas fa-user-edit mr-1"></i><?php $book['author']; ?>
                                </div>
                            </div>

                            <!-- Tlačítka akcí (Akce pro Admin) -->
                            <div class="border-top pt-3 mt-2 d-flex justify-content-between align-items-center">
                                <a href="book-editor.php?id=<?php $book['id']; ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit fa-sm"></i> Upravit
                                </a>
                                <a href="delete-book.php?id=<?php $book['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Opravdu smazat?')">
                                    <i class="fas fa-trash fa-sm"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    
    <div >
        <?php 
        if (isset($_GET['tile'])) {
            $tile = $_GET['tile'];
            if ($tile == "home-dashboard") {
                echo "home-dashboard";
            } elseif ($tile == "content") {
        ?>
        <div >
            <?php  listAllContent('book-editor');?>
        </div>
        <?php
            } elseif ($tile == "settings") {
                echo "settings";
            }
            
        }   
        ?>
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