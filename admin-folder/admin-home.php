<?php 
include_once('lib/include.php'); 
session_start(); 

if (isset($_COOKIE['PHPSESSID']) AND isset($_SESSION[$_COOKIE['PHPSESSID']]) AND !empty($_SESSION[$_COOKIE['PHPSESSID']]) AND $_SESSION[$_COOKIE['PHPSESSID']] !== "LogedOut" AND isset($_SESSION['user']) AND (isAdmin($_SESSION['user']) OR isWorker($_SESSION['user']))) {
    $user = $_SESSION['user'];
} else {
    header("Location: " . url('/login'));
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <base href="/bootstrap/sb-admin-2/">
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
<?php



$activeBorrowsCount = borrowedBooksCount();
$totalBorrowsCount = AllTimeborrowedBooksCount();
$allUsers = getAllFromCmsLogin();
$totalUsersCount = count($allUsers);
$allBooks = getAllFromCmsContent();
$activeBooksCount = count(array_filter($allBooks, function($book) {
    return isset($book['deleted']) && $book['deleted'] == 0;
}));

$recentOrders = array_slice(getAllBorrowHistory('borrowed'), 0, 5);
$borrowLimitDays = (int)getBorrowDayLimit();
?>



    <div id="wrapper">

        <?php sidebarRendrer('dashboard'); ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php topbarRender($user); ?>

                
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Přehled systému</h1>
                </div>

                <div class="container-fluid d-flex flex-row">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Aktivní výpůjčky</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= htmlspecialchars($activeBorrowsCount) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book-reader fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Aktivních titulů</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= htmlspecialchars($activeBooksCount) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Registrovaní uživatelé</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= htmlspecialchars($totalUsersCount) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Výpůjček celkem (historie)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= htmlspecialchars($totalBorrowsCount) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-history fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Poslední aktivní výpůjčky</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID záznamu</th>
                                                    <th>Čtenář</th>
                                                    <th>Kniha</th>
                                                    <th>Datum vypůjčení</th>
                                                    <th>Stav termínu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($recentOrders)): ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted">Žádné aktivní výpůjčky v evidenci</td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($recentOrders as $order): 
                                                        $user = getUserInfoById($order['user_id'])[0] ?? ['email' => 'Neznámý uživatel'];
                                                        $book = getBookDetail($order['content_id'])[0] ?? ['title' => 'Neznámý titul'];
                                                        $createdDate = new DateTime($order['created']);
                                                        $dueDate = (clone $createdDate)->modify('+' . $borrowLimitDays . ' days');
                                                        $isOverdue = new DateTime() > $dueDate;
                                                    ?>
                                                        <tr>
                                                            <td>#<?= htmlspecialchars($order['ID_cms-user_orders']) ?></td>
                                                            <td><?= htmlspecialchars($user['email']) ?></td>
                                                            <td><?= htmlspecialchars($book['title']) ?></td>
                                                            <td><?= $createdDate->format('d.m.Y H:i') ?></td>
                                                            <td>
                                                                <?php if ($isOverdue): ?>
                                                                    <span class="badge badge-danger">Po termínu</span>
                                                                <?php else: ?>
                                                                    <span class="badge badge-success">V termínu</span>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </div>

    <script src="<?= url('/startbootstrap-sb-admin-2-gh-pages/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= url('/startbootstrap-sb-admin-2-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= url('/startbootstrap-sb-admin-2-gh-pages/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= url('/startbootstrap-sb-admin-2-gh-pages/js/sb-admin-2.min.js') ?>"></script>
</body></body>
</html>
