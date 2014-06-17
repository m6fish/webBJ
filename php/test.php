<?php

include("game.php");


$obj = new Game(2);
$obj->prepare();

/*
$testUser = array(
    new card(0, 0),
    new card(0, 1),
    new card(0, 2),
    new card(0, 3),
    new card(0, 4)
);

$testBoss = array(
    new card(3, 0),
    new card(3, 1),
    new card(3, 2),
    new card(3, 4),
    new card(3, 5)
);

$testData = array(
    'p1' => $testUser,
    'b' => $testBoss
);

$bj->forTest($testData);
echo $bj->check('p1')."<br/>";
echo $bj->check('b')."<br/>";
*/

$first_p1 = $obj->getTheCard("player1", 0);
$first_b = $obj->getTheCard("banker", 0);

$commandList = array(0,1,1,1,-1);

foreach ($commandList as $mode) {

    if ('-1' == $mode) {
        $sum_p1 = $obj->check("player1");
        $sum_b = $obj->check("banker");
        while ($sum_b < 17) {
            $newCard_b[] = $obj->addPlayerCard("banker");

            $sum_b = $obj->check("banker");
        }

        $win = $obj->setResult();
        $resultArr =  array('score_p1'=>$sum_p1,
                    'score_b'=>$sum_b,
                    'b_rest'=>$newCard_b,
                    'result'=> $win,
                    'error_code' => '0'
                    );

    } elseif (0 == $mode) {
        $resultArr = array("banker" => $first_b,
                        "player1" => $first_p1,
                        'error_code' => '1'
                    );
    } elseif (1 == $mode) {
        $newCardtxt = $obj->addPlayerCard("player1");
        $check = $obj->check("player1");
        $resultArr = array('player1' => $newCardtxt,
                'score_p1' => $check,
                'error_code' => '1'
            );
    }

    $deck_p1 = $obj->getTheCard("player1", -1);
    $deck_b = $obj->getTheCard("banker", -1);

    //$resultArr['deck_p1'] = $deck_p1;
    //$resultArr['deck_b'] = $deck_b;
    echo json_encode($resultArr) . "\n";
}
