<?php
    include '../../../dbConnection.php';
    $conn = getDatabaseConnection("poll");
    $sql = "INSERT INTO poll(Yes, No, Maybe) VALUE (0,0,0)";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>