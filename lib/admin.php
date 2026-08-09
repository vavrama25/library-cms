<?php

function activeUsersTable($db){
    $sql = "SELECT `ID_login`, `email`, `admin` FROM `cms-login` WHERE `deleted` = 0";
    $con = $db->prepare($sql);
    $con->execute();   
    $data = $con->fetchAll(PDO::FETCH_ASSOC);


    return $data;
}

function deletedUsersTable($db){
    $sql = "SELECT `ID_login`, `email`, `admin` FROM `cms-login` WHERE `deleted` = 1";
    $con = $db->prepare($sql);
    $con->execute();   
    $data = $con->fetchAll(PDO::FETCH_ASSOC);


    return $data;
}

function usersTableGen($data){
        echo "<div class='table'>";
            echo "<div class='row'>";
        foreach ($data[0] as $klic => $var) {
            echo "<div class='column-name'>" . $klic . "</div>";
        }
            echo "</div>";
        
        foreach ($data as $key => $value) {
            echo '<div class="row">';

            foreach ($value as $key => $value) {
                if ($key == 'ID_zaci_secured'){
                    $id = $value;
                }
                echo "<div class='cell'>$value</div>";
            }
            echo '</div>';
        

        }
        echo "</div>";
}

?>