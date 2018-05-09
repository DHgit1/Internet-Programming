<?php
    session_start();
    if(!isset($_SESSION['adminName'])){
        header("Location:index.php");
    }
    include '../dbConnection.php';
    $conn = getDatabaseConnection("final");
    function getFormats() {
        global $conn;
        $sql = "SELECT formatName FROM movie_format ORDER BY formatId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option value='".$record['formatName']."'>". $record['formatName'] ." </option>";
        }
    }
    function getCategories() {
        global $conn;
        $sql = "SELECT catID, catName FROM movie_category ORDER BY catName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option value='".$record['catID'].":". $record['catName'] ."'>". $record['catName'] ." </option>";
        }
    }
    function getRatings() {
        global $conn;
        $sql = "SELECT ratingName FROM movie_rating ORDER BY ratingId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option value='".$record['ratingName']."'>". $record['ratingName'] ." </option>";
        }
    }
    if (isset($_GET['submitProduct'])) {
        $_SESSION['error'] = false;
        $productName = $_GET['name'];
        $productDescription = $_GET['Description'];
        $productPrice = $_GET['price'];
        $productCategory = split(':', $_GET['category'])[1];
        $productFormat = $_GET['Format'];
        $productRating = $_GET['Rating'];
        $productImage = $_GET['img'];
        $catId = split(':', $_GET['category'])[0];
        $sql = "INSERT INTO movie_products
                (name, Description, price, category, Format, Rating, img, catId) 
                 VALUES (:name, :Description, :price, :category, :Format, :Rating, :img, :catId)";
        $np = array();
        $np[":name"] = $productName;
        $np[":Description"] = $productDescription;
        $np[":price"] = $productPrice;
        $np[":category"] = $productCategory;
        $np[":Format"] = $productFormat;
        $np[":Rating"] = $productRating;
        $np[":img"] = $productImage;
        $np[":catId"] = $catId;
        foreach($np as $value){
            if($value == NULL)
                $_SESSION['error'] = true;
        }
        if(!$_SESSION['error']){
            $stmt = $conn->prepare($sql);
            $stmt->execute($np);
            header("Location:admin.php");
        }
    }
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
        <title> Otter Movies - Add Movie </title>
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
                  <li class="nav-item" id="adminLink">
                    <a class="nav-link" href="adminLogin.php">Admin</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav> <br>
    <body>
        <?php 
            if($_SESSION['error'] == true){
                echo "<h2 style='color:red'>One or more fields missing!</h2><br>";
                $_SESSION['error'] = false;
            }
        ?>
        <form>
            <div class="container">
                <h1>Add Movie</h1>
                <hr>
                <div id="inside">
                    <b>Product name: </b><input class="form-control" id="pName" type="text" name="name"/>
                    <b>Description: </b><textarea class="form-control" name="Description" cols="50" rows="4"></textarea>
                    <b>Price: </b><input class="form-control" type="text" name="price"/>
                    <b>Image URL: </b><input class="form-control" type="text" name="img"/>
                    <b>Category: </b><select class="form-control" name="category">
                        <option value="">Select One</option>
                        <?php getCategories(); ?>
                    </select>
                    <b>Format: </b><select class="form-control" name="Format">
                        <option value="">Select One</option>
                        <?php getFormats(); ?>
                    </select>
                    <b>Rating: </b><select class="form-control" name="Rating">
                        <option value="">Select One</option>
                        <?php getRatings(); ?>
                    </select> <br />
                </div>
            <input class='btn btn-primary' type="submit" name="submitProduct" value="Add Movie" />
            </div>
        </form>
    </body>
</html>
