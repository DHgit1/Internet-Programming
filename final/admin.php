<?php
    session_start();
    include 'inc/functions.php';
    if(!isset($_SESSION['adminName']))
        header("Location:index.php");
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
        <title> Otter Movies - Admin Access </title>
    </head>
    <script>
        $(document).ready(function(){
            $("#generate").click(function(){
                $.ajax({
                    type: "GET",
                    url: "api/getAgg.php",
                    dataType: "json",
                    data: { "id" : "" },
                    success: function(data,status) {
                            $("#numSpan").html(data[0].num);
                            $("#avgSpan").html("$" + data[0].avg);
                            $("#maxSpan").html("$" + data[0].max);
                            $("#minSpan").html("$" + data[0].min);
                    }
                });
            });
            $("button").click(function() {
                var fired_button = $(this).val();
                alert(fired_button);
            });
        });
        function confirmDelete() {
            return confirm("Are you sure you want to delete it?");
        }
    </script>
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
                  <li class="nav-item active" id="adminLink">
                    <a class="nav-link" href="adminLogin.php">Admin</a>
                  </li>
                  <li class="nav-item" id="logoutLink">
                    <a class="nav-link" href="logout.php">Logout</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav> <br>
        <h1>Otter Movies - Admin</h1>
        <h3>Welcome <?=$_SESSION['adminName']?></h3> <br />
            <div class="container">
                <h2>Inventory Report</h2>
                <hr>
                <div id="inside">
                    <b>Number of Products: </b><span id="numSpan"></span> <br>
                    <b>Average Price: </b><span id="avgSpan"></span> <br>
                    <b>Max Price: </b><span id="maxSpan"></span> <br>
                    <b>Min Price: </b><span id="minSpan"></span> <br>
                </div> <br>
                <input class="btn btn-primary" id="generate" type ="submit" value="Generate"/>
            </div>
         <br>
        <h3>Movies:</h3>
        <form action="addProduct.php">
           <br> <input class="btn btn-primary" id="addMovie" type ="submit" name="addMovie" value="Add Movie"/>
        </form>
        <?=displayAllMovies()?>
    </body>
</html>