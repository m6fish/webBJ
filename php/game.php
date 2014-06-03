<?php
require "deck.php";
class Game extends Deck
{
    private $players;
    private $countA;
    private $count;
    private $winCount;
    private $result;
    private $winner;

    private $playerCards;
    private $playerScore;


    public function __construct($players)
    {
        parent::__construct();
        $this->players = $players;
        $this->countA = 0;
        $this->count = 0;
        $this->result = array();
        $this->winner = "Nobody Wins!\n";
        $this->winCount = 0;
    }

    public function prepare()
    {
        $this->shuffle();

        $cards_b[] = $this->deal();
        $this->playerCards["b"] = $cards_b;

        //for() players
        $cards_p1[] = $this->deal();
        $this->playerCards["p1"] = $cards_p1;
    }


    public function forTest($playCardsMap)
    {
        $this->playerCards = $playCardsMap;
        return false;
    }

    public function check($who)
    {
        $cardArr = $this->playerCards[$who];
        $sum = $this->calculate($cardArr);

        $ans = "";
        $continueFlag = false;
        if (21 >$sum) {
            //nothing
            $continueFlag = true;
        } elseif (21 == $sum) {
            $ans = $sum . " BlackJack!\n";
        } elseif (21 < $sum) {
            $ans = $sum . " Too Much!\n";
        } else {
            $ans = "Error: " . $sum . "\n";
        }
        return $sum;
    }

    public function addPlayerCard($who)
    {
        $cardArr = $this->playerCards[$who];
        $newCard = $this->deal();
        $cardArr[] = $newCard;
        $this->playerCards[$who] = $cardArr;

        //$scoreSum = $this->calculate($cardArr);

//        $ans = $newCard->getColor() . $newCard->getNum();
        $ans = $newCard->getCardIndex();
        return $ans;
    }

    public function getFirstCard($who)
    {
        $cardArr = $this->playerCards[$who];

//       $ans =  $cardArr[0]->getColor() . $cardArr[0]->getNum();
        $ans = $cardArr[0]->getCardIndex();
        return $ans;
    }

    public function calculate($cardArr)
    {
        $sum = 0;
        $countA =0;
        $ans="";
        foreach ($cardArr as $index => $card) {
            $num = $card->getNum();
            $grade = $this->getGrade($num);

            $sum += $grade;

            if ("A" == $num) {
                $countA += 1;
            }

            if (17 > $sum) {
                //nothing
            } elseif (21 > $sum) {
                $ans .= $sum . " Pause!\n";
            } elseif (21 == $sum) {
                $ans .= $sum . " BlackJack!\n";
            } elseif (21 < $sum) {
                if (0 < $countA) {
                    $sum -= 10;
                    $countA -= 1;
                } else {
                    $ans .= $sum . " Too Much!\n";
                }
            } else {
                $ans .= "Error: " . $sum . "\n";
            }
        }
        return $sum;
    }

    public function getGrade($cardNum)
    {
        $cardGrade = 0;
    
        switch($cardNum){
            case "A":
                $cardGrade = 11;
                break;
            case "2":
            case "3":
            case "4":
            case "5":
            case "6":
            case "7":
            case "8":
            case "9":
                $cardGrade = (int)$cardNum;
                break;
            case "10":
            case "J":
            case "Q":
            case "K":
                $cardGrade = 10;
                break;
        }
        return $cardGrade;
    }

    public function start()
    {
        $result = array();
        for ($playerNo = 0; $playerNo < $this->players; $playerNo ++) {
            $result[$playerNo] = "Player " . ($playerNo +1) . "\n";
            $this->count = 0;
            $this->countA = 0;
            $result[$playerNo] .= $this->oneTurn(0, 0, ($playerNo+1));
            $result[$playerNo] .= "-------------------\n";
        }
        $this->result = $result;
    }

    private function oneTurn($grade, $countA, $player)
    {
        $card = $this->deal();
        $color = $card->getColor();
        $num = $card->getNum();
        $grade = $this->getGrade($num);


        $ans = "";
        $ans .= "Deal card: " . $color . " " . $num . "\n";

        $this->count += $grade;
        $count = $this->count;

        if ("A" == $num) {
            $this->countA += 1;
        }

        if (17 > $count) {
            $ans .= $this->oneTurn($count, $this->countA, $player);
        } elseif (21 > $count) {
            $ans .= $count . " Pause!\n";
            $this->checkWin($player);
        } elseif (21 == $count) {
            $ans .= $count . " BlackJack!\n";
            $this->checkWin($player);
        } elseif (21 < $count) {
            if (0 < $this->countA) {
                $this->count -= 10;
                $this->countA -= 1;
                $ans .= $this->oneTurn($this->count, $this->countA, $player);
            } else {
                $ans .= $count . " Too Much!\n";
            }
        } else {
            $ans .= "Error: " . $this->count . "\n";
        }
        return $ans;
    }

    public function setResult()
    {
        foreach ($this->playerCards as $person => $personCards) {
            $personScore = $this->check($person);
            if ($personScore > 21) {
                if ("b" == $person) {
                    $personScore = 1;
                } else {
                    $personScore = 0;
                }
            }
            $this->playerScore[$person] = $personScore;
        }
        arsort($this->playerScore);
        $winner = key($this->playerScore);
        
        $formate = array("b"=>"banker", "p1" => "player");
        


        return $formate[$winner];
    }

    public function printResult()
    {
        foreach ($this->result as $value) {
            echo $value;
        }
    }

    public function getWinner()
    {
        return $this->winner;
    }

    public function setWinner($whoWin)
    {
        $this->winner = "Player " . $whoWin . " Win!\n";
    }
    
    public function addWinner($whoWin)
    {
        $this->winner .="Player " . $whoWin . "Win\n";
    }

    public function checkWin($player)
    {
        if ($this->count > $this->winCount) {
            $this->setWinner($player);
            $this->winCount = $this->count;
        } elseif ($this->count == $this->winCount) {
            $this->addWinner($player);
            $this->winCount = $this->count;
        }
    }
}
