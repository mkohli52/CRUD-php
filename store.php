<?php
    require_once "db_connection.php";
    $id = $_POST['id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $status = $_POST['status'];

    

    $errors = array();
    $message = array();

    if ( empty( $email ) || !filter_var( $email,FILTER_VALIDATE_EMAIL )) {
        $errors[ "email" ] = "Email is required and must be a valid email address.";
    }

    if ( empty( $name ) || strlen( $name ) <= 2) {
        $errors[ "name" ] = "Name is should not be empty and should be greater then 2 letters ";    
    }

    if ( empty( $age ) || $age < 0 ){
        $errors[ "age" ] = "Invalid age or age cannot be empty";
    }

    if ( empty( $status ) ){
        $errors[ "status" ]="Please select the status";
    }
    
 
    


    if ( $conn->connect_error ) {
        die( "connection failed" );

    } else {
        
        if ( count( $errors ) === 0 ) {
            if ( isset( $id ) ) {
                
                $sql = "UPDATE users SET name='".$name."', email='".$email."',age=".$age.",status='".$status."' WHERE id=".$id.";";
                if ( $conn->query( $sql ) === TRUE ) {
                    $message[] = "User Editted Succesfully";
                    session_start();
                    $_SESSION['messages'] = $message;    
                    header("Location: users.php");
                    exit();
                }

            } else {

                $sql = "INSERT INTO users (name, email, age, status) VALUES ('".$name."', '".$email."', ".$age.", '".$status."');";
                if ( $conn->query($sql)=== TRUE ) {
                $message[] = "User Added Succesfully";
                session_start();
                $_SESSION[ 'messages' ] = $message;
                header( "Location: index.php" );
                exit();
                
        } else {
            echo($conn->error);
        }
        }
    } else {
        session_start();
        $_SESSION[ 'errors' ] = $errors;
        $_SESSION[ 'name' ] = $name;
        $_SESSION[ 'email' ] = $email;
        $_SESSION[ 'age' ] = $age;
        $_SESSION[ 'status' ] = $status;
        if ( isset( $id ) ) {
            header( "Location: index.php?id=".$id );
        } else {
            header( "Location: index.php" );
        }
        exit();
    }
        
    }


?>