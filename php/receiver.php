<?php
session_start();
include_once("game.php");

try {

    if (!isset( $_SESSION["obj"])) {
        $bj = new Game(2);
        $bj->prepare();
        $_SESSION["obj"] = serialize($bj);
    }

    if (isset($_POST["moreCard"])) {
        $obj = unserialize($_SESSION["obj"]);
        $mode = $_POST["moreCard"];


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
            $first_p1 = $obj->getTheCard("player1", 0);
            $first_b = $obj->getTheCard("banker", 0);
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

        $resultArr['deck_p1'] = $deck_p1;
        $resultArr['deck_b'] = $deck_b;
        echo json_encode($resultArr);

        $_SESSION["obj"] = serialize($obj);

        if('-1' == $mode){
            unset($_SESSION['obj']);
        }
    }

} catch (Exception $e) {
    $error_code = '-1';
    $error_message = "Error! " . $e->getMessage() . "\n";
    echo "<script> alert('$error_message .' / ' . $error_code')</script>";
}
