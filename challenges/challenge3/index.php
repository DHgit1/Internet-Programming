
<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <title> Challenge 3 </title>
        <meta charset="utf-8" />
<?php
    $letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $numbers = array(1,2,3,4,5,6,7,8,9);
    $password  = "";
    $ranMax = rand(5,10);
    echo "<table>";
    for ($j = 0; $j< 25; $j++)
    {
        for($i = 0; $i < $ranMax; $i++){
            $variable = rand(0,1);
            if($variable == 0)
            {
                $password = $password.$letters[rand(0,25)];
            }
            else{
                 $password = $password.$numbers[rand(0,8)];
            }
    }
         addPass($password);
         $password = "";
    }
    echo "</table>";
    function addPass($word){
        echo "<tr id='passwordTable'>";
        echo "<td>$word</td>";
        echo "</tr>";
    }
?>

    </head>
    <body>
        
    </body>
</html>