<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            body {
                text-align: center;
            }
        </style>
        <title> Admin Login </title>
    </head>
    <body>
        <h1>OtterMart - Admin Login</h1>
        <form method="POST" action="loginProcess.php">
            Username: <input type="text" name="username"/> <br /> <br />
            Password: <input type="password" name="password"/> <br /> <br />
            <input class='btn' type="submit" name="submitForm" value="Login!"/> 
        </form>
        <?php 
            if($_SESSION['incorrect'] == true){
                echo "<h2 style='color:red'>Incorrect Username or Password!</h2>";
            }
        ?>
    </body>
</html>