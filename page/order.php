<?php

require_once('lib/include.php'); 
session_start(); 

if (isset($_GET['title'])) {
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
    $id = $_GET['title'];
    $detail = getBookDetail($id);
    if (checkBookAvailability($id) <= 0) {
        header("Location: " . url('/'));
    }
} else {
    header("Location: " . url('/'));
}


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
    <title>Order</title>
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
    <div id="header flex">
        <?php 
            publicPageHeader(); 
        ?>
    </div>
    <main class="container py-3 d-flex justify-content-center flex-row">
        <div class='w-25 card h-100 border-0 shadow-sm rounded '>
            <div class='bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center text-muted' style='height: 220px;'>
                <img class='w-auto h-100 object-fit-cover' src='<?php echo $detail[0]['imgLink']; ?>' alt='bookcover'>
            </div>
            <div class='card-body d-flex flex-column'>
                <h2 class='card-title h6 fw-bold mb-1'><?php echo $detail[0]['title']; ?></h2>
                <p class='card-text text-muted small mb-3'><?php echo $detail[0]['autor']; ?></p>
            </div>
        </div>
        <div class="float-right w-50 pr-5 pl-5 d-flex flex-wrap align-content-center justify-content-center">
            <form class="user" action="<?php echo url("backend/order-process.php?title=$id"); ?>" method="post">
                <div class="form-group">
                    <span class="d-flex flex-wrap align-content-center justify-content-center text badge text-bg-success p-2 rounded-4"><p class="text h4 mb-0 text-gray-400">Cena: <?php echo $detail[0]['price']; ?></p></span>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-control-user"
                        id="exampleInputEmail" name="email" placeholder="Email" value="<?php if (isset($user)) { echo $user; }  ?>">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user"
                        id="exampleInputPassword" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Půjčit
                </button>
            </form>
        </div>
        
    </main>
</body>
</html>