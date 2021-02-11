<?php
include "header.inc.php";
HTMLBegin();
if(isset($_REQUEST["RequestCheck"])){
    $mysql = pdodb::getInstance();
    $query = "select * from sadaf.game_request where (userID =".$_SESSION["PersonID"].")and (status='Waiting')";
    $res = $mysql->Execute($query);
    while($rec = $res->fetch()){
        $ChGameID = "ch_" . $rec["roomID"];
//        echo $_REQUEST[$ChGameID];
        if(isset($_REQUEST[$ChGameID])){
            if($_REQUEST[$ChGameID] == 'پذیرش'){
                $query2 = "insert into sadaf.game (roomID, userID) values (?,?)";
                $mysql->Prepare($query2);
                $mysql->ExecuteStatement(array($rec["roomID"], $rec['userID']));

                $query3 = "update sadaf.game_request set status ='Accepted' where (roomID= " . $rec["roomID"] .")and (userID=".$rec['userID'].")";
                $res3 = $mysql->Execute($query3);
            }
            else{
                $query3 = "update sadaf.game_request set status ='Denied' where (roomID= " . $rec["roomID"] .")and (userID=".$rec['userID'].")";
                $res3 = $mysql->Execute($query3);
            }
        }
    }
}
?>
<body>
<html>

<form method="post">
    <input type="hidden" name="RequestCheck" value="1">
    <table class="table table-sm table-bordered table-striped">
        <tr>
            <th>شماره اتاق</th>
            <th>مدیر اتاق</th>
            <th>&nbsp;</th>
        </tr>
        <?php
        ini_set("error_reporting", E_All);

        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.game_request where (userID =".$_SESSION["PersonID"].")and (status='Waiting')";
        $res = $mysql->Execute($query);
        while($rec = $res->fetch()){
            echo "<tr><td>" . $rec["roomID"] . "</td>";
            $query2 = "select managerID from sadaf.room where (roomID=".$rec['roomID'].")";
            $res2 = $mysql->Execute($query2);
            while($rec2 = $res2->fetch()){
                $admin =  $rec2["managerID"];
            }
            echo "<td>".$admin."</td>";
            $ChGameID = "ch_" . $rec["roomID"];
            echo "<td>";
            echo "<input type=\"submit\" class=\"btn btn-danger btn-sm \" value=\"رد\" name=\"".$ChGameID."\">";
            echo "<input type=\"submit\" class=\"btn btn-success btn-sm\" value=\"پذیرش\" name=\"".$ChGameID."\">";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</form>
</html>
</body>