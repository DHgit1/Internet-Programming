<?php
    session_start();
    if(!isset($_SESSION['adminName'])){
        header("Location:index.php");
    }
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("ottermart");
    function getProductInfo(){
        global $conn;
        $sql = "SELECT * FROM om_product WHERE productId = ". $_GET['productId'];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        return $record;
    }
    if(isset($_GET['productId'])){
        $product = getProductInfo();
    }
    function displayProduct(){
        global $product;
        echo "<strong>Current Product Info: </strong>";
        echo "<table cellpadding='5px' border='1px'>";
        echo "<tr><td><b>productId</b></td>
              <td><b>productName</b></td>
              <td><b>productDescription</b></td>
              <td><b>price</b></td></tr>";
        echo "<tr><td>".$product['productId']."</td>";
        echo "<td>".$product["productName"]."</td>";
        echo "<td>" .$product["productDescription"]."</td>";
        echo "<td> $" .$product["price"]."</td>"; "</tr>";
        echo "</table><br />";
    }
    function getCategories($catId) {
        global $conn;
        $sql = "SELECT catId, catName FROM om_category ORDER BY catName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option selected=";
            echo ($catId == $record['catId'])? "selected" : "";
            echo " value='".$record['catId']."'>". $record['catName'] ."</option>";
        }
    }
    if (isset($_GET['updateProduct'])) {
        $productId = $_GET['productId'];
        $productName = $_GET['productName'];
        $productDescription = $_GET['productDescription'];
        $price = $_GET['price'];
        $productImage = $_GET['productImage'];
        $catId = $_GET['catId'];
        $sql = "UPDATE om_product SET 
                productName = :productName, 
                productDescription = :productDescription, 
                productImage = :productImage, 
                price = :price, 
                catId = :catId
                WHERE productId = :productId";
        $np = array();
        $np[":productId"] = $productId;
        $np[":productName"] = $productName;
        $np[":productDescription"] = $productDescription;
        $np[":productImage"] = $productImage;
        $np[":price"] = $price;
        $np[":catId"] = $catId;
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        echo "Product has been updated!";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Update Product </title>
        <a href="admin.php">Admin Main Page</a>
    </head>
    <body>
        <h1>Update Product</h1>
        <?php displayProduct(); ?>
        <form>
            <input type="hidden" name="productId" value="<?=$product['productId']?>"/>
            Product name:<input type="text" name="productName" value='<?=$product['productName']?>'/><br />
            Description: <textarea name="productDescription" cols="50" rows="4"><?=$product['productDescription']?></textarea><br />
            Price: <input type="text" name="price" value='<?=$product['price']?>'/> <br />
            Image URL: <input type="text" name="productImage" value='<?=$product['productImage']?>'/><br />
            Category: <select name="catId">
                <option value="">Select One</option>
                <?php getCategories($product['catId']); ?>
            </select> <br />
            <input type="submit" name="updateProduct" value="Update Product" />
        </form>
    </body>
</html>