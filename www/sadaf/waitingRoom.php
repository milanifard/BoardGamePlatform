    <?php
    include "header.inc.php";
    HTMLBegin();

    ?>
    <?php
    function getWaitingPeople(){
        $results=array();
        $game=array();
        $persons=array();
        $copypersons=array();
        $i=0;
        $j=0;
        $t=0;
        $is_recognize=false;
        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.accountspecs";
        $query2 = "select * from sadaf.game";
        $res = $mysql->Execute($query);
        $res2 = $mysql->Execute($query2);
        while($rec = $res->fetch()){
         $persons[$i]=array($rec["UserID"],$rec["PersonID"]);
         $i=$i+1;
        }

        while($rec2 = $res2->fetch()){
            $game[$j]=$rec2["userID"];
            $j=$j+1;
        }
        $copypersons=$persons;
        
        for($p=0;$p<count($persons);$p++){
            $is_recognize=false;
            for($g=0;$g<count($game)&&$is_recognize==false;$g++){
                if($persons[$p][1]===$game[$g]){
                   
                    unset($copypersons[$p]);
                   // $results[$t]=array($persons[$p][0],$persons[$p][1]);
                    $is_recognize=true;
                    //$t=$t+1;
                   
                }
            }
        }
        $copypersons=array_values($copypersons);
        $results=$copypersons;
        
    return $results; 
    }
    ?>
    <form method="POST">
        <input type="hidden" name="EnterWaitingRoom" value="1">
        <table class="table table-sm table-bordered table-striped">
            <tr>
                <th>نام کاربر</th> 
                <th>شماره کاربر</th>   
            </tr>
    <?php
        $Peoples =getWaitingPeople();
        for($i=0;$i<count($Peoples);$i++){
            echo "<tr>
            <td>".$Peoples[$i][0]."</td>
            <td>".$Peoples[$i][1]."</td>
            
            </tr>";
        }
        
    ?>
    </table>
    </form>

    </body>
    </html>