<?php


class Player
{
    public $userID, $orangeTokens, $blueTokens, $greenTokens, $darkBlueTokens,
        $pinkTokens, $goldenTokens, $score, $orangeTokensStable,$blueTokensStable, $greenTokensStable,
        $darkBlueTokensStable,$pinkTokensStable, $reserve1, $reserve2, $reserve3, $reserveN=0;

    /**
     * Player constructor.
     * @param $userID
     * @param $orangeTokens
     * @param $blueTokens
     * @param $greenTokens
     * @param $darkBlueTokens
     * @param $pinkTokens
     * @param $goldenTokens
     * @param $score
     * @param $orangeTokensStable
     * @param $blueTokensStable
     * @param $greenTokensStable
     * @param $darkBlueTokensStable
     * @param $pinkTokensStable
     * @param $reserve1
     * @param $reserve2
     * @param $reserve3
     * @param int $reserveN
     */
    public function __construct($userID, $orangeTokens, $blueTokens, $greenTokens, $darkBlueTokens, $pinkTokens, $goldenTokens, $score, $orangeTokensStable, $blueTokensStable, $greenTokensStable, $darkBlueTokensStable, $pinkTokensStable, $reserve1, $reserve2, $reserve3, $reserveN)
    {
        $this->userID = $userID;
        $this->orangeTokens = $orangeTokens;
        $this->blueTokens = $blueTokens;
        $this->greenTokens = $greenTokens;
        $this->darkBlueTokens = $darkBlueTokens;
        $this->pinkTokens = $pinkTokens;
        $this->goldenTokens = $goldenTokens;
        $this->score = $score;
        $this->orangeTokensStable = $orangeTokensStable;
        $this->blueTokensStable = $blueTokensStable;
        $this->greenTokensStable = $greenTokensStable;
        $this->darkBlueTokensStable = $darkBlueTokensStable;
        $this->pinkTokensStable = $pinkTokensStable;
        $this->reserve1 = $reserve1;
        $this->reserve2 = $reserve2;
        $this->reserve3 = $reserve3;
        $this->reserveN = $reserveN;
    }


    public function f1($color1){
        switch ($color1)
        {
            case "orange":
                $this->orangeTokens = $_SESSION['this->orangeTokens'];
                $this->orangeTokens++;
                $_SESSION['this->orangeTokens']= $this->orangeTokens;
//                echo $this->orangeTokens;
                break;
            case "blue":
                $this->blueTokens = $_SESSION['this->blueTokens'];
                $this->blueTokens++;
                $_SESSION['this->blueTokens']= $this->blueTokens;
                break;
            case "green":
                $this->greenTokens = $_SESSION['this->greenTokens'];
                $this->greenTokens++;
                $_SESSION['this->greenTokens']= $this->greenTokens;
                break;
            case "pink":
                $this->pinkTokens = $_SESSION['this->pinkTokens'];
                $this->pinkTokens++;
                $_SESSION['this->pinkTokens']= $this->pinkTokens;
                break;
            case "darkBlue":
                $this->darkBlueTokens = $_SESSION['this->darkBlueTokens'];
                $this->darkBlueTokens++;
                $_SESSION['this->darkBlueTokens']= $this->darkBlueTokens;
                break;
        }
    }

    function reserveACard($card){

        if($this->reserveN == 0){
            $_SESSION['this->reserve1'] = $card;
            $this->reserveN = $_SESSION['this->reserveN'];
            $this->reserveN++;
            $_SESSION['this->reserveN']= $this->reserveN;
        }
        elseif($this->reserveN == 1){
            $_SESSION['this->reserve1'] = $card;
            $this->reserveN = $_SESSION['this->reserveN'];
            $this->reserveN++;
            $_SESSION['this->reserve2'] = $card;
        }
        elseif($this->reserveN == 2){
            $_SESSION['this->reserve1'] = $card;
            $this->reserveN = $_SESSION['this->reserveN'];
            $this->reserveN++;
            $_SESSION['this->reserve3'] = $card;
        }

        $this->goldenTokens = $_SESSION['this->goldenTokens'];
        $this->goldenTokens++;
        $_SESSION['this->goldenTokens']= $this->goldenTokens;
    }


    function buyTheCard(Card $card){
// first we should check cards player that how many tokens have (in cards->rant)
        if( ($card->orangeTokens <= $this->orangeTokens + $this->orangeTokensStable)
            and ($card->blueTokens <= $this->blueTokens + $this->blueTokensStable)
            and ($card->pinkTokens <= $this->pinkTokens + $this->pinkTokensStable)
            and ($card->greenTokens <= $this->greenTokens + $this->greenTokensStable)
            and ($card->darkBlueTokens <= $this->darkBlueTokens + $this->darkBlueTokensStable)){
            //check stable tokens
            if($this->orangeTokensStable != 0) {
                $card->orangeTokens = $_SESSION['card->orangeTokens'];
                if ($this->orangeTokensStable >= $card->orangeTokens){
                    $card->orangeTokens = 0;
                }
                else{
                    $card->orangeTokens -= $this->orangeTokensStable;
                }
                $_SESSION['card->orangeTokens']= $card->orangeTokens;
            }
            if($this->blueTokensStable != 0) {
                $card->blueTokens = $_SESSION['card->blueTokens'];
                if ($this->blueTokensStable >= $card->blueTokens){
                    $card->blueTokens = 0;
                }
                else{
                    $card->blueTokens -= $this->blueTokensStable;
                }
                $_SESSION['card->blueTokens']= $card->blueTokens;
            }
            if($this->pinkTokensStable != 0) {
                $card->pinkTokens = $_SESSION['card->pinkTokens'];
                if ($this->pinkTokensStable >= $card->pinkTokens){
                    $card->pinkTokens = 0;
                }
                else{
                    $card->pinkTokens -= $this->pinkTokensStable;
                }
                $_SESSION['card->pinkTokens']= $card->pinkTokens;
            }
            if($this->greenTokensStable != 0) {
                $card->greenTokens = $_SESSION['card->greenTokens'];
                if ($this->greenTokensStable >= $card->greenTokens){
                    $card->greenTokens= 0;
                }
                else{
                    $card->greenTokens -= $this->greenTokensStable;
                }
                $_SESSION['card->greenTokens']= $card->greenTokens;
            }
            if($this->darkBlueTokensStable != 0) {
                $card->darkBlueTokens = $_SESSION['card->darkBlueTokens'];
                if ($this->darkBlueTokensStable >= $card->darkBlueTokens){
                    $card->darkBlueTokens = 0;
                }
                else{
                    $card->darkBlueTokens -= $this->darkBlueTokens;
                }
                $_SESSION['card->darkBlueTokens']= $card->darkBlueTokens;
            }
            //check tokens
            if( $card->orangeTokens != 0 ){
                $this->orangeTokens = $_SESSION['this->orangeTokens'];
                $this->orangeTokens -= $card->orangeTokens;
                $_SESSION['this->orangeTokens']= $this->orangeTokens;
            }
            if( $card->blueTokens != 0 ){
                $this->blueTokens = $_SESSION['this->blueTokens'];
                $this->blueTokens -= $card->blueTokens;
                $_SESSION['this->blueTokens']= $this->blueTokens;
            }
            if( $card->pinkTokens != 0 ){
                $this->pinkTokens = $_SESSION['this->pinkTokens'];
                $this->pinkTokens -= $card->pinkTokens;
                $_SESSION['this->pinkTokens']= $this->pinkTokens;
            }
            if( $card->greenTokens != 0 ){
                $this->greenTokens = $_SESSION['this->greenTokens'];
                $this->greenTokens -= $card->greenTokens;
                $_SESSION['this->greenTokens']= $this->greenTokens;
            }
            if( $card->darkBlueTokens != 0 ){
                $this->darkBlueTokens = $_SESSION['this->darkBlueTokens'];
                $this->darkBlueTokens -= $card->darkBlueTokens;
                $_SESSION['this->darkBlueTokens']= $this->darkBlueTokens;
            }
            if($card->score != 0){
                $this->score = $_SESSION['this->score'];
                $this->score += $card->score;
                $_SESSION['this->score']= $this->score;
            }
            if($card->rant == 1){
                $this->orangeTokensStable = $_SESSION['this->orangeTokensStable '];
                $this->orangeTokensStable ++;
                $_SESSION['this->orangeTokensStable ']= $this->orangeTokensStable ;
            }
            elseif($card->rant == 2){
                $this->pinkTokensStable = $_SESSION['this->pinkTokensStable'];
                $this->pinkTokensStable++;
                $_SESSION['this->pinkTokensStable']= $this->pinkTokensStable;
            }
            elseif ($card->rant ==3){
                $this->blueTokensStable = $_SESSION['this->blueTokensStable'];
                $this->blueTokensStable++;
                $_SESSION['this->blueTokensStable']= $this->blueTokensStable;
            }
            elseif($card->rant == 4){
                $this->greenTokensStable = $_SESSION['this->greenTokensStable'];
                $this->greenTokensStable++;
                $_SESSION['this->greenTokensStable']= $this->greenTokensStable;
            }
            elseif ($card->rant == 5){
                $this->darkBlueTokensStable = $_SESSION['this->darkBlueTokensStable'];
                $this->darkBlueTokensStable++;
                $_SESSION['this->darkBlueTokensStable']= $this->darkBlueTokensStable;
            }
        }
    }

}