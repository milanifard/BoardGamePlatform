<?php


class Card
{

    public $id, $orangeTokens=0, $blueTokens=0, $greenTokens=0, $darkBlueTokens=0,
        $pinkTokens=0, $goldenTokens=0, $score=0, $type, $imageLink,$rant;

    /**
     * Card constructor.
     * @param $id
     * @param int $orangeTokens
     * @param int $blueTokens
     * @param int $greenTokens
     * @param int $darkBlueTokens
     * @param int $pinkTokens
     * @param int $goldenTokens
     * @param int $score
     * @param $type
     * @param $imageLink
     */
    public function __construct($id, $orangeTokens, $blueTokens, $greenTokens, $darkBlueTokens, $pinkTokens,
                                $goldenTokens, $score, $type, $imageLink,$rant)
    {
        $this->id = $id;
        $this->orangeTokens = $orangeTokens;
        $this->blueTokens = $blueTokens;
        $this->greenTokens = $greenTokens;
        $this->darkBlueTokens = $darkBlueTokens;
        $this->pinkTokens = $pinkTokens;
        $this->goldenTokens = $goldenTokens;
        $this->score = $score;
        $this->type = $type;
        $this->imageLink = $imageLink;
        $this->rant = $rant;
    }

}