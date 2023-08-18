<?php
    $id = $_POST['id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $status = $_POST['status'];
    
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "mohit-crud";

    $errors = array();
    $message = array();

    if(empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[]="Email is required and must be a valid email address.";
    }

    if(empty($name) || strlen($name)<=2){
        $errors[]="Name is should not be empty and should be greater then 2 letters ";    
    }

    if($age<0){
        $errors[]="Invalid Age";
    }

    $conn = new mysqli($servername,$username,$password,$dbname);
    $sql = "UPDATE users SET name='".$name."', email='".$email."',age=".$age.",status='".$status."' WHERE id=".$id.";";
    if($conn->connect_error){
        die("connection failed");

    }else{
        
        if(count($errors) === 0){
            if($conn->query($sql)=== TRUE){
            $message[] = "User Editted Succesfully";    
            header("Location: users.php");
            exit();
        }else{
            echo($conn->error);
            
        }
    }else{
        session_start();
        $_SESSION['errors'] = $errors;
        header("Location: edituser.php?id=".$id);
        exit();
    }
        
    }
    


?>