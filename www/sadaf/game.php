<?php
include "header.inc.php";
HTMLBegin();


if(isset($_REQUEST["EnterRoom"])){
    $mysql = pdodb::getInstance();
    $query = "select * from sadaf.room where roomID < 100";
    $res = $mysql->Execute($query);
    while($rec = $res->fetch()){
        $ChGameID = "ch_" . $rec["roomID"]; 
        $IdGame=$rec["roomID"];
        if(isset($_REQUEST[$ChGameID])){    
            if($rec["managerID"]==""){
                $query = "update sadaf.room set managerID = " . $_SESSION["PersonID"] . " where roomID= " . $rec["roomID"];
                $res = $mysql->Execute($query);
                $query2 = "insert into sadaf.game (roomID, userID) values (?,?)";
                $mysql->Prepare($query2);
                $mysql->ExecuteStatement(array($rec["roomID"], $_SESSION["PersonID"]));
            }
            $action ="splendor.php"; 
            $_SESSION["id"]=$IdGame;
        }
    }
}
?>

<?php 

function getRoomStatus(){
    $mysql = pdodb::getInstance();
    $query = "select * from sadaf.game where userID = " . $_SESSION["PersonID"];
    $res = $mysql->Execute($query); 
    while($rec = $res->fetch()){
        return $rec["roomID"];
    }
    return -1;
}

?> 
	
<form method="POST" action= "<?php echo $action ?>">
    <input type="hidden" name="EnterRoom" value="1">
    <table class="table table-sm table-bordered table-striped">
        <tr>
            <th>شماره اتاق</th>
            <th>نام مدیر</th> 
            <th>وضعیت</th> 
            <th>ورود</th>
            <th>کاربران حاضر</th>
        </tr>
    <?php
        ini_set("error_reporting", E_All);
        
        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.room where roomID < 100";
        $res = $mysql->Execute($query);
        while($rec = $res->fetch()){
            $disabled = "";
            echo  "<tr><td>" . $rec["roomID"] . "</td>";
            if($rec["managerID"] == ""){
                echo  "<td>ندارد</td>";
            }
            else{
                $query2 = "select UserID from sadaf.accountspecs where PersonID = " . $rec["managerID"];
                $res2 = $mysql->Execute($query2);
                while($rec2 = $res2->fetch()){
                    $admin =  $rec2["UserID"];
                }
                if($_SESSION["PersonID"] != $rec["managerID"]){
                    $sw = 1;
                    $query2 = "select * from sadaf.game_request where userID = " . $_SESSION["PersonID"];
                    $res2 = $mysql->Execute($query2); 
                    while($rec2 = $res2->fetch()){
                        if($rec2["roomID"] == $rec["roomID"]){
                            if($rec2["status"] == "Accepted")
                                $sw = 0;
                        }
                    }
                    if($sw == 1)
                        $disabled = "disabled";
                }
                echo  "<td>" . $admin . "</td>";
            }
            echo  "<td>" . $rec["status"] . "</td>";
            $ChGameID = "ch_" . $rec["roomID"]; 
            
            echo "<td><input type=\"submit\" class=\"btn btn-success btn-sm\" name=\"" .  $ChGameID . "\" value=\"ورود\"" . $disabled . "></td>";
        
            $query2 = "select * from sadaf.game where roomID = " . $rec["roomID"];
            $res2 = $mysql->Execute($query2);
            $members = "";
            while($rec2 = $res2->fetch()){
                $query3 = "select UserID from sadaf.accountspecs where PersonID = " . $rec2["userID"];
                $res3 = $mysql->Execute($query3);
                while($rec3 = $res3->fetch()){
                    $admin =  $rec3["UserID"];
                }
                $members = $members . " " . $admin;
            }
            echo  "<td>" . $members . "</td></tr>";
            
        }
    ?>
    </table>
</form>

</body>
</html>