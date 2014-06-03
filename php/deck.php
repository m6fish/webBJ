<?php
require "card.php";

class Deck
{
    public $deck;
    private $order;

    public function __construct()
    {
        //echo "Initialize the deck!\n";
        for ($cardNum = 0; $cardNum < 13; $cardNum ++) {
            for ($cardSuit = 0; $cardSuit < 4; $cardSuit ++) {
                $card[] = new Card(
                    $cardSuit,
                    $cardNum
                );
            }
        }
        $this->deck = $card;
        $this->order = 0;
    }
    
    public function shuffle()
    {
        $ranNum;
        $tmp;

        for ($i = 0; $i < 52; $i++) {
            $ranNum = rand(0, 51);
            $tmp = $this->deck[$i];
            $this->deck[$i] = $this->deck[$ranNum];
            $this->deck[$ranNum] = $tmp;
        }
        
        return $this->deck;
    }
    
    public function deal()
    {
        if ($this->order < 52) {
            $oneCard = $this->deck[$this->order];
            $this->order += 1;
        } else {
            return "Ops! Deck have been Empty!";
        }
        return $oneCard;
    }
}
