<?php
class Card
{
    private $color;
    private $num;
    private $cardIndex;
    private $suits = array("Spade","Heart","Diamond","Plum");
    private $word = array("A","2","3","4","5","6","7","8","9","10","J","Q","K");
    
    public function __construct($suitIndex, $numIndex)
    {
        if ($this->checkCard($suitIndex, $numIndex)) {
            $this->color = $this->suits[$suitIndex];
            $this->num = $this->word[$numIndex];
            $this->cardIndex = '' . $suitIndex . $numIndex;
        } else {
            return "Error CardIndex!";
        }
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getNum()
    {
        return $this->num;
    }

    public function getCardIndex()
    {
        return $this->cardIndex;    
    }

    public function checkCard($suitIndex, $numIndex)
    {
        
        return true;
    }
}
