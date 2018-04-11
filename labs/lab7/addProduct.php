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
            <input type="submit" name="submitProduct" value="Add Product" />
        </form>
    </body>
</html>