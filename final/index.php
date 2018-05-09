<?php
    include 'inc/functions.php';
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
        <title>Otter Movie Store</title>
    </head>
    <script>
        $(document).ready(function(){
            $("button").click(function() {
                var fired_button = $(this).val();
                alert(fired_button);
            });
        });
    </script>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class='container-fluid'>
                <div class='navbar-header'>
                    <a class='navbar-brand' href='index.php'>Otter Movie Store</a>
                </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item active" id="homeLink">
                    <a class="nav-link" href="index.php">Home</a>
                  </li>
                  <li class="nav-item" id="loginLink">
                    <a class="nav-link" href="adminLogin.php">Login</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav> <br> <br>
        <form>
            <div class="container">
                <h2>Movie Search</h2>
                <hr>
                <div id="inside">
                <b>Movie Title: </b><input class="form-control" type="text" name="product" />
                <b>Category: </b>
                <Select class="form-control" name="category">
                    <option value="">Select One </option>
                    <?=displayCategories()?>
                </Select>
                <b>Format: </b>
                <Select class="form-control" name="format">
                    <option value="">Select One </option>
                    <?=displayFormats()?>
                </Select>
                <b>Rating: </b>
                <Select class="form-control" name="rating">
                    <option value="">Select One </option>
                    <?=displayRatings()?>
                </Select>
                <b>Sort Results by Name: </b><br />
                 <input type="radio" name="sort" id="ascending" value="asc">
                     <label for="ascending">Ascending</label><br>
                <input type="radio" name="sort" id="descending" value="desc">
                    <label for="descending">Descending</label> <br>
                </div>
                <input class="btn btn-primary" type="submit" value="Search" name="searchForm" id="Submit"/> <br />
            </div>
        </form>
        <?php displayResults(); ?>
    </body>
    <hr>
    <div id="foot">
        <footer>
            <br /><strong>CST336 Internet Programming. By: Devin Hight</strong><br />
            <strong>DISCLAIMER: This is not a real movie store</strong>
        </footer>
        <br />
    </div>
</html>
