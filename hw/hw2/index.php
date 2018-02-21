<?php
    include 'inc/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Dice Game</title>
        <link href="styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="title">
            <img class="logo floatLeft" src="img/chip.png" />
            <img class="logo floatRight" src="img/chip.png" />
            <h1 class="logoHeader">Dice Game</h1>
        </div>
        <hr>
        <br />
        <?php
            play();
        ?>
        <form>
            <input type="submit" value="Play Again!"/>
        </form>
        <br />
        <hr>
        <footer>
            <br /><strong>CST336 Internet Programming. By: Devin Hight</strong><br />
            <br />
            <img id="otter" src="../../img/otter.png" alt="CSUMB Logo" />
        </footer>
    </body>
</html>