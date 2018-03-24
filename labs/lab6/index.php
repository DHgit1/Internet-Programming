<?php
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("ottermart");
    function displayCategories(){
        global $conn;
        $sql = "SELECT catId, catName FROM `om_category` ORDER BY catName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option value='".$record["catId"]."' >" . $record["catName"] . "</option>";
        }
    }
    function displaySearchResults(){
        global $conn;
        if (isset($_GET['searchForm'])) { //checks whether user has submitted the form
            echo "<h3>Products Found: </h3>";
            //following sql works but it DOES NOT prevent SQL Injection
            //$sql = "SELECT * FROM om_product WHERE 1
            //       AND productName LIKE '%".$_GET['product']."%'";
            //Query below prevents SQL Injection
            $namedParameters = array();
            $sql = "SELECT * FROM om_product WHERE 1";
            if (!empty($_GET['product'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND productName LIKE :productName";
                 $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
            }
            if (!empty($_GET['category'])) { //checks whether user has selected a category of product
                 $sql .=  " AND catId = :categoryId";
                 $namedParameters[":categoryId"] =  $_GET['category'];
            }
            if (!empty($_GET['priceFrom'])) { //checks whether user has typed something in the price text boxes
                 $sql .=  " AND price >= :priceFrom";
                 $namedParameters[":priceFrom"] =  $_GET['priceFrom'];
            }
            if (!empty($_GET['priceTo'])) { //checks whether user has typed something in the price text boxes
                 $sql .=  " AND price <= :priceTo";
                 $namedParameters[":priceTo"] =  $_GET['priceTo'];
            }
            if (isset($_GET['orderBy'])) {
                if ($_GET['orderBy'] == "price"){
                    $sql .= " ORDER BY price";
                }
                else if($_GET['orderBy'] == "name") {
                    $sql .= " ORDER BY productName";
                }
            }
             $stmt = $conn->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
             foreach ($records as $record) {
                 echo "<a href=\"purchaseHistory.php?productId=".$record['productId']."\"> History </a>";
                 echo  $record["productName"] . " " . $record["productDescription"] . " $" . $record["price"] . "<br /><br />";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> OtterMart Product Search </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>  OtterMart Product Search </h1>
        <form>
            <div id="forms">
            <b>Product: <input type="text" name="product" /> <br /> <br />
            Category: 
                <select name="category">
                    <option value=""> Select One </option>
                    <?=displayCategories()?>
                </select> <br /> <br />
            Price:  From <input type="text" name="priceFrom" size="7"/>
                    To   <input type="text" name="priceTo" size="7"/> <br /> <br />
             Order result by:
             <input type="radio" name="orderBy" value="price"/> Price
             <input type="radio" name="orderBy" value="name"/> Name <br /> <br />
             </div>
             <input type="submit" value="Search" name="searchForm" /> </b>
        </form><br />
        <hr>
        <div id="results"><?= displaySearchResults() ?></div>
    </body>
</html>