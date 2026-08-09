<?php


function importToDb($db, $hash, $email){

    $sql = "INSERT INTO `cms-login`(`ID_login`, `email`, `password`) VALUES (null, :email, :pass)";
    $con = $db->prepare($sql);
    $con->bindValue(":email", $email, PDO::PARAM_STR);
    $con->bindValue(":pass", $hash, PDO::PARAM_STR);
    $con->execute();
}

function getHash($db, $email){
    $sql = "SELECT password FROM `cms-login` WHERE email = :email";
    $con = $db->prepare($sql);
    $con->bindValue(":email", $email, PDO::PARAM_STR);
    $con->execute();
    $data = $con->fetchAll(PDO::FETCH_ASSOC);

    return( $data[0]['password']);
}

function updateToDb($db, $hash, $email){

    $sql = "UPDATE `cms-login` SET `password` = :pass WHERE `email` = :email";
    $con = $db->prepare($sql);
    $con->bindValue(":email", $email, PDO::PARAM_STR);
    $con->bindValue(":pass", $hash, PDO::PARAM_STR);
    $con->execute();
}

function deleteAcc($db, $email){
    $time = date('Y-m-d');
    $afterEmail = "del_" . $time . "_" . $email;
    if (count_chars($afterEmail) > 150) {
        $afterEmail = substr($afterEmail, 0, 150);
    }

    $sql = "UPDATE `cms-login` SET `deleted` = 1, `email` = :afterEmail WHERE `email` = :oldEmail";
    $con = $db->prepare($sql);
    $con->bindValue(":oldEmail", $email, PDO::PARAM_STR);
    $con->bindValue(":afterEmail", $afterEmail, PDO::PARAM_STR);
    $con->execute();
}

function isActive($db, $email){
    $sql = "SELECT deleted FROM `cms-login` WHERE `email` = :email";
    $con = $db->prepare($sql);
    $con->bindValue(":email", $email, PDO::PARAM_STR);
    $con->execute();   
    $data = $con->fetchAll(PDO::FETCH_ASSOC);

    if ($data[0]['deleted'] == 1) {
        return False;
    } else{
        return TRUE;
    }
}

function isAdmin($email){
    global $db;

    $sql = "SELECT role FROM `cms-login` WHERE `email` = :email";
    $con = $db->prepare($sql);
    $con->bindValue(":email", $email, PDO::PARAM_STR);
    $con->execute();   
    $data = $con->fetchAll(PDO::FETCH_ASSOC);

    if ($data[0]['role'] == 'admin') {
        return TRUE;
    } else{
        return FALSE;
    }    
}

function searchJsonCreate() {
    global $db;
    $sql = "SELECT `ID_cms-content`, `title`, `autor` FROM `cms-content`";
    $con = $db->prepare($sql);
    $con->execute();   
    $data = $con->fetchAll(PDO::FETCH_ASSOC);

    $jsonString = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents("src/search-data.json", $jsonString);
}

function getGenres() {
    global $db;
    $sql = "SELECT `genre` FROM `cms-content`";
    $con = $db->prepare($sql);
    $con->execute();   
    $data = $con->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function getBookDetail($id) {
    global $db;

    $sql = "SELECT * FROM `cms-content` WHERE `ID_cms-content` = :id";
    $con = $db->prepare($sql);
    $con->bindValue(":id", $id, PDO::PARAM_STR);
    $con->execute();   
    $data = $con->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function getUserInfo($user){
    global $db;

    $sql = "SELECT * FROM `cms-login` WHERE `email` = :email";
    $con = $db->prepare($sql);
    $con->bindValue(":email", $user, PDO::PARAM_STR);
    $con->execute();   
    $data = $con->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function addCredits($user, $creditsBought) {
    global $db;

    $sql ="UPDATE `cms-login` SET `credits`=`credits` + :creditsBought WHERE `email` = :user";
    $con = $db->prepare($sql);
    $con->bindValue(":user", $user, PDO::PARAM_STR);
    $con->bindValue(":creditsBought", $creditsBought, PDO::PARAM_INT);
    $con->execute();

}

function checkBookAvailability($id) {
    global $db;

    $sql = "SELECT `availability` FROM `cms-content` WHERE `ID_cms-content` = :id;";
    $con = $db->prepare($sql);
    $con->bindValue(":id", $id, PDO::PARAM_STR);
    $con->execute();   
    $data = $con->fetchAll(PDO::FETCH_ASSOC);
    return($data[0]['availability']);
}

function bookBought($book_id, $email){
    global $db;
    require_once('../lib/include.php'); 

    $userInfo = getUserInfo($email);
    $detail = getBookDetail($book_id);

    $sql ="UPDATE `cms-content` SET `availability`=`availability` - 1 WHERE `ID_cms-content` = :id";
    $con = $db->prepare($sql);
    $con->bindValue(":id", $book_id, PDO::PARAM_STR);
    $con->execute();

    $sql ="UPDATE `cms-login` SET `credits`=`credits` - :price WHERE `ID_login` = :id";
    $con = $db->prepare($sql);
    $con->bindValue(":price", $detail[0]['price'], PDO::PARAM_INT);
    $con->bindValue(":id", $userInfo[0]['ID_login'], PDO::PARAM_STR);
    $con->execute();

    $sql = "INSERT INTO `cms-user_orders`(`ID_cms-user_orders`, `user_id`, `content_id`) VALUES (null, :user_id, :content_id)";
    $con = $db->prepare($sql);
    $con->bindValue(":user_id", $userInfo[0]['ID_login'], PDO::PARAM_INT);
    $con->bindValue(":content_id", $book_id, PDO::PARAM_INT);
    $con->execute();
}

function bookOrder($email, $password, $id) {
    global $db;
    require_once('../lib/include.php'); 

    $userInfo = getUserInfo($email);

    $hash = customHash($password, $email);
    if ($hash == getHash($db, $email)) {
        bookBought($id, $email);  
        header("Location: " . url("/?boughtSuccessfully")); 

    } else {
        header("Location: " . url("/order?title=$id&wrongPass"));
    }   


}

?>