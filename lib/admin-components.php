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

            <!-- Nav Item - Borrowed -->
            <li class="nav-item '; if($active == "borrowed") {echo 'active';} echo ' ">
                <a class="nav-link" href="' . url("/admin/borrowed?filter=borrowed") . '">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Borrowed</span></a>
            </li>



            <!-- Nav Item - Readers -->
            ';
            if (isset($_SESSION['user']) AND isAdmin($_SESSION['user'])) {
            echo '    
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">  
                <li class="nav-item '; if($active == "readers") {echo 'active';} echo ' ">
                    <a class="nav-link" href="' . url("/admin/readers") . '">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Readers</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Nav Item - settings -->
                <li class="nav-item '; if($active == "settings") {echo 'active';} echo ' ">
                    <a class="nav-link" href="' . url("/admin/settings") . '">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Settings</span></a>
                </li>
            ';      
            }

echo '



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
                                <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">' . $user . '</span>
                                    <img class="img-profile rounded-circle"
                                        src="img/undraw_profile.svg">
                                </a>
							       
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
    


    $deleted = [];
    $active = [];

    foreach ($data as $key => $value) {

        if ($value['deleted']) {
            $deleted[] = $value;
        }
        else {
            $active[] = $value;
        }
    }
    if (count($active) > 0) {
        echo "    
                <div class='d-flex justify-content-between align-items-end border-bottom pb-3 mt-5 mb-4'>
                    <div>
                        <h1 class='h3 fw-bold mb-1 text-secondary'>Aktivní</h1>
                    </div>
                </div>
        ";
        echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 container-fluid">';
        if ($showAddBookCard) {
            addBookCard();
        }
        foreach ($active as $key => $value) {

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
                                        if ($availability <= 0) {echo "<span class='badge text-bg-danger text-white bg-opacity-75'>Nedostupné</span>";} else { echo"<span class='badge text-bg-success text-white bg-opacity-75'> Dostupné ($availability)</span>";}
                                        echo "
                                        <a class='btn btn-outline-dark btn-sm' href='"; echo url("/admin/addBook?edit=$id"); echo "'>Upravit</a>
                                    </div>
                                    <div class=' mt-auto d-flex justify-content-between align-items-end'>
                                        <form class='mt-2 w-100' action='" . url("/backend/addBook-process.php?add=$id") . "' method='post'>
                                            <label for='available' class='form-label small fw-bold mb-1 d-block text-start'>Přidat/odebrat:</label>    

                                            <div class='input-group input-group-sm w-50'>
                                                <input value='";echo  $prefillValues['price'] ?? ''; echo "'  maxlenght='11' type='number' id='count' name='count' class='form-control w-25' placeholder='$availability'>      
                                                <button class='btn btn-outline-dark btn-sm px-3 bg-success ' type='submit' >Add</button>
                                            </div>
                                        </form>
                                        <form class='mt-2 w-auto float-right' action='" . url("/backend/addBook-process.php?delete=$id") . "' method='post'>
                                            <div class='input-group input-group-sm w-50'>
                                                <button name='delete' value='<?= $id ?>' class='btn btn-outline-dark btn-sm px-3 bg-danger ' type='submit' >Delete</button>
                                            </div>    
                                        </form>                        
                                    </div>
                                </div>
                            </div>
                    </div>
                ";
            
        }
        echo "</div>";
    }
    if (count($deleted) > 0) {
        echo "    
                <div class='d-flex justify-content-between align-items-end border-bottom pb-3 mt-5 mb-4'>
                    <div>
                        <h1 class='h3 fw-bold mb-1 text-secondary'>Smazané</h1>
                    </div>
                </div>
        ";
        echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 container-fluid">';
        foreach ($deleted as $key => $value) {

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
                
                echo "
                        <div class='col'>
                            <div class='card h-100 border-0 shadow-sm rounded-3'>
                                <div class='bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center text-muted' style='height: 220px;'>
                                    <img class='w-auto h-100 object-fit-cover' src='$imgLink' alt='bookcover'>
                                </div>
                                <div class='card-body d-flex flex-column'>
                                    <h2 class='card-title h6 fw-bold mb-1'>" . htmlspecialchars($title) . "</h2>
                                    <p class='card-text text-muted small mb-3'>" . htmlspecialchars($autor) . "</p>
                                    <div class='mt-auto d-flex justify-content-between align-items-center'>";
                                        if ($availability <= 0) {echo "<span class='badge text-bg-danger text-white bg-opacity-75'>Nedostupné</span>";} else { echo"<span class='badge text-bg-success text-white bg-opacity-75'> Dostupné ($availability)</span>";}
                                        echo "
                                        <a class='btn btn-outline-dark btn-sm' href='"; echo url("/admin/addBook?edit=$id"); echo "'>Upravit</a>
                                    </div>
                                    <div class=' mt-auto d-flex justify-content-between align-items-end'>
                                        <form class='mt-2 w-100' action='" . url("/backend/addBook-process.php?add=$id") . "' method='post'>
                                            <label for='available' class='form-label small fw-bold mb-1 d-block text-start'>Přidat/odebrat:</label>    

                                            <div class='input-group input-group-sm w-50'>
                                                <input value='";echo  $prefillValues['price'] ?? ''; echo "'  maxlenght='11' type='number' id='count' name='count' class='form-control w-25' placeholder='$availability'>      
                                                <button class='btn btn-outline-dark btn-sm px-3 bg-success ' type='submit' >Add</button>
                                            </div>
                                        </form>
                                        <form class='mt-2 w-auto float-right' action='" . url("/backend/addBook-process.php?addBack=$id") . "' method='post'>
                                            <div class='input-group input-group-sm w-auto'>
                                                <button name='add' value='<?= $id ?>' class='btn btn-outline-dark btn-sm px-3 bg-success ' type='submit' >Add back</button>
                                            </div>
                                        </form>                        
                                    </div>
                                </div>
                            </div>
                    </div>
                ";
            
        }
        echo "</div>";
    }
}

function editBookForm($book_id) {

    $bookDetails = getBookDetail($book_id);
    $prefillValues = $bookDetails[0];

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
                <form action="' . url("/backend/addBook-process.php?edit=$book_id") . '" method="post">
                    <label for="bookTitle" class="form-label font-weight-bold">Jméno knihy:</label>    
                    <input value="';echo  $prefillValues['title'] ?? ''; echo '"maxlenght="100" type="text" id="bookTitleInput" name="bookTitle" class="form-control" placeholder="Perníková chaloupka">

                    <label for="AutorInput" class="form-label font-weight-bold">Jméno autora/autorky:</label>
                    <input value="';echo  $prefillValues['autor'] ?? ''; echo '" maxlenght="100" type="text" id="AutorInput" name="Autor" class="form-control" placeholder="Kevin Mitnick">

                    <label for="GenreInput" class="form-label font-weight-bold">Žánr:</label>
                    <input value="';echo  $prefillValues['genre'] ?? ''; echo '" maxlenght="100" type="text" id="GenreInput" name="Genre" class="form-control" placeholder="Fantasy">

                    <label for="Form" class="form-label font-weight-bold">Forma:</label>
                    <select name="forma" id="forma" class="fw-bold form-control">
                        <option value="beletrie" ' . $selectedBeletrie . '>Beletrie</option>
                        <option value="naucna" ' . $selectedNaucna . '>Naučná literatura</option>
                    </select>

                    <label for="DescriptionInput" class="form-label font-weight-bold">Popis:</label>
                    <input value="';echo  $prefillValues['description'] ?? ''; echo '" maxlenght="1000" type="text" id="DescriptionInput" name="Description" class="form-control" placeholder="Kniho o Jeníčkovy a Mařence...">

                    <label for="imgLinkInput" class="form-label font-weight-bold">Odkaz na obálku knihy:</label>
                    <input value="';echo  $prefillValues['imgLink'] ?? ''; echo '"  maxlenght="150" type="text" id="imgLinkInput" name="imgLink" class="form-control" placeholder="https://priklad.cz/obrazek.jpg">     
                    
                    <label for="Price" class="form-label font-weight-bold">Cena:</label>
                    <input value="';echo  $prefillValues['price'] ?? ''; echo '"  maxlenght="11" type="number" id="Price" name="price" class="form-control" placeholder="399">
                    
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-outline-dark btn-sm px-3 bg-success " type="submit" >Potvrdit změny Knihu</button>
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

function readerTbody(){
$allFromCmsLogin = getAllFromCmsLogin();

    foreach ($allFromCmsLogin as $value) {
        $id = $value['ID_login'];
        $role = $value['role'];
        $credits = $value['credits'];
        $email = $value['email'];
        $isDeleted = $value['deleted'];

        echo '<tr>';
        echo '<td>' . $id . '</td>';
        echo '<td>' . htmlspecialchars($email) . '</td>';

        echo '<td class="text-center">';
        if ($isDeleted == 1) {
            echo '<span class="badge badge-danger mb-1 d-block">Smazán</span>';
        } else {
            echo '<a href="' . url('/backend/readersEdit.php?id=' . $id . '&action=delete') . '" class="btn btn-sm btn-outline-danger py-1 px-2" title="Smazat uživatele">
                    <i class="fas fa-trash-alt mr-1"></i> Smazat
                  </a>';
        }
        echo '</td>';
        
        echo '<td>
                <select name="users[' . $id . '][role]" class="form-control form-control-sm">
                    <option value="user" '; if($role == "user") { echo "selected";} echo '>user</option>
                    <option value="worker" '; if($role == "worker") { echo "selected";} echo '>worker</option>
                    <option value="admin" '; if($role == "admin") { echo "selected";} echo '>admin</option>
                </select>
              </td>';

        echo '<td>
                <input type="number" name="users[' . $id . '][credits]" class="form-control form-control-sm" value="' . $credits . '" min="0">
              </td>';
        
        echo '</tr>';
    }
}

function listAllBorrowedContent($toList, $userSearch, $bookSearch){
    require_once 'include.php';
    global $db;
    $borrowHistory = getAllBorrowHistory($toList);
    if ($userSearch !== '') {
        $userInfo = getUserInfo($userSearch);
    }
    if ($bookSearch !== '') {
        $bookDetail = getBookDetailByTitle($bookSearch);
    }

    $date = new DateTime();
    $cardsShown = 0;
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
    echo '<div class="container-fluid">';


    foreach ($borrowHistory as $item) {
        $userEmail = getUserInfoById($item['user_id'])[0]['email'];
        if (isset($userInfo) AND isset($bookDetail)) {
            if ($userSearch !== '' AND $bookSearch !== '') {
                if ($item['user_id'] == $userInfo[0]['ID_login'] AND $item['content_id'] == $bookDetail[0]['ID_cms-content']) {
                    if ($item['status'] == 'borrowed') {
                        $borrowed[] = $item;
                    } elseif ($item['status'] == 'returned') {
                        $returned[] = $item;
                    } elseif ($item['status'] == 'lost') {
                        $lost[] = $item;
                    }
                
                }
            }
        } elseif (isset($userInfo)) {  
                if ($item['user_id'] == $userInfo[0]['ID_login']) {
                    if ($item['status'] == 'borrowed') {
                        $borrowed[] = $item;
                    } elseif ($item['status'] == 'returned') {
                        $returned[] = $item;
                    } elseif ($item['status'] == 'lost') {
                        $lost[] = $item;
                    }
                }            
        } elseif (isset($bookDetail)) {
            if ($item['content_id'] == $bookDetail[0]['ID_cms-content']) {
                if ($item['status'] == 'borrowed') {
                    $borrowed[] = $item;
                } elseif ($item['status'] == 'returned') {
                    $returned[] = $item;
                } elseif ($item['status'] == 'lost') {
                    $lost[] = $item;
                } 
            }
        } else {
            if ($item['status'] == 'borrowed') {
                $borrowed[] = $item;
            } elseif ($item['status'] == 'returned') {
                $returned[] = $item;
            } elseif ($item['status'] == 'lost') {
                $lost[] = $item;
            } 
        }
    }



    if (count($borrowed) > 0) {
        echo "
        <div class='d-flex justify-content-between align-items-end border-bottom pb-3 mt-4 mb-4'>
            <div>
                <h1 class='h3 fw-bold mb-1'>Momentálně vypůjčené</h1>
            </div>
        </div>
        <div class='row'>";

        foreach ($borrowed as $value) {
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

            $userEmail = getUserInfoById($value['user_id'])[0]['email'];

            echo "
            <div class='col-auto mb-4'>
                <div class='card h-100 border-0 shadow-sm rounded-3'>
                    <div class='bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center text-muted' style='height: 220px;'>
                        <img class='w-auto h-100 object-fit-cover' src='$imgLink' alt='bookcover'>
                    </div>
                    <div class='card-body d-flex flex-column'>
                        <h2 class='card-title h6 fw-bold mb-1'>" . htmlspecialchars($title) . "</h2>
                        <p class='card-text text-muted small mb-3'>" . htmlspecialchars($autor) . "</p>
                        <div class='mt-auto d-flex justify-content-between align-items-center'>";
                            if ($date > $dueDate) {
                                $daysOverdue = $date->diff($dueDate)->days;
                                echo "<span class='badge text-bg-danger text-white bg-opacity-75 mr-3'>Po termínu: (" . $daysOverdue . ")</span>";
                            } else { 
                                echo "<span class='badge text-bg-success text-white bg-opacity-75 mr-3'>Vrátit do: " . $dueDate->format('d.m.Y') . " </span>";
                            }
                            echo '
                            <a class="btn btn-outline-dark btn-sm" href="' . url("/detail?id=$id") . '">Detail</a>
                        </div>
			<div class="mt-3 pt-2 border-top">
    				<div class="mb-2">
				        <span class="badge badge-info text-truncate w-100 py-1">
				            User: ' .  htmlspecialchars($userEmail) . '
				        </span>
				</div>
				<div class="row no-gutters">	
				        <div class="col-6 pr-1">
				            <a href="' .  url('/admin/order-action?action=lost&id=' . $order['ID_cms-user_orders'])  . '" class="btn btn-danger btn-sm btn-block">
				                Ztraceno
				            </a>
			        </div>
			        <div class="col-6 pl-1">
			            <a href="' .  url('/admin/order-action?action=return&id=' . $order['ID_cms-user_orders']) . '" class="btn btn-success btn-sm btn-block">
			                Vrátit
			            </a>
			        </div>
			</div>
		</div>';
            echo " 

                        </div>
                        </div>
                    </div>
                </div>
            </div>";
        }
        echo '</div>';
        $cardsShown++;
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

            $userEmail = getUserInfoById($value['user_id'])[0]['email'];

            echo "
            <div class='col'>
                <div class='card h-100 border-0 shadow-sm rounded-3'>
                    <div class='bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center text-muted' style='height: 220px;'>
                        <img class='w-auto h-100 object-fit-cover' src='$imgLink' alt='bookcover'>
                    </div>
                    <div class='card-body d-flex flex-column'>
                        <h2 class='card-title h6 fw-bold mb-1'>" . htmlspecialchars($title) . "</h2>
                        <p class='card-text text-muted small mb-3'>" . htmlspecialchars($autor) . "</p>
                        <div class='mt-auto d-flex justify-content-between align-items-center'>
                            <span class='badge text-bg-secondary text-white mr-3'>Vráceno</span>
                            <a class='btn btn-outline-dark btn-sm' href='" . url("/detail?id=$id") . "'>Detail</a>
                        </div>
                        <div class='mt-2 d-flex justify-content-between align-items-center'>
                            <span class='badge text-bg-info text-gray-800 bg-opacity-75'> User: " . htmlspecialchars($userEmail) . "</span>
                        </div>    
                    </div>
                </div>
            </div>";
        }  
        echo '</div>';
        $cardsShown++;
    }
    if (count($lost) > 0) {
        echo "
        <div class='d-flex justify-content-between align-items-end border-bottom pb-3 mt-5 mb-4'>
            <div>
                <h1 class='h3 fw-bold mb-1 text-secondary'>Ztracené</h1>
            </div>
        </div>
        <div class='row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-4'>";

        foreach ($lost as $value) {
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

            $userEmail = getUserInfoById($value['user_id'])[0]['email'];

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
                            <span class='badge text-bg-secondary text-white mr-3'>Ztraceno</span>
                            <a class='btn btn-outline-dark btn-sm' href='" . url("/detail?id=$id") . "'>Detail</a>
                        </div>
                        <div class='mt-2 d-flex justify-content-between align-items-center'>
                            <span class='badge text-bg-info text-gray-800 bg-opacity-75'> User: " . htmlspecialchars($userEmail) . "</span>
                        </div>    
                    </div>
                </div>
            </div>";
        }  
        echo '</div>';
        $cardsShown++;
    }
    if ($cardsShown <= 0) {
        echo "
    
            <div class='d-flex justify-content-between align-items-end border-bottom pb-3 mt-4 mb-4'>
                <div>
                    <h1 class='h3 fw-bold mb-1'>Nic jsme nenašli</h1>
                </div>
            </div>
            <div class='row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-4'>
            </div>
        ";
    }

    echo '</div>';
}
