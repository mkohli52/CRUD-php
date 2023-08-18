<?php require_once "head.php"?>
<body>
<?php include 'nav.php'?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 ">
                <h1 >User's Data</h1>
            <?php

            session_start();
            if ( isset( $_SESSION[ 'messages' ] ) ) {
                $messages = $_SESSION[ 'messages' ];
                unset( $_SESSION[ 'messages' ] );
                foreach ( $messages as $message ) {
                    echo "<div class='col-12 bg-light rounded rounded-3 border border-success mb-1 p-2' ><h3 style='font-size:15px;'>$message</h3></div>";
                }
            }
            ?>
            <table class="table bg-light rounded rounded-3 border border-dark  p-1 " id="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Age</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once "db_connection.php";
                        $sql = "SELECT * FROM users";
                        if ( $conn->connect_error ){
                            die( "connection failed" );
                    
                        } else {
                            $result = $conn->query( $sql );
                            if( $result->num_rows>0 ){
                                while ( $data=$result->fetch_assoc() ) {
                                    echo( "<tr> <th scope='row'>".$data[ "id" ]."</th><td>".$data[ "name" ]."</td><td>".$data[ "email" ]."</td><td>".$data[ "age" ]."</td><td>".$data[ "status" ]."</td><td class='m-3'><button type='button' class='btn btn-primary me-1'><a href='index.php?id=".$data[ "id" ]."' class='text-white' style='text-decoration:none;' ?><i class='bi bi-pencil'></i></a></button><button type='button' class='btn btn-danger'><a href='deleteuser.php?id=".$data[ "id" ]."' class='text-white' style='text-decoration:none;' ?><i class='bi bi-trash3-fill'></i></a></button></td></tr>" );
                                }
                            }

                        }                   
                    ?>
                    
                    
                </tbody>
            </table>
               
            </div>
        </div>
    </div>
    
</body>
<?php require_once "foot.php"?>