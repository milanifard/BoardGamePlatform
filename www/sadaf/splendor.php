<?php
include "header.inc.php";
include "gameClasses/Player.php";
include "gameClasses/Card.php";
//include "JsFile.js";

HTMLBegin();

if(isset($_REQUEST["ChatSubmit"])){
    $message= $_POST['message'];
    $mysql = pdodb::getInstance();
    $query = "insert into sadaf.chat (roomID, userID, msg) values (?,?,?)";
    $mysql->Prepare($query);
    $mysql->ExecuteStatement(array($_SESSION["id"], $_SESSION["PersonID"], $message));
}

$bankRedTokens = 7;
$bankBlueTokens = 7;
$bankGreenTokens = 7;
$bankWhiteTokens = 7;
$bankBrownTokens = 7;
$bankGoldenTokens = 5;


$cards= array();
$turn =0;
$flag = 1;
$players= array();

$cardOne=0;
$cardTwo=10;
$cardThree=20;
$cardPrince=30;

$imageSelectedId = 0;

//ini_set("error_reporting", E_All);
$mysql = pdodb::getInstance();
$query = "SELECT userID FROM sadaf.game where roomID=?;";
$mysql->Prepare($query);
// which room we choose (fatemeh bayad bezane)
$res = $mysql->ExecuteStatement(array(1) );
while($rec = $res->fetch()){
    if($flag==1) {
        array_push($players, new player($rec["userID"],0,0,0,0,
            0,0,0,0,0,0,0,
            0,0,0,0,0));

//        echo $rec["userID"];
    }
}

array_push($cards, new Card(1,1,1,1,1,0,
    0,0,1,"images/our/cards/1/1.png",1));

array_push($cards, new Card(2,1,2,1,1,0,
    0,0,1,"images/our/cards/1/2.png",1));
array_push($cards, new Card(3,0,2,1,0,1,
    0,0,1,"images/our/cards/1/3.png",1));

array_push($cards, new Card(4,1,1,0,2,0,
    0,0,1,"images/our/cards/1/17.png",2));
array_push($cards, new Card(5,0,1,1,1,0,
    0,0,1,"images/our/cards/1/18.png",2));
array_push($cards, new Card(6,0,0,1,3,0,
    0,0,1,"images/our/cards/1/20.png",2));

array_push($cards, new Card(7,1,0,2,1,0,
    0,0,1,"images/our/cards/1/31.png",4));

array_push($cards, new Card(8,1,1,1,0,1,
    0,0,1,"images/our/cards/1/34.png",4));

array_push($cards, new Card(9,0,0,2,0,2,
    0,0,1,"images/our/cards/1/46.png",3));

array_push($cards, new Card(10,2,0,2,1,0,
    0,0,1,"images/our/cards/1/30.png",5));



//2
array_push($cards, new Card(11,0,2,3,3,0,
    0,2,2,"images/our/cards/1/35.png",3));

array_push($cards, new Card(12,3,0,0,0,3,
    0,2,2,"images/our/cards/1/25.png",4));

array_push($cards, new Card(13,2,0,2,3,0,
    0,2,2,"images/our/cards/1/18.png",5));

array_push($cards, new Card(14,0,0,3,3,0,
    0,1,2,"images/our/cards/1/10.png",2));

array_push($cards, new Card(15,3,0,3,0,0,
    0,1,2,"images/our/cards/1/6.png",1));

array_push($cards, new Card(16,3,2,0,0,0,
    0,1,2,"images/our/cards/1/1.png",1));

array_push($cards, new Card(17,0,0,0,3,3,
    0,2,2,"images/our/cards/1/22.png",4));

array_push($cards, new Card(18,2,0,0,3,0,
    0,1,2,"images/our/cards/1/33.png",3));

array_push($cards, new Card(19,2,0,0,3,2,
    0,2,2,"images/our/cards/1/19.png",5));
array_push($cards, new Card(20,0,3,2,3,0,
    0,3,2,"images/our/cards/1/28.png",4));


//type 3
array_push($cards, new Card(21,6,4,0,0,0,
    0,3,3,"images/our/cards/3/1.png",1));

array_push($cards, new Card(22,5,0,3,4,0,
    0,3,3,"images/our/cards/3/22.png",4));

array_push($cards, new Card(23,6,0,3,0,0,
    0,3,3,"images/our/cards/3/30.png",3));

array_push($cards, new Card(24,5,4,0,0,0,
    0,3,3,"images/our/cards/3/17.png",5));

array_push($cards, new Card(25,0,0,0,5,5,
    0,3,3,"images/our/cards/3/10.png",2));

array_push($cards, new Card(26,0,4,0,6,0,
    0,3,3,"images/our/cards/3/26.png",3));
$flag = 0;

//echo $cards[0]->imageLink;
if(array_key_exists('btn1', $_POST)){
    function1($players, $turn);
    $turn = $_SESSION['turn'];
    $turn = ($turn++)%count($players);
    $_SESSION['turn'] = $turn;
}

function function1($array, $tu)
{
    if(isset($_POST['orange'])){
        $array[$tu]->f1('orange');
    }
    if(isset($_POST['blue'])){
        $array[$tu]->f1('blue');
    }
    if(isset($_POST['green'])){
        $array[$tu]->f1('green');
    }
    if(isset($_POST['darkBlue'])){
        $array[$tu]->f1('darkBlue');
    }
    if(isset($_POST['pink'])){
        $array[$tu]->f1('pink');
    }
}

if(array_key_exists('btn2', $_POST)){
    function2($players, $turn);
    $turn = $_SESSION['turn'];
    $turn = ($turn++)%count($players);
    $_SESSION['turn'] = $turn;
}

function function2($array, $tu)
{
    if(isset($_POST['orange'])){
        $array[$tu]->f1('orange');
        $array[$tu]->f1('orange');
    }
    if(isset($_POST['blue'])){
        $array[$tu]->f1('blue');
        $array[$tu]->f1('blue');
    }
    if(isset($_POST['green'])){
        $array[$tu]->f1('green');
        $array[$tu]->f1('green');
    }
    if(isset($_POST['darkBlue'])){
        $array[$tu]->f1('darkBlue');
        $array[$tu]->f1('darkBlue');
    }
    if(isset($_POST['pink'])){
        $array[$tu]->f1('pink');
        $array[$tu]->f1('pink');
//        echo $array[$tu]->pinkTokens;
    }
}

if(array_key_exists('image1', $_REQUEST)){
//    echo "aa";
//    $imageSelectedId = $_SESSION['imageSelectedId'];
    $imageSelectedId = $cards[$cardOne]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardOne = $_SESSION['cardOne'];
        $cardOne++;
        $_SESSION['cardOne'] = $cardOne;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardOne = $_SESSION['cardOne'];
        $cardOne++;
        $_SESSION['cardOne'] = $cardOne;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}

if(array_key_exists('image2', $_REQUEST)){
//    $imageSelectedId = $_SESSION['imageSelectedId'];
    $imageSelectedId = $cards[$cardOne+1]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardOne = $_SESSION['cardOne'];
        $cardOne++;
        $_SESSION['cardOne'] = $cardOne;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardOne = $_SESSION['cardOne'];
        $cardOne++;
        $_SESSION['cardOne'] = $cardOne;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
//    $counter++;
//    echo $imageSelectedId;
//    function3($players, $turn, $imageSelectedId, $cards);
}

if(array_key_exists('image3', $_REQUEST)){
//    $imageSelectedId = $_SESSION['imageSelectedId'];
    $imageSelectedId = $cards[$cardOne+2]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $cardOne = $_SESSION['cardOne'];
        $cardOne++;
        $_SESSION['cardOne'] = $cardOne;
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardOne = $_SESSION['cardOne'];
        $cardOne++;
        $_SESSION['cardOne'] = $cardOne;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardOne = $_SESSION['cardOne'];
        $cardOne++;
        $_SESSION['cardOne'] = $cardOne;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }

}

if(array_key_exists('image4', $_REQUEST)){
    $imageSelectedId = $cards[$cardOne+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardOne = $_SESSION['cardOne'];
        $cardOne++;
        $_SESSION['cardOne'] = $cardOne;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardOne = $_SESSION['cardOne'];
        $cardOne++;
        $_SESSION['cardOne'] = $cardOne;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}

if(array_key_exists('image5', $_REQUEST)){
    $imageSelectedId = $cards[$cardTwo+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardTwo = $_SESSION['cardTwo'];
        $cardTwo++;
        $_SESSION['cardTwo'] = $cardTwo;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardTwo = $_SESSION['cardTwo'];
        $cardTwo++;
        $_SESSION['cardTwo'] = $cardTwo;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}

if(array_key_exists('image6', $_REQUEST)){
    $imageSelectedId = $cards[$cardTwo+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardTwo = $_SESSION['cardTwo'];
        $cardTwo++;
        $_SESSION['cardTwo'] = $cardTwo;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardTwo = $_SESSION['cardTwo'];
        $cardTwo++;
        $_SESSION['cardTwo'] = $cardTwo;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}

if(array_key_exists('image7', $_REQUEST)){
    $imageSelectedId = $cards[$cardTwo+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardTwo = $_SESSION['cardTwo'];
        $cardTwo++;
        $_SESSION['cardTwo'] = $cardTwo;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardTwo = $_SESSION['cardTwo'];
        $cardTwo++;
        $_SESSION['cardTwo'] = $cardTwo;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}

if(array_key_exists('image8', $_REQUEST)){
    $imageSelectedId = $cards[$cardTwo+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardTwo = $_SESSION['cardTwo'];
        $cardTwo++;
        $_SESSION['cardTwo'] = $cardTwo;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardTwo = $_SESSION['cardTwo'];
        $cardTwo++;
        $_SESSION['cardTwo'] = $cardTwo;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}

if(array_key_exists('image9', $_REQUEST)){
    $imageSelectedId = $cards[$cardThree+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardThree = $_SESSION['cardThree'];
        $cardThree++;
        $_SESSION['cardThree'] = $cardThree;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardThree = $_SESSION['cardThree'];
        $cardThree++;
        $_SESSION['cardThree'] = $cardThree;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}

if(array_key_exists('image10', $_REQUEST)){
    $imageSelectedId = $cards[$cardThree+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardThree = $_SESSION['cardThree'];
        $cardThree++;
        $_SESSION['cardThree'] = $cardThree;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardThree = $_SESSION['cardThree'];
        $cardThree++;
        $_SESSION['cardThree'] = $cardThree;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}

if(array_key_exists('image11', $_REQUEST)){
    $imageSelectedId = $cards[$cardThree+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardThree = $_SESSION['cardThree'];
        $cardThree++;
        $_SESSION['cardThree'] = $cardThree;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardThree = $_SESSION['cardThree'];
        $cardThree++;
        $_SESSION['cardThree'] = $cardThree;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}

if(array_key_exists('image12', $_REQUEST)){
    $imageSelectedId = $cards[$cardThree+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardThree = $_SESSION['cardThree'];
        $cardThree++;
        $_SESSION['cardThree'] = $cardThree;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardThree = $_SESSION['cardThree'];
        $cardThree++;
        $_SESSION['cardThree'] = $cardThree;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}

if(array_key_exists('image13', $_REQUEST)){
    $imageSelectedId = $cards[$cardPrince+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardPrince = $_SESSION['cardPrince'];
        $cardPrince++;
        $_SESSION['cardPrince'] = $cardPrince;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardPrince = $_SESSION['cardPrince'];
        $cardPrince++;
        $_SESSION['cardPrince'] = $cardPrince;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}
if(array_key_exists('image14', $_REQUEST)){
    $imageSelectedId = $cards[$cardPrince+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardPrince = $_SESSION['cardPrince'];
        $cardPrince++;
        $_SESSION['cardPrince'] = $cardPrince;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardPrince = $_SESSION['cardPrince'];
        $cardPrince++;
        $_SESSION['cardPrince'] = $cardPrince;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}

if(array_key_exists('image15', $_REQUEST)){
    $imageSelectedId = $cards[$cardPrince+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardPrince = $_SESSION['cardPrince'];
        $cardPrince++;
        $_SESSION['cardPrince'] = $cardPrince;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardPrince = $_SESSION['cardPrince'];
        $cardPrince++;
        $_SESSION['cardPrince'] = $cardPrince;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}

if(array_key_exists('image16', $_REQUEST)){
    $imageSelectedId = $cards[$cardPrince+3]->id;
    $_SESSION['imageSelectedId'] = $imageSelectedId;
    if(array_key_exists('btn3', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        function3($players, $turn, $imageSelectedId, $cards);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardPrince = $_SESSION['cardPrince'];
        $cardPrince++;
        $_SESSION['cardPrince'] = $cardPrince;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
    if(array_key_exists('btn4', $_POST)) {
        $imageSelectedId = $_SESSION['imageSelectedId'];
        $players[$turn]->buyTheCard($cards[$imageSelectedId]);
        $_SESSION['imageSelectedId'] = $imageSelectedId;
        $cardPrince = $_SESSION['cardPrince'];
        $cardPrince++;
        $_SESSION['cardPrince'] = $cardPrince;
        $turn = $_SESSION['turn'];
        $turn = ($turn++)%count($players);
        $_SESSION['turn'] = $turn;
    }
}


function function3($array, $tu, $cardId, $cards)
{
    $array[$tu]->reserveACard($cards[$cardId]);
//    echo $cardId;
}

function imageClick($imageSelectedId,$cards, $cardOne, $counter){
//    $imageSelectedId = $_SESSION['imageSelectedId'];
//    echo $imageSelectedId;
//    $cards = $_SESSION['cards'];
//    $cardOne = $_SESSION['cardOne'];
    $imageSelectedId."' = '".$cards[$cardOne+$counter]->id;
//    $_SESSION['imageSelectedId'] = $imageSelectedId;
}
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
    $query = "insert into sadaf.game_request (roomID, userID, status)
                values (".$_SESSION["id"].",".$idNew.", 'Waiting');";
    $mysql->Execute($query);



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
        $query3 = "update sadaf.room set status ='Empty' , managerID = NULL where (roomID= " . $_SESSION["id"] .")and (managerID=".$_SESSION["PersonID"].")";
        $res3 = $mysql->Execute($query3);
        $query3 = "delete from sadaf.game where roomID =".$_SESSION["id"];
        $res3 = $mysql->Execute($query3);
        $query3 = "delete from sadaf.game_request where roomID =".$_SESSION["id"];
        $res3 = $mysql->Execute($query3);
    }
    $action = "game.php";
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
<form method="POST" action= "<?php echo $action ?>">
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
            echo " <button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#myModal\">Send Invitation to your Freinds</button>" ;
        }
        elseif($isManager===0){

            $disabled="disabled";
            echo " <button type=\"button\" class=\"btn btn-success btn-sm\"".$disabled.">Send Invitation to your Freinds</button>" ;

        }
        ?>

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

<script src="JsFile.js"></script>

<form  action="" method="POST">
    <input type="hidden" name="ChatSubmit" value="1">
    <div style="display:flex; flex-direction:row">
        <table class="table table-sm table-bordered table-striped" style="width:80%">
            <tr>
                <td>انتخاب ۳ الماس </td>
                <td>انتخاب ۲ الماس همرنگ</td>
                <td>رزرو یک کارت پیشرفت و دریافت ۱ الماس طلا</td>
                <td>خرید یکی از کارت‌های وسط میز</td>
                <td>خرید یکی از کارت‌هایی که رزرو کرده</td>
            </tr>
            <tr>
                <td>
                    <table >
                        <tr>
                            <td>orange</td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/orange2.png" ></td>
                            <td><input type="checkbox" name="orange" id="orange" onclick="select1(this.id)"></td>
                        </tr>
                        <tr>
                            <td>blue</td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/blue2.png" ></td>
                            <td><input type="checkbox" name="blue" id="blue" onclick="select1(this.id)"></td>
                        </tr>
                        <tr>
                            <td>green</td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/green2.png" ></td>
                            <td><input type="checkbox" name="green" id="green" onclick="select1(this.id)"></td>
                        </tr>
                        <tr>
                            <td>dark blue</td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/dark_blue2.png" ></td>
                            <td><input type="checkbox" name="darkBlue" id="darkBlue" onclick="select1(this.id)"></td>
                        </tr>
                        <tr>
                            <td>pink</td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/pink2.png" ></td>
                            <td><input type="checkbox" name="pink" id="pink" onclick="select1(this.id)"></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table >
                        <tr>
                            <td>orange</td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/orange2.png" ></td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/orange2.png" ></td>
                            <td><input type="checkbox" name="orange" id="orange1"  onclick="select2(this.id)"></td>
                        </tr>
                        <tr>
                            <td>blue</td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/blue2.png" ></td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/blue2.png" ></td>
                            <td><input type="checkbox" name="blue" id="blue1" onclick="select2(this.id)"></td>
                        </tr>
                        <tr>
                            <td>green</td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/green2.png" ></td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/green2.png" ></td>
                            <td><input type="checkbox" name="green" id="green1" onclick="select2(this.id)"></td>
                        </tr>
                        <tr>
                            <td>dark blue</td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/dark_blue2.png" ></td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/dark_blue2.png" ></td>
                            <td><input type="checkbox" name="darkBlue" id="darkblue1" onclick="select2(this.id)"></td>
                        </tr>
                        <tr>
                            <td>pink</td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/pink2.png" ></td>
                            <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/pink2.png" ></td>
                            <td><input type="checkbox" name="pink" id="pink1" onclick="select2(this.id)"></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                reserve one card
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img id= "img_fraction" style="width:5vw;" src="images/tokens/gold2.png" >
                            </td>
                        </tr>
                    </table>
                </td>

                <td>
                    <table>
                        <tr>
                            <td>
                                buy one card
                            </td>
                        </tr>

                    </table>
                </td>

                <td>
                    <table>
                        <tr>
                            <td>
                                buy reserved card
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
            <tr>
                <td><button name="btn1">انتخاب 1</button></td>
                <td><button name="btn2">انتخاب 2</button></td>
                <td><button name="btn3">انتخاب 3</button></td>
                <td><button name="btn4">انتخاب 4</button></td>
                <td><button name="btn5">انتخاب 5</button></td>
            </tr>
            <tr>
                <?php
                echo "<td><img  style='width:10vw;'  src='".$cards[$cardOne]->imageLink."'>";
                echo "<input type='checkbox' name='image1'></td>";
                echo "<td><img  style='width:10vw;'  src='".$cards[$cardOne+1]->imageLink."'>";
                echo "<input type='checkbox' name='image2'></td>";
                //            echo $imageSelectedId;
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardOne+2]->imageLink."' >";
                echo "<input type='checkbox' name='image3'></td>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardOne+3]->imageLink."' >";
                echo "<input type='checkbox' name='image4'></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardTwo]->imageLink."' >";
                echo "<input type='checkbox' name='image5'></td>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardTwo+1]->imageLink."' >";
                echo "<input type='checkbox' name='image6'></td>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardTwo+2]->imageLink."' >";
                echo "<input type='checkbox' name='image7'></td>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardTwo+3]->imageLink."' >";
                echo "<input type='checkbox' name='image8'></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardThree]->imageLink."' >";
                echo "<input type='checkbox' name='image9'></td>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardThree+1]->imageLink."' >";
                echo "<input type='checkbox' name='image10'></td>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardThree+2]->imageLink."' >";
                echo "<input type='checkbox' name='image11'></td>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardThree+3]->imageLink."' >";
                echo "<input type='checkbox' name='image12'></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardPrince]->imageLink."' >";
                echo "<input type='checkbox' name='image13'></td>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardPrince+1]->imageLink."' >";
                echo "<input type='checkbox' name='image14'></td>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardPrince+2]->imageLink."' >";
                echo "<input type='checkbox' name='image15'></td>";
                echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardPrince+3]->imageLink."' >";
                echo "<input type='checkbox' name='image16'></td>";
                echo "</tr>";

                ?>
        </table>
        <div style="width:20%; display:flex; flex-direction:column; border:2px solid black">
            <div style="height:90%; ">
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th>نام</th>
                        <th>پيام</th>
                    </tr>
                    <?php
                    $mysql = pdodb::getInstance();
                    $query = "select * from sadaf.chat where roomID = " . $_SESSION["id"];
                    $res = $mysql->Execute($query);
                    while($rec = $res->fetch()){
                        $query2 = "select UserID from sadaf.accountspecs where PersonID = " . $rec["userID"];
                        $res2 = $mysql->Execute($query2);
                        while($rec2 = $res2->fetch()){
                            $writer =  $rec2["UserID"];
                        }
                        echo  "<tr><td>" . $writer . "</td>";
                        echo  "<td>" . $rec["msg"] . "</td></tr>";
                    }
                    ?>
                </table>
            </div>
            <textarea id="message" name="message" placeholder="Type Your Message">
            </textarea>
            <input type="submit" class="btn btn-success btn-sm">
        </div>
    </div>
</form>
</body>
