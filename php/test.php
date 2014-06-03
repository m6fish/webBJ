<?php

include("game.php");


$bj = new Game(2);
$bj->prepare();

$testUser = array(
    new card(3, 4),
    new card(3, 6),
    new card(3, 3)
);

$testBoss = array(
    new card(3, 0),
    new card(1, 3),
    new card(2, 4)
);

$testData = array(
    'p1' => $testUser,
    'b' => $testBoss
);

$bj->forTest($testData);
echo $bj->check('p1')."<br/>";
echo $bj->check('b')."<br/>";
