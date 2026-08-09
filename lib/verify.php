<?php


function duplicateVerify($db, $email){

    $sql = "SELECT email FROM `cms-login`";
    $con = $db->prepare($sql);
    $con->execute();
    $data = $con->fetchAll(PDO::FETCH_ASSOC);

    if (count($data) > 0) {
        foreach($data as $key => $value){
            if ($value['email'] == $email){

                $response = "email alredy exists";
                break;
            } else{
                $response = "OK";
            }

        }
    } else {
        $response = "OK";
    }

    return ($response);

}

function emailVerify($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return True;
    }
}

function passVerify($password){
    $specialChars = preg_match('@[^\w]@', $password);
    $number = preg_match('@[0-9]@', $password);

    
    if(strlen($password) < 12 || !$number || !$specialChars) {
        $answer = "Password must have at least 12 character length with 1 number and 1 special characters.";
    } else {
        $answer = "OK";
    }

    return($answer);
}

?>