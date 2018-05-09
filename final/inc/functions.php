<?php
    include '../dbConnection.php';
    $conn=getDatabaseConnection("final");
    function displayCategories(){
        global $conn;
        $sql="SELECT catId, catName FROM movie_category order by catName";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($records as $record)
            echo "<option value='".$record["catId"]."'>" . $record["catName"] . "</option> " ;
    }
        function displayFormats(){
        global $conn;
        $sql="SELECT formatId, formatName FROM movie_format order by formatName";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($records as $record)
            echo "<option value='".$record["formatName"]."'>" . $record["formatName"] . "</option> " ;
    }
    function displayRatings(){
        global $conn;
        $sql="SELECT ratingId, ratingName FROM movie_rating order by ratingName";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($records as $record)
            echo "<option value='".$record["ratingName"]."'>" . $record["ratingName"] . "</option> " ;
    }
    function displayResults(){
        global $conn;
        if(isset($_GET['searchForm'])){
            $namedParameters= array();
            $sql= "SELECT * FROM `movie_products` WHERE 1";
             if(!empty($_GET['product'])){
                $sql.=" and name LIKE :name" ;
                $namedParameters[":name"]= "%" . $_GET['product'] . "%";
            }
            if(!empty($_GET['category'])){
                $sql.="  and catId= :categoryId" ;
                $namedParameters[":categoryId"] = $_GET['category'];
            }
            if(!empty($_GET['format'])){
                $sql.="  and Format= :Format" ;
                $namedParameters[":Format"] = $_GET['format'] ;
            }
             if(!empty($_GET['rating'])){
                $sql.=  "  and Rating= :Rating" ;
                $namedParameters[":Rating"] = $_GET['rating'];
            }
            if (isset($_GET['sort'])){
                if ($_GET['sort']=="asc")
                    $sql.=" ORDER BY name";
                else
                    $sql.=" ORDER BY name DESC";
            }
            $stmt=$conn->prepare($sql);
            $stmt->execute($namedParameters);
            $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($records)){
                echo "<br /><table class='table' > ";
                echo "<tr><th><h3>Cover</h3></th>
                      <th><h3>Title</h3></th>
                      <th><h3>Genre</h3></th>
                      <th><h3>Format</h3></th>
                      <th><h3>Rating</h3></th>
                      <th><h3>Price</h3></th>
                      <th><h3>Info</h3></th></tr>";
                foreach($records as $record){
                    $itemName=$record['name'];
                    $itemPrice=$record['price'];
                    $itemImage=$record['img'];
                    $itemId=$record['Id'];
                    $itemDescription=$record['Description'];
                    $itemRating=$record['Rating'];
                    $itemCategory=$record['category'];
                    $itemFormat=$record['Format'];
                    if(strpos($itemImage, ".com") != false){
                        echo "<tr><td><img src='$itemImage' width='100'></td>";
                    } else
                        echo "<tr><td><img src='img/$itemImage' width='100'></td>";
                    echo "<td id='td-text'>$itemName</td>";
                    echo "<td id='td-text'>$itemCategory</td>";
                    echo "<td id='td-text'>$itemFormat</td>";
                    echo "<td id='td-text'>$itemRating</td>";
                    echo "<td id='td-text'>$$itemPrice</td>";
                    echo "<td id='td-cell'><button class='btn btn-info' value='".htmlspecialchars($itemDescription, ENT_QUOTES, 'UTF-8')."'>Info</button></td>";
                    echo '</tr>';
                }
                echo "</table>";
            } else
                echo "<br/><h2 id='error'>No movies found!</h2>";
        }
    }
    function displayInfo(){
        global $conn;
        $productId=$_GET['Id'];
        $sql="SELECT * FROM `movie_products` WHERE 1 and Id= $productId";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<img id='infoimg' src= 'img/".$records[0]['img']."' width='200'/>";
        echo "<table class='tableinfo'>";
        echo "<tr><td id='td-info'>Title</td>"; echo "<td id='td-info'>". $records[0]['name'] ."</td><td id='td-info'></td>";
        echo "<td id='td-info'>Category</td>"; echo "<td id='td-info'>". $records[0]['category'] ."</td><td id='td-info'></td>";
        echo "<td id='td-info'>Rating</td>"; echo "<td id='td-info'>". $records[0]['Rating'] ."</td></tr></table>";
        echo "<p>Description: ". $records[0]['Description'] . "<p>";
    }
    function displayAllMovies(){
        global $conn;
        $productId=$_GET['Id'];
        $sql = "SELECT * FROM movie_products ORDER BY Id";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($records)){
            echo "<br /><table class='table' > ";
            echo "<tr><th><h3>Cover</h3></th>
                  <th><h3>Action</h3></th>
                  <th><h3>Title</h3></th>
                  <th><h3>Genre</h3></th>
                  <th><h3>Format</h3></th>
                  <th><h3>Rating</h3></th>
                  <th><h3>Price</h3></th>
                  <th><h3>Info</h3></th></tr>";
            foreach($records as $record){
                $itemName=$record['name'];
                $itemPrice=$record['price'];
                $itemImage=$record['img'];
                $itemId=$record['Id'];
                $itemDescription=$record['Description'];
                $itemRating=$record['Rating'];
                $itemCategory=$record['category'];
                $itemFormat=$record['Format'];
                if(strpos($itemImage, "://") != false){
                    echo "<tr><td><img src='$itemImage' width='100'></td>";
                } else
                echo "<tr><td><img src='img/$itemImage' width='100'></td>";
                echo "<td id='td-cell'><form action='updateProduct.php'>
                      <input type='hidden' name='Id' value='$itemId' />
                      <input class='btn' type='submit' value='Update'/></form>
                      <form action='deleteProduct.php'><input type='hidden' name='Id' value='$itemId'><br>
                      <input class='btn btn-danger' type='submit' value='Remove' onclick='return confirmDelete()'/></form></td>";
                echo "<td id='td-text'>$itemName</td>";
                echo "<td id='td-text'>$itemCategory</td>";
                echo "<td id='td-text'>$itemFormat</td>";
                echo "<td id='td-text'>$itemRating</td>";
                echo "<td id='td-text'>$$itemPrice</td>";
                echo "<td id='td-cell'><button class='btn btn-info' value='".htmlspecialchars($itemDescription, ENT_QUOTES, 'UTF-8')."'>Info</button></td>";
                echo '</tr>';
            }
            echo "</table>";
        } else
            echo "<br/><h2 id='error'>No movies found!</h2>";
    }
?>