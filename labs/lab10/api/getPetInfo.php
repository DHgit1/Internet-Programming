<?php
    include '../../../dbConnection.php';
    $conn = getDatabaseConnection("pets");
    global $conn;
    $sql = "SELECT *, YEAR(CURDATE()) - yob age FROM pets WHERE id= :id";
    $stmt=$conn->prepare($sql);
    $stmt->execute(array(":id"=>$_GET['id']));
    $record=$stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($record);
?>