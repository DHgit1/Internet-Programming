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
        if($_GET['number'] < $num)
            echo "<b style='color:red'>Your guess is too low</b>";
        if($_GET['number'] > $num)
            echo "<b style='color:blue'>Your guess is too high</b>";
        if($_GET['number'] == $num){
            echo "<b style='color:green'>Your guess is correct!</b>";
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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title> Guess the Numbers </title>
        <style>
            body {
                padding-left:15px;
            }
        </style>
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