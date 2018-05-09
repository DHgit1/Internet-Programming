<?php
    session_start();
    if(!isset($_SESSION['adminName'])){
        header("Location:index.php");
    }
    include '../dbConnection.php';
    $conn = getDatabaseConnection("final");
    $sql = "DELETE FROM movie_products WHERE Id = ".$_GET['Id'];
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sql = "SET @newid=0; UPDATE movie_products SET Id=(@newid:=@newid+1) ORDER BY Id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: admin.php");
?>