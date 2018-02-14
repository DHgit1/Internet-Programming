<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
        <title> Challenge 2 </title>
        <meta charset="utf-8" />
        <?php
            function randomCard($card){
                $suit = rand(0, 3);

                $suitName = "";
                $cardName = "";
                
                switch($suit)
                {
                    case 0: $suitName = "clubs";
                            break;
                    case 1: $suitName = "hearts";
                            break;
                    case 2: $suitName = "diamonds";
                            break;
                    case 3: $suitName = "spades";
                            break;
                }
                switch($card)
                {
                    case 0: $cardName = "ten";
                            break;
                    case 1: $cardName = "jack";
                            break;
                    case 2: $cardName = "queen";
                            break;
                    case 3: $cardName = "king";
                            break;
                    case 4: $cardName = "ace";
                            break;
                }
                
                echo "<img class='card' alt='$cardName of $suitName' src='img/cards/$suitName/$cardName.png'>";
            }
        ?>
    </head>
    <body>
        <h1>Random Card Game</h1>
        <div id="wrapper">
        <div class="cardDiv">
        <h2>Human</h2>
        <?php
                $card1 = rand(0,4);
                randomCard($card1);
                
        ?>
        </div>
        <div class="cardDiv">
        <h2>Computer</h2>
        <?php
                $card2 = rand(0,4);
                randomCard($card2);
                
        ?>
        </div>
        </div>
        <br /> <br/> <br /> <br/> <br /> <br/> <br /> <br/>
        <?php
        
                
                echo "<div id='result'><b>";
                if ($card1 > $card2) {
                    echo "Human Wins";
                } else if($card2 > $card1){
                    echo "Computer Wins";
                } else {
                    echo "Tie";
                }
                echo "</b></div>"
        ?>
        
    </body>
</html>