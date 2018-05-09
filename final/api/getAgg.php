<?php
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("final");
    $sql = "SELECT COUNT(*) AS num, ROUND(AVG(price),2) avg, MAX(price) max, MIN(price) min FROM movie_products";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $record=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($record);
?>