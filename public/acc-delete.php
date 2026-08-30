<?php
session_start();
require_once("lib/include.php");
loginCheck();

if (!isset($_SESSION['user'])) {
    header("Location: " . url("/login"));
    exit();
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smazání účtu</title>
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 w-100" style="max-width: 75%;">
                
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800 fw-bold">Trvalé smazání účtu: <?= htmlspecialchars($_SESSION['user']); ?></h1>
                </div>

                <?php if (isset($_GET['delNotSuccessful'])): ?>
                    <div class="alert alert-danger shadow-sm rounded-3 mb-4 font-weight-bold">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Smazání se nezdařilo. Zkontrolujte správnost hesla.
                    </div>
                <?php endif; ?>

                <div class="card shadow mb-4 border-0 rounded-3">
                    <div class="card-header py-3 bg-white border-bottom">
                        <h6 class="m-0 font-weight-bold text-danger">
                            <i class="fas fa-exclamation-circle mr-2"></i>Potvrzení akce
                        </h6>
                    </div>
                    <form action="<?= url('/backend/accDelete-process.php'); ?>" method="POST">
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label for="password" class="form-label font-weight-bold text-gray-800 mb-1">Zadejte heslo k účtu</label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text bg-light border-gray-300 text-gray-500">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Vaše heslo..." required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light py-3 d-flex justify-content-between align-items-center">
                            <a href="<?= url('/accSettings'); ?>" class="btn btn-outline-secondary btn-sm font-weight-bold">
                                <i class="fas fa-arrow-left mr-2"></i>Zpět do nastavení
                            </a>
                            <button type="submit" class="btn btn-danger shadow-sm font-weight-bold px-4">
                                <i class="fas fa-trash-alt mr-2 text-white-50"></i>Smazat účet
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>