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
        echo "<table cellpadding='5px' border='1px'>";
        echo "<tr>
              <td></td>
              <td></td>
              <td><b>productId</b></td>
              <td><b>productName</b></td>
              <td><b>productDescription</b></td>
              <td><b>price</b></td>
              </tr>";
        foreach ($records as $record) {
            echo "<tr>";
            echo "<td>[<a href='updateProduct.php?productId=". $record['productId'] ."'>Update</a>]</td>";
            echo "<td><form action='deleteProduct.php'><input type='hidden'
                        name='productId' value=". $record['productId'] ." onsubmit='return confirmDelete()'>
                        <input type='submit' value='Remove'/></form></td>";
            echo "<td>".$record['productId']."</td>";
            echo "<td>".$record["productName"]."</td>";
            echo "<td>" .$record["productDescription"]."</td>";
            echo "<td> $" .$record["price"]."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
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
            <input type = "submit" name="addproduct" value="Add Product"/>
        </form> <br />
        <form action="logout.php">
            <input type = "submit" name="logout" value="Logout"/>
        </form> <br />
        <h3>Products:</h3>
        <?=displayAllProducts()?>
    </body>
</html>