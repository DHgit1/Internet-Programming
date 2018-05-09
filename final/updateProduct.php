<?php
    session_start();
    if(!isset($_SESSION['adminName'])){
        header("Location:index.php");
    }
    include '../dbConnection.php';
    $conn = getDatabaseConnection("final");
    function getProductInfo(){
        global $conn;
        $sql = "SELECT * FROM movie_products WHERE Id = ". $_GET['Id'];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        return $record;
    }
    if(isset($_GET['Id'])){
        $product = getProductInfo();
    }
    function getFormats($format) {
        global $conn;
        $sql = "SELECT formatName FROM movie_format ORDER BY formatId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option ";
            echo ($format == $record['formatName'])? "selected=".$record['formatName'] : "";
            echo " value='".$record['formatName']."'>". $record['formatName'] ."</option>";
        }
    }
    function getCategories($catId) {
        global $conn;
        $sql = "SELECT catID, catName FROM movie_category ORDER BY catName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option ";
            echo ($catId == $record['catID'])? "selected=".$record['catID'] : "";
            echo " value='".$record['catID'].":". $record['catName'] ."'>". $record['catName'] ."</option>";
        }
    }
    function getRatings($rating) {
        global $conn;
        $sql = "SELECT ratingName FROM movie_rating ORDER BY ratingId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option ";
            echo ($rating == $record['ratingName'])? "selected=".$record['ratingName'] : "";
            echo " value='".$record['ratingName']."'>". $record['ratingName'] ." </option>";
        }
    }
    if (isset($_GET['updateProduct'])) {
        $_SESSION['error'] = false;
        $productName = $_GET['name'];
        $productDescription = $_GET['Description'];
        $productPrice = $_GET['price'];
        $productCategory = split(':', $_GET['category'])[1];
        $productFormat = $_GET['Format'];
        $productRating = $_GET['Rating'];
        $productImage = $_GET['img'];
        $catId = split(':', $_GET['category'])[0];
        $Id = $product['Id'];
        $sql = "UPDATE movie_products SET
                name = :name, 
                Description = :Description, 
                price = :price,
                category = :category,
                Format = :Format,
                Rating = :Rating,
                img = :img,
                catId = :catId
                WHERE Id = :Id";
        $np = array();
        $np[":name"] = $productName;
        $np[":Description"] = $productDescription;
        $np[":price"] = $productPrice;
        $np[":category"] = $productCategory;
        $np[":Format"] = $productFormat;
        $np[":Rating"] = $productRating;
        $np[":img"] = $productImage;
        $np[":catId"] = $catId;
        $np[":Id"] = $Id;
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
        <title> Otter Movies - Update Movie </title>
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
                <h1>Update Movie</h1>
                <hr>
                <div id="inside">
                    <input type="hidden" name="Id" value="<?=$product['Id']?>"/>
                    <b>Product name: </b><input class="form-control" type="text" name="name" value='<?=$product['name']?>'/>
                    <b>Description: </b><textarea class="form-control" name="Description" cols="50" rows="4"><?=$product['Description']?></textarea>
                    <b>Price: </b><input class="form-control" type="text" name="price" value='<?=$product['price']?>'/>
                    <b>Image URL: </b><input class="form-control" type="text" name="img" value='<?=$product['img']?>'/>
                    <b>Category: </b><select class="form-control" name="category">
                        <option value="">Select One</option>
                        <?php getCategories($product['catId']) ?>
                    </select>
                    <b>Format: </b><select class="form-control" name="Format">
                        <option value="">Select One</option>
                        <?php getFormats($product['Format']); ?>
                    </select>
                    <b>Rating: </b><select class="form-control" name="Rating">
                        <option value="">Select One</option>
                        <?php getRatings($product['Rating']); ?>
                    </select> <br />
                </div>
                <input class='btn btn-primary' type="submit" name="updateProduct" value="Update" />
            </div>
        </form>
    </body>
</html>