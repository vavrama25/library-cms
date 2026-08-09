<?php
    function tokenGenerator() {
        $bytes = random_bytes(20);
        $token = hash('sha384', $bytes);

        return($token);
    } 

    function linkGenerator($token, $email) {
        $link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "?token=$token&email=$email";

        return($link);
    }
    function tokenMatch($tokenPost, $email, $db) {
        $sql = 'SELECT token FROM `cms-reset_pass` WHERE email = :email';
        $con = $db->prepare($sql);
        $con->bindValue(':email', $email, PDO::PARAM_STR);
        $con->execute();
        $data = $con->fetchAll(PDO::FETCH_ASSOC);

        if ($data[0]['token'] == $tokenPost) {
            return(True);
        } else {
            return(False);
        }

    }

    function ResetPassForm($email) {
        echo "
        <div class='form-wrapper'>
            <h1 class='h1'>Password reset for $email</h1>

            <form class='form' action= " . url('CMS/cantLogIn-process?submit') . " method='post'>

                <label for='password'>Password</label><br>
                <input class='input' type='password' name='password' id='password' placeholder='Password...'><br>

                <label for='password-confirmation'>password-confirmation</label><br>
                <input class='input' type='password' name='password-confirmation' id='password-confirmation' placeholder='Password...'><br>


                <button type='submit'>Submit</button>
                    
            </form>
        
        </div>
        ";
    }

    function saveTokenToDb($db, $email, $token) {
        $sql = "INSERT INTO `cms-reset_pass`(`ID_reset_pass`, `email`, `token`) VALUES (null, :email, :token)";
        $con = $db->prepare($sql);
        $con->bindValue(":email", $email, PDO::PARAM_STR);
        $con->bindValue(":token", $token, PDO::PARAM_STR);
        $con->execute();
    }

function tokenDbCleanUp($db, $email) {
    $sql1 = "DELETE FROM `cms-reset_pass` WHERE date < NOW() - INTERVAL 5 MINUTE";
    $con1 = $db->prepare($sql1);
    $con1->execute();
}
?>