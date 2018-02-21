<?php
    $p1 = array();
    $p2 = array();
    function play() {
        for($i = 0; $i < 5; $i++) {
            $p1[$i] = rand(1,6);
            $p2[$i] = rand(1,6);
        }
        $p1[] = array_sum($p1);
        $p2[] = array_sum($p2);
        sort($p1);
        sort($p2);
        displayDice($p1, $p2);
        displayPoints($p1, $p2);
    }    
    function displayDice($p1, $p2){
        for($pos = 1; $pos < 3; $pos++) {
            echo "<div id='div$pos'>";
            $current = ($pos == 1) ? $p1 : $p2;
            echo "Player $pos:";
            for($i = 0; $i < 5; $i++) {
                echo "<img id=\"row$pos\" src=\"img/$current[$i].png\" alt=\"$current[$i]\" title=\"$current[$i]\"/>";
            }
            echo end($current);
            echo "</div>";
            echo "<br />";
        }
    }
    function displayPoints($p1, $p2){
        echo "<div id='output'>";
        $totalPoints = end($p1) + end($p2);
        if(end($p1) != end($p2)){
            if(end($p1) > end($p2))
                $player = "Player 1";
            else
                $player = "Player 2";
            echo "<h2>$player won $totalPoints points!</h2>";
        } else {
            echo "<h2> Tie Game!</h2>";
        }
        echo "</div>";
        echo "<br/>";
    }
?>