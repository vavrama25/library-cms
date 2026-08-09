<?php
require_once('lib/include.php'); 
session_start(); 

if (isset($_GET['id']) AND !empty($_GET['id'])) {
    $id = $_GET['id'];
    $detail = getBookDetail($id);
} else {
    header("Location: " . url('CMS/'));
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
    <title><?php echo $detail[0]['title']; ?></title>
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
    <main class="container py-3">
        <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-1">
            <div>
                <h1 class="h3 fw-bold mb-1"><?php echo $detail[0]['title']; ?></h1>
                <p class="text-muted mb-0"><?php echo $detail[0]['autor']; ?></p>
            </div>
            <div>
                <h1 class="h2 fw-bold mb-3"><?php echo $detail[0]['genre']; ?></h1>
            </div>
        </div>
        <div class="d-flex flex-row gap-5">
            <div>
                <img src="<?php echo $detail[0]['imgLink']; ?>" alt="bookCover">
            </div>
            <div>
                <div class="mt-3">
                    <p class=" h6 text-muted mb-0"><?php echo $detail[0]['description'] ?></p>
                </div>
                <div class="mt-5 d-flex justify-content-between">
                    <?php
                    if ($detail[0]['availability'] <= 0) {
                        echo "
                        <div class='flex'>
                            <span class='status-hover-element align-self-center badge text-bg-danger text-white bg-opacity-75'>
                                <p class='h2'>Nedostupné</p>   
                                <small>Omlováme se ale tato položka momentalně není k dispozici</small>   
                            </span>
                            
                            
                        </div>
                        ";
                    } else { 
                        echo'
                            <a href="' . url("/order?title={$detail[0]['ID_cms-content']}") . '" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text mb-0 h6">Objednat zbývá (' . $detail[0]['availability'] . ')</span>
                            </a>
                        ';
                    }
                    ?>
                    <span class=" mr-3 align-self-center badge text-bg-info text-white bg-opacity-75 px-2 py-2"><p class="h6 text mb-0">cena: <?php echo $detail[0]['price'] ?></p></span>
                </div>
            </div>
        </div>

    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/bootstrap.bundle.min.js"></script>
</body>
</html>