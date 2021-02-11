

<?php 
    //  1
    // create 99 room
    include "header.inc.php";

    $mysql = pdodb::getInstance();
    $query = "insert into sadaf.room (status) values (?)";
    $mysql->Prepare($query);
    
    for($x = 0; $x < 99; $x++){
        $mysql->ExecuteStatement(array("empty"));
    }
?>