<?php
session_start();
include("game.php");
//unset($_SESSION["obj"]);

try {

    if (!isset( $_SESSION["obj"])) {
        $bj = new Game(2);
        $bj->prepare();
        $first_p1 = $bj->getFirstCard("p1");
        $first_b = $bj->getFirstCard("b");
        $_SESSION["obj"] = serialize($bj);
    }

    if (isset($_POST["moreCard"])) {
        $obj = unserialize($_SESSION["obj"]);
        $mode = $_POST["moreCard"];
        if (0 == $mode) {
            $newCardtxt = $obj->addPlayerCard("p1");
            $check = $obj->check("p1");
            $resultArr = array('p1' => $newCardtxt,
                    'score_p1' => $check
                );

            echo json_encode($resultArr);
        
        } elseif (1 == $mode) {
            $sum_p1 = $obj->check("p1");
            $sum_b = $obj->check("b");
            while ($sum_b < 17) {
                $newCard_b[] = $obj->addPlayerCard("b");

                $sum_b = $obj->check("b");
            }

            $win = $obj->setResult();
            echo json_encode(
                array('score_p1'=>$sum_p1,
                    'score_b'=>$sum_b,
                    'b_rest'=>$newCard_b,
                    'result'=> $win
                )
            );
        } elseif (2 == $mode) {
            echo json_encode(array("b" => $first_b, "p1" => $first_p1));
        }


        $_SESSION["obj"] = serialize($obj);
    }

} catch (Exception $e) {
    $message = "Error! " . $e->getMessage() . "\n";
    echo "<script> alert('$message')</script>";
}
