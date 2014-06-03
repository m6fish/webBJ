<?php
//require "playBJ.php";
//require "gameWeb.php";
session_start();
unset($_SESSION['obj']);


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BlackJack 21</title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>

    <script src="../js/ajax.js"></script>


</head>

<body>

    <div data-role="Black Jack Web">

        <div data-role="header">
            <h1>Black Jack</h1>
        </div><!-- /header -->

        <div role="main" class="ui-content">

            <div>
                <button class="choice" name = "HIT" value = '0'/>HIT
                <button class="choice" name = "STAND" value = '1'/>STAND
            </div><br/>

            <div id = "player">
                <label>PlayerCard:</label>
                <span>
                    <p id = cards_p1></p>
                    <label>Score:</label>
                    <p id = score_p1></p>
                </span>
            </div><br/>

            <div id = "banker">
                <label>BankerCard:</label>
                <span>
                    <p id = cards_b><p/>
                    <label>Score:</label>
                    <p id = score_b></p>
                </span>
            </div><br/>

            <div id = "result">
                <label>result:</label>
                <span>
                    <p id = winner></p>
                </span>
            </div><br/>

            <div class ="restart">
                <button name = "RESTART">Restart a new game</button>
            </div>
        </div><!-- /content -->

        <div data-role="footer">
            <h4></h4>
        </div><!-- /footer -->
    </div><!-- /page -->



</body>
</html>


