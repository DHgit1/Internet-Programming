<?php
    session_start();
    if(!isset($_SESSION['adminName'])){
        header("Location:index.php");
    }
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("ottermart");
    function getCategories() {
        global $conn;
        $sql = "SELECT catId, catName FROM om_category ORDER BY catName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option value='".$record['catId']."'>". $record['catName'] ." </option>";
        }
    }
    if (isset($_GET['submitProduct'])) {
        $productName = $_GET['productName'];
        $productDescription = $_GET['productDescription'];
        $productPrice = $_GET['price'];
        $productImage = $_GET['productImage'];
        $catId = $_GET['catId'];
        $sql = "INSERT INTO om_product
                (productName, productDescription, productImage, price, catId) 
                 VALUES (:productName, :productDescription, :productImage, :productPrice, :catId)";
        $np = array();
        $np[":productName"] = $productName;
        $np[":productDescription"] = $productDescription;
        $np[":productImage"] = $productImage;
        $np[":productPrice"] = $productPrice;
        $np[":catId"] = $catId;
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
    }
?>
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
        <title> Add Product </title>
    </head>
    <body>
        <a href="admin.php">Admin Main Page</a>
        <h1>Add Product</h1>
        <form>
            Product name:<input type="text" name="productName"/><br />
            Description: <textarea name="productDescription" cols="50" rows="4"></textarea><br />
            Price: <input type="text" name="price"/> <br />
            Image URL: <input type="text" name="productImage"/><br />
            Category: <select name="catId">
                <option value="">Select One</option>
                <?php getCategories(); ?>
            </select> <br />
            <input class='btn' type="submit" name="submitProduct" value="Add Product" />
        </form>
    </body>
</html>