<?php
    //$cards = array("ace","one", 2);
    //print_r($cards); //for debugging, shows elements in array
    //echo $cards[0]. "<br />";
    //$cards[] = "jack"; //appends new element
    //array_push($cards, "queen", "king"); //appends multiple elements
    //$cards[2] = "ten"; //replaces at index
    //$lastCard = array_pop($cards); //retrieves and REMOVES the last item in the array
    //unset($cards[1]); //removes element from the array (the index removed no longer exists, all other
                        //elements have the same index as before)
    //$cards = array_values($cards); //re-indexes the array
    //shuffle($cards); //shuffles the order of the array
    //array_rand($cards); //gets a random index number of $cards
    //print_r($cards);
    $suits = array("clubs","hearts","diamonds","spades");
    $cards = array("ten","jack","queen","king","ace");
    
    displayCard($suits, $cards);
    function displayCard($suits, $cards) {
        $suitName = $suits[rand(0, count($suits)-1)];
        $cardName = $cards[array_rand($cards)];
        echo "<img src='../challenges/challenge2/img/cards/$suitName/$cardName.png' alt='spade'/>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

    </body>
</html>