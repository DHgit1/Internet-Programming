<?php 
    session_start(); 
    if(isset($_SESSION['adminName']))
        header("Location:admin.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>   
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <title> Admin Login </title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class='container-fluid'>
                <div class='navbar-header'>
                    <a class='navbar-brand' href='index.php'>Otter Movie Store</a>
                </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item" id="homeLink">
                    <a class="nav-link" href="index.php">Home</a>
                  </li>
                  <li class="nav-item active" id="loginLink">
                    <a class="nav-link" href="adminLogin.php">Login</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav> <br> <br>
        <?php 
            if($_SESSION['incorrect'] == true){
                echo "<h2 style='color:red'>Incorrect Username or Password!</h2><br>";
                $_SESSION['incorrect'] = false;
            }
        ?>
        <form method="POST" action="loginProcess.php">
            <div class="container">
                <h2>Admin Login</h2>
                <hr>
                <div id="inside">
                <b>Username: </b><input class="form-control" id="username" type="text" name="username"/>
                <b>Password: </b><input class="form-control" type="password" name="password"/> <br>
                </div>
                <input class="btn btn-primary" type="submit" name="submitForm" value="Login!"/>
            </div>
        </form>
    </body>
</html>