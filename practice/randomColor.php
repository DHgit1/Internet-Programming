<?php
    function getRandomColor()
    {
        $red = rand(0,255);
        $green = rand(0,255);
        $blue = rand(0,255);
        $alpha = (rand(0,100))/100;
        echo "background-color: rgba($red,$green,$blue,$alpha);"
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Random Color </title>
        <style>
            body{
                color: <?php getRandomColor() ?>;
            }
        </style>
    </head>
    <body>
        
        <h1> Welcome! </h1>
        <h2> Random Background Color! </h2>
        
    </body>
</html>