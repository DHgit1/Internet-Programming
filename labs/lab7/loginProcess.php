<?php
    session_start();
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("ottermart");
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $sql = "SELECT * FROM om_admin WHERE username = :username AND password = :password";
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $password;
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if (empty($record)) {
        $_SESSION['incorrect'] = true;
        header("Location:index.php");
    } else {
        $_SESSION['adminName'] = $record['firstName']. " " . $record['lastName'];
        $_SESSION['incorrect'] = false;
        header("Location:admin.php");
    }
?>