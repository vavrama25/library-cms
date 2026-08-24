<?php


function publicPageHeader() {
    require_once 'include.php';
    echo '
    <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm sticky-top mb-4">
        <div class="container-fluid px-lg-4">
            
            <!-- Levá zóna: Logo a Nadpis -->
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-dark" href="' . url('/') . '">
                <!-- Jednoduchá SVG ikona knihy místo loga -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                </svg>
                Knihovna CMS
            </a>

            <!-- Mobilní toggle tlačítko -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#hlavniNavigace">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Střední a Pravá zóna (na mobilu se skryje do menu) -->
            <div class="collapse navbar-collapse" id="hlavniNavigace">'; 



            if (isset($_GET['boughtSuccessfully'])) {
                echo "<span class='badge text-bg-success text-white bg-opacity-75'>Bought Successfully</span>";
            }

            
            echo '

                <!-- Pravá zóna: Katalog a Uživatel -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                         <!--Js searchbar-->
                    <li>
                        <div class="" >
                            <input class="form-control me-2 bg-light border-secondary-subtle" type="text" placeholder="Hledat knihu, autora">
                            <div id="suggestions-list" class="list-group position-absolute w-100 shadow-lg mt-1" style="z-index: 1050;"></div>
                        </div>
                    </li>';
                    searchJsonCreate();
                    
                    echo '<script src="src/search-bar.js"></script>
                    <!--Js searchbar-->
                    <!-- Dropdown -->
                    <li class="nav-item dropdown me-lg-3">
                        <a class="nav-link dropdown-toggle text-dark fw-medium" href="#" role="button" data-bs-toggle="dropdown">
                            Katalog
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            <li><a class="dropdown-item" href="?katalog=novinky">Novinky</a></li>
                            <li><a class="dropdown-item" href="?katalog=beletrie">Beletrie</a></li>
                            <li><a class="dropdown-item" href="?katalog=naucna">Naučná literatura</a></li>
                        </ul>
                    </li>
                    <!-- Účet / Login -->
                    '; 

                    if (isset($_SESSION['user']) AND !empty($_SESSION['user']) AND isset($_COOKIE['PHPSESSID']) AND $_SESSION[$_COOKIE['PHPSESSID']] !== 'LogedOut') {
                        $userInfo = getUserInfo($_SESSION['user']);
                        echo '
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark fw-medium" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="text-gray-600 small">' . $_SESSION['user'] . '</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="#">Nastavení</a></li>
                                <li><a class="dropdown-item" href="' . url('/history') .'">Historie výpůjček</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class=" dropdown-item text-danger" href="' . url('/login?logOut') . '">Odhlásit se</a></li>
                            </ul>
                        </li>
                        <li class="nav-item d-flex gap-2 mt-2 mt-lg-0">
                            <a class="btn btn-outline-dark btn-sm px-3" href="' . url('/credits') . '">Kredity: ' . $userInfo[0]["credits"] . '</a>
                        </li>';
                    } else {
                        echo '
                        <li class="nav-item d-flex gap-2 mt-2 mt-lg-0">
                            <a class="btn btn-outline-dark btn-sm px-3" href="' . url('/login') . '">Přihlásit</a>
                            <a class="btn btn-dark btn-sm px-3" href="' . url('/register') . '">Registrovat</a>
                        </li>
                        ';
                    }

echo '
                </ul>
            </div>
        </div>
    </nav>';

}


function listAllContent($showAddBookCard){
    global $db;
    include_once("include.php");

    $sql_count = "SELECT COUNT(*) FROM `cms-content`";
    $count = $db->prepare($sql_count);
    $count->execute();
    $data_count = $count->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET['page'])){
        $page = $_GET['page'] - 1;
    } else {
        $page = 0;
    }

    $validCr = [4, 8, 16];

    if (isset($_GET['cr']) AND in_array($_GET[('cr')], $validCr)) {
        $cr = $_GET['cr'];
        $page_modified = $page * $cr;
    } else {
        $cr = 4;
        $page_modified = $page * $cr;
    }

    foreach ($data_count as $key => $value) {
        foreach ($value as $key => $value) {
            $page_count = ceil($value/$cr);
        }
    }




    $sql = "SELECT * FROM `cms-content` LIMIT $page_modified, $cr";
    $con = $db->prepare($sql);
    $con->execute();
    $data = $con->fetchAll(PDO::FETCH_ASSOC);


    echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 gx-4 gy-3 container-fluid">';

    if ($showAddBookCard) {
        addBookCard();
    }
    foreach ($data as $key => $value) {
        echo '<div class="col">';
        foreach ($value as $key => $var) {
            if ($key == "ID_cms-content") {
                $id = $var;
            } elseif ($key == "title") {
                $title = $var;
            } elseif ($key == "autor") {
                $autor = $var;
            }elseif ($key == "genre") {
                $genre = $var;
            } elseif ($key == "imgLink") {
                $imgLink = $var;
            } elseif ($key == "description") {
                $description = $var;
            }  elseif ($key == "availability") {
                $availability = $var;
            }

        }
    echo "    <div class='card h-100 border-0 shadow-sm rounded-3'>
                    <div class='bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center text-muted' style='height: 220px;'>
                        <img class='w-auto h-100 object-fit-cover' src='$imgLink' alt='bookcover'>
                    </div>
                    <div class='card-body d-flex flex-column'>
                        <h2 class='card-title h6 fw-bold mb-1'>$title</h2>
                        <p class='card-text text-muted small mb-3'>$autor</p>
                        <div class='mt-auto d-flex justify-content-between align-items-center'>";
                            if ($availability <= 0) {echo "<span class='badge text-bg-danger text-white bg-opacity-75'>Nedostupné</span>";} else { echo"<span class='badge text-bg-success text-white bg-opacity-75'> Dostupné ($availability)</span>";}
                            echo "
                            <a class='btn btn-outline-dark btn-sm' href='"; echo url("/detail?id=$id"); echo "'>Detail</a>
                        </div>
                    </div>
                </div>
        ";


        echo "</div>
        
        ";
    }
echo "
</div>
<div class='d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-4 pt-3 border-top'>
    
    <!-- Stránkování (Bootstrap Pagination) -->
    <nav aria-label='Navigace stránek'>
        <ul class='pagination pagination-sm mb-0 shadow-sm'>
";

$prevDisabled = '';
if ($page <= 0) {
    $prevDisabled = "disabled";
}
$prevPage = max(1, $page - 1);
echo "
    <li class='page-item $prevDisabled'>
        <a class='page-link' href='?page=$prevPage&cr=$cr' aria-label='Předchozí'>
            <span aria-hidden='true'>&laquo;</span>
        </a>
    </li>
";


for ($i = 1; $i <= $page_count; $i++) {
    $activeClass = '';
    if ($page == ($i - 1)) {
        $activeClass = "active";
    }
    echo "
        <li class='page-item $activeClass'>
            <a class='page-link' href='?page=$i&cr=$cr'>$i</a>
        </li>
    ";
}


$nextDisabled = '';
if ($page >= $page_count) {
    $nextDisabled = 'disabled';
}
$nextPage = min($page_count, $page + 2);
echo "
    <li class='page-item $nextDisabled'>
        <a class='page-link' href='?page=$nextPage&cr=$cr' aria-label='Další'>
            <span aria-hidden='true'>&raquo;</span>
        </a>
    </li>
";

echo "
        </ul>
    </nav>

    <!-- Volba počtu položek na stránku -->
    <form action='" . url('/') . "' method='get' class='d-flex align-items-center gap-2 mb-0'>
        <label for='crSelect' class='text-muted small mb-0 text-nowrap'>Zobrazit na stránku:</label>
        <select id='crSelect' name='cr' class='form-select form-select-sm shadow-sm' style='width: auto;' onchange='this.form.submit()'>
            <option value='4' " . ($cr == 4 ? 'selected' : '') . ">4</option>
            <option value='8' " . ($cr == 8 ? 'selected' : '') . ">8</option>
            <option value='16' " . ($cr == 16 ? 'selected' : '') . ">16</option>
        </select>
    </form>

";
}


function listBorrowedContent($user_id){
    require_once 'include.php';
    global $db;
    $borrowHistory = getUserBorrowHistory($user_id);
    $date = new DateTime();

    $borrowedBooks = [];
    $i = 0;
    $dayOverPay = getFineValue();
    $borrowDaysLimit = getBorrowDayLimit();
    $AllFromCmsUserOrders = getAllFromCmsUserOrders();

    foreach ($borrowHistory as $key => $value) {
        $sql = "SELECT * FROM `cms-content` WHERE `ID_cms-content` = :id;";
        $con = $db->prepare($sql);
        $con->bindValue(":id", $value['content_id'], PDO::PARAM_STR);
        $con->execute();   
        $data = $con->fetchAll(PDO::FETCH_ASSOC);
        $borrowedBooks[] = $data[0];
    }

    $returned = [];
    $borrowed = [];
    $lost = [];

    foreach ($borrowHistory as $item) {
        if ($item['status'] == 'borrowed') {
            $borrowed[] = $item;
        } elseif ($item['status'] == 'returned') {
            $returned[] = $item;
        } elseif ($item['status'] == 'lost') {
            $lost[] = $item;
        }
    }

    echo '<div class="container-fluid">';

    if (count($borrowed) > 0) {
        echo "
        <div class='d-flex justify-content-between align-items-end border-bottom pb-3 mt-4 mb-4'>
            <div>
                <h1 class='h3 fw-bold mb-1'>Momentálně vypůjčené</h1>
            </div>
        </div>
        <div class='row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-4'>";

        foreach ($borrowed as $value) {
            $createdDate = new DateTime($value['created']);
            $dueDate = (clone $createdDate)->modify('+' . $borrowDaysLimit .'day');
            $ID_cms_user_orders = $value['ID_cms-user_orders'];

            // Vytáhneme data správné knihy přímo podle content_id této výpůjčky
            $sql = "SELECT * FROM `cms-content` WHERE `ID_cms-content` = :id;";
            $con = $db->prepare($sql);
            $con->bindValue(":id", $value['content_id'], PDO::PARAM_STR);
            $con->execute();   
            $bookData = $con->fetch(PDO::FETCH_ASSOC);

            $id = $bookData['ID_cms-content'];
            $title = $bookData['title'];
            $autor = $bookData['autor'];
            $imgLink = $bookData['imgLink'];

            echo "
            <div class='col'>
                <div class='card h-100 border-0 shadow-sm rounded-3'>
                    <div class='bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center text-muted' style='height: 220px;'>
                        <img class='w-auto h-100 object-fit-cover' src='$imgLink' alt='bookcover'>
                    </div>
                    <div class='card-body d-flex flex-column'>
                        <h2 class='card-title h6 fw-bold mb-1'>$title</h2>
                        <p class='card-text text-muted small mb-3'>$autor</p>
                        <div class='mt-auto d-flex justify-content-between align-items-center'>";
                            if ($date > $dueDate) {
                                $daysOverdue = $date->diff($dueDate)->days;
                                echo "<span class='badge text-bg-danger text-white bg-opacity-75 mr-3'>Po termínu: (" . $daysOverdue . ")</span>";
                            } else { 
                                echo "<span class='badge text-bg-success text-white bg-opacity-75 mr-3'>Vrátit do: " . $dueDate->format('d.m.Y') . " </span>";
                            }
                            echo "
                            <a class='btn btn-outline-dark btn-sm' href='" . url("/detail?id=$id") . "'>Detail</a>
                        </div>
                        <div class='d-flex justify-content-center align-items-center mt-2'>";
                            if ($date > $dueDate) {
                                $daysOverdue = $date->diff($dueDate)->days;
                                echo '<a href="'. url("backend/return.php?book_id={$value['content_id']}&id=$ID_cms_user_orders") .'" class="btn btn-outline-dark btn-sm text-bg-danger text-white bg-opacity-75 mr-3">Vrátit a doplatit: (' . $daysOverdue * $dayOverPay . ' Cr)</a>';
                            } else { 
                                echo '<a href="' . url("backend/return.php?book_id={$value['content_id']}&id=$ID_cms_user_orders") .'" class="btn btn-outline-dark btn-sm text-bg-success text-white bg-opacity-75 mr-3">Vrátit</a>';
                            }
            echo " 
                        </div>
                    </div>
                </div>
            </div>";
        }
        echo '</div>';
    }

    if (count($returned) > 0) {
        echo "
        <div class='d-flex justify-content-between align-items-end border-bottom pb-3 mt-5 mb-4'>
            <div>
                <h1 class='h3 fw-bold mb-1 text-secondary'>Vrácené</h1>
            </div>
        </div>
        <div class='row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-4'>";

        foreach ($returned as $value) {
            $createdDate = new DateTime($value['created']);
            $dueDate = (clone $createdDate)->modify('+' . $borrowDaysLimit .'day');
            $ID_cms_user_orders = $value['ID_cms-user_orders'];

            $sql = "SELECT * FROM `cms-content` WHERE `ID_cms-content` = :id;";
            $con = $db->prepare($sql);
            $con->bindValue(":id", $value['content_id'], PDO::PARAM_STR);
            $con->execute();   
            $bookData = $con->fetch(PDO::FETCH_ASSOC);

            $id = $bookData['ID_cms-content'];
            $title = $bookData['title'];
            $autor = $bookData['autor'];
            $imgLink = $bookData['imgLink'];
           
            echo "
            <div class='col'>
                <div class='card h-100 border-0 shadow-sm rounded-3'>
                    <div class='bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center text-muted' style='height: 220px;'>
                        <img class='w-auto h-100 object-fit-cover' src='$imgLink' alt='bookcover'>
                    </div>
                    <div class='card-body d-flex flex-column'>
                        <h2 class='card-title h6 fw-bold mb-1'>$title</h2>
                        <p class='card-text text-muted small mb-3'>$autor</p>
                        <div class='mt-auto d-flex justify-content-between align-items-center'>
                            <span class='badge text-bg-secondary text-white mr-3'>Vráceno</span>
                            <a class='btn btn-outline-dark btn-sm' href='" . url("/detail?id=$id") . "'>Detail</a>
                        </div>
                    </div>
                </div>
            </div>";
        }  
        echo '</div>';
    }

    echo '</div>';
}