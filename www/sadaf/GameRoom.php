<?php
    include "header.inc.php";
    include "classes/SystemFacilities.class.php";

    HTMLBegin();
    
    ?>
    <?php
     function isRoomManager(){
        $isManager=0;
        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.room where roomID = " . $_SESSION["id"];
        $res = $mysql->Execute($query); 
       while($rec = $res->fetch()){
           if($_SESSION["PersonID"]===$rec["managerID"]){
            
              $isManager=1;
               
    
          }
       }
        
        return $isManager;
    }
    function getPersons(){
        $results= array();
        $persons=array();
        $i=0;
        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.game where roomID = " . $_SESSION["id"];
        $query2 = "select * from sadaf.accountspecs";
        $res2 = $mysql->Execute($query2); 
        while($rec2 = $res2->fetch()){
            $persons[$i]=array($rec2["PersonID"],$rec2["UserID"]);
            $i=$i+1;

        }
         $copypersons=$persons;
        $res = $mysql->Execute($query); 
       while($rec = $res->fetch()){
        for($j=0;$j<count($persons);$j++){
            $is_recognize=false;
           if($persons[$j][0]===$rec["userID"]&& $is_recognize==false){
            unset($copypersons[$j]);
            $is_recognize=true;
               
    
          }
       }
    }
    $copypersons=array_values($copypersons);
    $results=$copypersons;
    $stOptions="";
    for($p=0;$p<count($results);$p++){
        $stOptions.="<option value='".$results[$p][1]."'>";
        $stOptions.=$results[$p][1];
        $stOptions.="</option>";

    }
    return $stOptions;
    }


    ?>
    <?php
     function addtoDataBase($v){
        $isManager=0;
        $i=0;
        $persons=array();
        $mysql = pdodb::getInstance();
        $query2 = "select * from sadaf.accountspecs";
        $res2 = $mysql->Execute($query2); 
        while($rec2 = $res2->fetch()){
            $persons[$i]=array($rec2["PersonID"],$rec2["UserID"]);
            $i=$i+1;

        }
        for($s=0;$s<count($persons);$s++){
            if($persons[$s][1]===$v){
                $idNew=$persons[$s][0];
            }
        }
        $query3="select * from sadaf.game_request";
        $res3 = $mysql->Execute($query3); 
        while($rec3 = $res3->fetch()){
            if(($rec3["roomID"]!=$_SESSION["id"])&&($rec3["userID"]!=$idNew)){
                $query = "insert ignore into sadaf.game_request (roomID, userID, status)
                values (".$_SESSION["id"].",".$idNew.", 'Waiting');";
                $mysql->Execute($query); 
            }
           
        }
        
     
        
    }
    
      
    ?>
    <?php
    if(isset($_REQUEST["Users"])&&isset($_REQUEST["ersal"])){
        addtoDataBase($_REQUEST["Users"]);
    }
    $mysql = pdodb::getInstance();
    if(isset($_REQUEST['exit'])){
        $ExitU = "ch_" . $_SESSION["PersonID"];
        if(isset($_REQUEST[$ExitU])){
            $query3 = "update sadaf.room set status ='Empty' where (roomID= " . $_SESSION["id"] .")and (managerID=".$_SESSION["PersonID"].")";
            $res3 = $mysql->Execute($query3);
            $query3 = "delete from sadaf.game where roomID =".$_SESSION["id"];
            $res3 = $mysql->Execute($query3);
            $query3 = "delete from sadaf.game_request where roomID =".$_SESSION["id"];
            $res3 = $mysql->Execute($query3);
        }
    }
    $RoomState = "State_" . $_SESSION["PersonID"];
    if(isset($_REQUEST[$RoomState])){
        if($_REQUEST[$RoomState] == "1"){
            $status = 'Accepting';
        }
        else if($_REQUEST[$RoomState] == "2"){
            $status = 'Playing';
        }
        else{
            $status = 'Empty';
            $query3 = "delete from sadaf.game where roomID =".$_SESSION["id"];
            $res3 = $mysql->Execute($query3);
            $query3 = "delete from sadaf.game_request where roomID =".$_SESSION["id"];
            $res3 = $mysql->Execute($query3);
        }
        $query3 = "update sadaf.room set status =\"".$status. "\"where (roomID= " . $_SESSION["id"] .")and (managerID=".$_SESSION["PersonID"].")";
        $res3 = $mysql->Execute($query3);
    }
    ?>


<form method="POST" >
<div class="container">
  
  <!-- Trigger the modal with a button -->
  <?php
  $isManager=isRoomManager();
  if($isManager===1){
      echo "<input type=\"hidden\" name=\"exit\" value=\"1\">";
      $ExitU = "ch_" . $_SESSION["PersonID"];
      $RoomState = "State_" . $_SESSION["PersonID"];
      echo "<div class=\"dropdown\">";
      echo "<button class=\"dropbtn\">وضعیت اتاق</button>";
      echo "<div class=\"dropdown-content\">";
      echo "<button href=\"#\" value=\"1\" name=\"".$RoomState."\">در حال پذیرش</button>";
      echo "<button href=\"#\" value=\"2\" name=\"".$RoomState."\">در حال بازی</button>";
      echo "<button href=\"#\" value=\"3\" name=\"".$RoomState."\">خالی</button>";
      echo "</div></div>";
      echo  "<button type=\"submit\" class=\"btn btn-danger btn-sm\" value =\"true\" name=\"".$ExitU."\" >خروج </button>";
      echo " <button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#myModal\">Send Invitation to your Freinds</button>" ;
  }
  elseif($isManager===0){
     
      $disabled="disabled";
    echo " <button type=\"button\" class=\"btn btn-success btn-sm\"".$disabled.">Send Invitation to your Freinds</button>" ;

  }
  ?>
 
 <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Send Invitation to your Freinds</button>-->
    <body>
    <html>
    <head>
        <style>
            /* Dropdown Button */
            .dropbtn {
                background-color: #4CAF50;
                color: white;
                padding: 10px;
                font-size: 14px;
                border: none;
            }

            /* The container <div> - needed to position the dropdown content */
            .dropdown {
                position: relative;
                display: inline-block;
            }

            /* Dropdown Content (Hidden by Default) */
            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f1f1f1;
                min-width: 10px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            /* Links inside the dropdown */
            .dropdown-content a {
                color: black;
                padding: 10px 12px;
                text-decoration: none;
                display: block;
            }

            /* Change color of dropdown links on hover */
            .dropdown-content a:hover {background-color: #ddd;}

            /* Show the dropdown menu on hover */
            .dropdown:hover .dropdown-content {display: block;}

            /* Change the background color of the dropdown button when the dropdown content is shown */
            .dropdown:hover .dropbtn {background-color: #3e8e41;}
        </style>
    </head>
    <body>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header align-right DivRtl">
         <h4 class="modal-title ">ارسال دعوت نامه</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
        <div class="row">
		<div class="col">
          <p> انتخاب لیست کاربران</p>
          <hr>
          <table class="table table-sm table-stripped table-bordered">
          <tr>
					
			<td>
            <select class="form-control sadaf-m-input" name="Users" id="Persons">
            <option value=0>-
            <? echo getPersons();?>
           
        </td>
        <td>
        <input type="submit" name="ersal" class="btn btn-primary" value="Send">
        </td>
        </tr>
        </select>
          </table>
        </div>
        </div>
        </div>
        <div class="modal-footer DivRtl">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>          
  
</div>   
</form>

   
    </body>
    </html>