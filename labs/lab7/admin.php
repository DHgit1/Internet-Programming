<?php
    session_start();
    if(!isset($_SESSION['adminName'])){
        header("Location:index.php");
    }
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("ottermart");
    function displayAllProducts(){
        global $conn;
        $sql = "SELECT * FROM `om_product` ORDER BY productId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<table class='table'>";
        echo "<tr>
              <td></td>
              <td></td>
              <td><b>ID</b></td>
              <td><b>Name</b></td>
              <td><b>Description</b></td>
              <td><b>Price</b></td>
              </tr>";
        foreach ($records as $record) {
            echo "<tr>";
            echo "<td>[<a href='updateProduct.php?productId=". $record['productId'] ."'>Update</a>]</td>";
            echo "<td><form action='deleteProduct.php'><input type='hidden'
                        name='productId' value=". $record['productId'] .">
                        <input class='btn btn-danger' type='submit' value='Remove' onclick='return confirmDelete()'/></form></td>";
            echo "<td>" .$record['productId']."</td>";
            echo "<td>" .$record["productName"]."</td>";
            echo "<td>" .$record["productDescription"]."</td>";
            echo "<td>$" .$record["price"]."</td>";
            echo "</tr>";
        }
        echo "</table>";
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
        <title> Admin Main Page </title>
    </head>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete it?");
        }
    </script>
    <body>
        <h1>Admin Main Page</h1>
        <h3>Welcome <?=$_SESSION['adminName']?></h3> <br />
        <form action="addProduct.php">
            <input class='btn' type = "submit" name="addproduct" value="Add Product"/>
        </form> <br />
        <form action="logout.php">
            <input class='btn' type = "submit" name="logout" value="Logout"/>
        </form> <br />
        <h3>Products:</h3>
        <?=displayAllProducts()?>
    </body>
</html>