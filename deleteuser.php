<?php
    $id = $_GET["id"];
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "mohit-crud";
    $conn = new mysqli($servername,$username,$password,$dbname);
    $message = array();
    $sql = "DELETE FROM users WHERE id=".$id.";";
    if ($conn->query($sql) === TRUE){
        $message[] = "User Deleted Succesfully";
        session_start();
        $_SESSION['messages'] = $message;
        header("Location: users.php");
        exit();
        
    }
?>