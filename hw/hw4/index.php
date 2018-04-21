<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Dice Game</title>
        <link href="styles.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <div id="title">
            <img class="floatLeft" src="img/chip.png" />
            <img class="floatRight" src="img/chip.png" />
            <h1 class="logoHeader">Dice Game</h1>
        </div>
        <div id="begin">
            <div id="form">
                <i id="e1">*</i><h2 id="input">Enter Player 1: </h2> <input type="text" id="player1" maxlength="20" />
                <br /><i id="error1"></i><br /><br />
                <i id="e2">*</i><h2 id="input">Enter Player 2: </h2> <input type="text" id="player2" maxlength="20" />
                <br /><i id="error2"></i>
            </div>
        </div>
        <br/><button id="submit">Roll!</button>
        <div id="container" hidden>
            <hr><br />
            <div id='div1'></div><br /><br />
            <div id='div2'></div><br /><br />
            <div id='output'></div><br />
            <br /><button id="reset">Play Again!</button>
            <br /><hr>
            <footer>
                <br /><strong>CST336 Internet Programming. By: Devin Hight</strong><br /><br />
                <img id="otter" src="../../img/otter.png" alt="CSUMB Logo" />
            </footer>
        </div>
        <script src="js/functions.js"></script>
    </body>
</html>