<?php
    session_start();
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("ottermart");
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    $sql = "SELECT * FROM `om_admin` WHERE username = '$username' AND password = '$password'";
    //$sql .=  " WHERE productName LIKE :productName";
    //             $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (empty($record)) {
        echo "Incorrect username or password!";
    } else {
        $_SESSION['adminName'] = $record['firstName']. " " . $record['lastName'];
        header("Location:admin.php");
    }
?>