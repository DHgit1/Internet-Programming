<?php
    session_start();
    if(!isset($_SESSION['count'])){
        $_SESSION['count'] = 0;
        $_SESSION['number'] = rand(0, 10);
        $_SESSION['attempts'] = array();
    }
    if(isset($_GET['again'])){
        newNum();
    }
    if(isset($_GET['giveUp'])){
        echo "<h3>The answer was: ".$_SESSION['number'] . "</h3>";
        newNum();
    }
    function resetHistory(){
        $_SESSION['count'] = 0;
        $_SESSION['number'] = rand(0, 10);
        $_SESSION['attempts'] = array();
    }
    function newNum(){
        $_SESSION['count'] = 0;
        $_SESSION['number'] = rand(0, 10);
    }
    function check(){
        $num = $_SESSION['number'];
        $_SESSION['count']++;
        if($_GET['number'] < $num){
            echo "Your guess is too low";
        }
        if($_GET['number'] > $num){
            echo "Your guess is too high";
        }
        if($_GET['number'] == $num){
            echo "Your guess is correct!";
            addHistory();
        }
    }
    function addHistory(){
        array_push($_SESSION['attempts'], "<b>You guessed the number ".$_SESSION['number']." in ".$_SESSION['count']." attempts</b><br />");
    }
    function displayHistory(){
        foreach($_SESSION['attempts'] as $attempt){
            echo $attempt;
        }
    }
    //session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Guess the Numbers </title>
    </head>
    <body>
        <h1>Guess a number between 1 and 10!</h1>
        <form>
            Guess: <input type="text" name="number"/> <br /> <br />
            <input type="submit" name="guess" value="Guess Number"/> <br /> <br />
            <input type="submit" name="giveUp" value="Give Up"/>
            <input type="submit" name="again" value="Play Again"/>
        </form>
        <br />
        <?php
            if(isset($_GET['number']) && is_numeric($_GET['number'])){ echo "<hr>"; check(); echo "<br />";}
            if($_SESSION['count'] > 0) echo "Number of tries: ".$_SESSION['count'];
        ?>
        <br /> <hr>
        <h2>Guesses History:</h2>
        <?php if(!empty($_SESSION['attempts'])) displayHistory(); ?>
    </body>
</html>