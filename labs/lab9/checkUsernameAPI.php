<?php
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("c9");
    $username = $_GET['username'];
    $sql = "SELECT * FROM lab9_user WHERE username = :username";
    $np = array();
    $np[':username'] = $username;
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($record);
?>