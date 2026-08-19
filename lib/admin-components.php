<?php
function sidebarRendrer($active) {
    echo '
     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="' . url("admin") . '">
                <div class="sidebar-brand-icon">
                    <img src="vendor/fontawesome-free/svgs/regular/logo.svg" alt="Logo" class="logo">
                </div>
                <div class="sidebar-brand-text mx-3">Knihovna admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item '; if($active == "dashboard") {echo 'active';} echo '">
                <a class="nav-link" href="' . url("admin") . '">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Books -->
            <li class="nav-item '; if($active == "books") {echo 'active';} echo '">
                <a class="nav-link" href="' . url("/admin/books-manager") . '">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Books</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Readers -->
            <li class="nav-item '; if($active == "readers") {echo 'active';} echo ' ">
                <a class="nav-link" href="readers.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Readers</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Borrowed -->
            <li class="nav-item '; if($active == "borrowed") {echo 'active';} echo ' ">
                <a class="nav-link" href="borrowed.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Borrowed</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
    ';
}

function topbarRender($user) {
    echo '
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
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">' . $user . '</span>
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
    ';
}

function addBookCard() {
     echo '   
        <div class="col">
            <a href="' . url('/admin/addBook') . '" class="text-decoration-none text-dark d-block h-100">
                <div class="card h-100 border-0 shadow-sm rounded-3 text-center border-dashed">
                    <!-- Šedý blok o stejné výšce 220px jako u knihy s velkým plus -->
                    <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center text-muted" style="height: 220px;">
                        <i class="fas fa-plus fa-3x text-primary"></i>
                    </div>
                    <!-- Tělo karty se stejným odsazením -->
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h2 class="card-title h6 fw-bold mb-1 text-primary">Přidat novou knihu</h2>
                        <p class="card-text text-muted small mb-0">Kliknutím vytvoříte nový záznam v katalogu</p>
                    </div>
                </div>
            </a>
        </div>
    ';
}

function addBookForm() {
    $prefillValues = $_SESSION['form_data'] ?? [];

    $selectedBeletrie = (($prefillValues['forma'] ?? '') === 'beletrie') ? 'selected' : '';
    $selectedNaucna = (($prefillValues['forma'] ?? '') === 'naucna') ? 'selected' : '';

    unset($_SESSION['form_data']);

    echo '   
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 container-fluid">
            <div class="card h-100 border-0 shadow-sm rounded-3 d-none" id="cardWrapper">
                <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center text-muted" style="height: 220px;">
                    <img class="w-auto h-100 object-fit-cover" src="" id="img" alt="bookcover">
                </div>
                <div class="card-body d-flex flex-column">
                    <h2 class="card-title h6 fw-bold mb-1" id="title"></h2>
                    <p class="card-text text-muted small mb-3" id="autor"></p>
                </div>
            </div>
        
            <div class="col-md-3">
                <form action="' . url('/backend/addBook-process.php') . '" method="post">
                    <label for="bookTitle" class="form-label font-weight-bold">Jméno knihy:</label>    
                    <input value="';echo  $prefillValues['bookTitle'] ?? ''; echo '"maxlenght="100" type="text" id="bookTitleInput" name="bookTitle" class="form-control" placeholder="Perníková chaloupka">

                    <label for="AutorInput" class="form-label font-weight-bold">Jméno autora/autorky:</label>
                    <input value="';echo  $prefillValues['Autor'] ?? ''; echo '" maxlenght="100" type="text" id="AutorInput" name="Autor" class="form-control" placeholder="Kevin Mitnick">

                    <label for="GenreInput" class="form-label font-weight-bold">Žánr:</label>
                    <input value="';echo  $prefillValues['Genre'] ?? ''; echo '" maxlenght="100" type="text" id="GenreInput" name="Genre" class="form-control" placeholder="Fantasy">

                    <label for="Form" class="form-label font-weight-bold">Forma:</label>
                    <select name="forma" id="forma" class="fw-bold form-control">
                        <option value="beletrie" ' . $selectedBeletrie . '>Beletrie</option>
                        <option value="naucna" ' . $selectedNaucna . '>Naučná literatura</option>
                    </select>

                    <label for="DescriptionInput" class="form-label font-weight-bold">Popis:</label>
                    <input value="';echo  $prefillValues['Description'] ?? ''; echo '" maxlenght="1000" type="text" id="DescriptionInput" name="Description" class="form-control" placeholder="Kniho o Jeníčkovy a Mařence...">

                    <label for="imgLinkInput" class="form-label font-weight-bold">Odkaz na obálku knihy:</label>
                    <input value="';echo  $prefillValues['imgLink'] ?? ''; echo '"  maxlenght="150" type="text" id="imgLinkInput" name="imgLink" class="form-control" placeholder="https://priklad.cz/obrazek.jpg">     
                    
                    <label for="Price" class="form-label font-weight-bold">Cena:</label>
                    <input value="';echo  $prefillValues['price'] ?? ''; echo '"  maxlenght="11" type="number" id="Price" name="price" class="form-control" placeholder="399">
                    
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-outline-dark btn-sm px-3 bg-success " type="submit" >Přidat Knihu</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="' . url('/src/addBookCardPrefill.js') . '"></script>
    ';

    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($_GET['error'] == "missingFields") {
            echo '
                <div class="float-left col-xl-5 col-md-6 mt-3 mb-4">
                    <div class="text-center row no-gutters align-items-center">
                        <div class=" bg-danger rounded p-2 h5 mb-0 font-weight-bold text-gray-800">There were some fields missing</div>
                    </div>
                </div>
            ';
        } elseif ($error == 'BadSelect') {
            echo '
                <div class="float-left col-xl-5 col-md-6 mt-3 mb-4">
                    <div class="text-center row no-gutters align-items-center">
                        <div class=" bg-danger rounded p-2 h5 mb-0 font-weight-bold text-gray-800">You can only select Beletrie OR Naucna Literatura</div>
                    </div>
                </div>
            ';
        } elseif ($error == 'TextTooLong') {
            echo '
                <div class="float-left col-xl-5 col-md-6 mt-3 mb-4">
                    <div class="text-center row no-gutters align-items-center">
                        <div class=" bg-danger rounded p-2 h5 mb-0 font-weight-bold text-gray-800">Some of the text is too long</div>
                    </div>
                </div>
            ';
        } elseif ($error == 'FalsePrice') {
            echo '
                <div class="float-left col-xl-5 col-md-6 mt-3 mb-4">
                    <div class="text-center row no-gutters align-items-center">
                        <div class=" bg-danger rounded p-2 h5 mb-0 font-weight-bold text-gray-800">The price is bad</div>
                    </div>
                </div>
            ';
        } elseif ($error == 'BookDuplicate') {
            echo '
                <div class="float-left col-xl-5 col-md-6 mt-3 mb-4">
                    <div class="text-center row no-gutters align-items-center">
                        <div class=" bg-danger rounded p-2 h5 mb-0 font-weight-bold text-gray-800">This book is alredy in db</div>
                    </div>
                </div>
            ';
        }
    }

}

function listAllContentAdmin($showAddBookCard){
    global $db;
    include_once("include.php");
    $sql = "SELECT * FROM `cms-content`";
    $con = $db->prepare($sql);
    $con->execute();
    $data = $con->fetchAll(PDO::FETCH_ASSOC); 
    
    echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 container-fluid">';

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
                            <a class='btn btn-outline-dark btn-sm' href='"; echo url("/addBook?edit=$id"); echo "'>Upravit</a>
                        </div>
                    </div>
                </div>
        </div>";
    }
}
