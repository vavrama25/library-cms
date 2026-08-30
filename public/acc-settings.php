<?php
session_start();
require_once("lib/include.php");

if (!isset($_GET['delWasSuccessful'])) {
    loginCheck();
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nastavení účtu</title>
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 w-100" style="max-width: 75%;">
                
                <?php if (isset($_GET['delWasSuccessful'])): ?>
                    <div class="alert alert-info shadow-sm rounded-3 mb-4 font-weight-bold">
                        <i class="fas fa-info-circle mr-2"></i>Váš účet byl úspěšně smazán a již neexistuje.
                    </div>
                <?php endif; ?>

                <?php if (isset($_COOKIE['PHPSESSID']) && isset($_SESSION['user'])): ?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 fw-bold">Nastavení pro uživatele <?= htmlspecialchars($_SESSION['user']); ?></h1>
                    </div>

                    <div class="card shadow border-0 rounded-3">
                        <div class="card-header py-3 bg-white border-bottom">
                            <h6 class="m-0 font-weight-bold text-danger">
                                <i class="fas fa-user-times mr-2"></i>Odstranění účtu
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <p class="text-muted mb-4">Tato akce je trvalá a nelze ji vzít zpět.</p>
                            <a href="<?= url('/accDelete'); ?>" class="btn btn-danger shadow-sm font-weight-bold px-4">
                                <i class="fas fa-trash-alt mr-2 text-white-50"></i>Smazat účet
                            </a>
                        </div>
                        <div class="card-footer bg-light py-3">
                            <a href="<?= url('/'); ?>" class="btn btn-outline-secondary btn-sm font-weight-bold">
                                <i class="fas fa-arrow-left mr-2"></i>Zpět na hlavní stranu
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>