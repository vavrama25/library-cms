<?php
function emailPrefill(){
    if (isset($_SESSION['email'])) {
        echo "value='$_SESSION[email]'";
    }
}


function logOutBTN() {
    echo '<br><a href=' . url('CMS/login?logOut') . '>Log out</a>';
}

function loginCheck(){
    if (isset($_COOKIE['PHPSESSID'])){
        if (isset($_SESSION[$_COOKIE['PHPSESSID']]) AND !empty($_SESSION[$_COOKIE['PHPSESSID']])) {
            if ($_SESSION[$_COOKIE['PHPSESSID']] !== "logged in") {
                header("Location: " . url("CMS/login"));
                exit;
            }
        } else {
            header("Location: " . url("CMS/login"));
            exit;
        }
    } else {
       header("Location: " . url("CMS/login"));
       exit;
    }
}

function checkInactivity() {
    $timeout = 30;

    if (isset($_SESSION['last_activity'])) {
        if (time() - $_SESSION['last_activity'] > $timeout) {
            session_unset();
            session_destroy();
            header("Location: " . url('CMS/login?sessionExpired'));
            exit;
        }
    }

    $_SESSION['last_activity'] = time();
}

function StringAfterCharacterStrip($string, $char){ 
    $position = strpos($string, $char);
    if ($position !== false) {
        $result = substr($string, 0, $position);
        return $result;
    } else {
        return $string;
    }
}



?>