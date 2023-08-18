<?php if( isset ( $_GET["id" ] ) ) {
    require_once "db_connection.php";
    $conn = new mysqli( $servername,$username,$password,$dbname );
    $sql = "SELECT * FROM users WHERE id=".$_GET['id'].";";
    $result = $conn->query( $sql );
    $data = $result->fetch_assoc();
}?>

<?php require_once "head.php";?>
<body class="bg-dark-subtle">
    <!-- Navbar -->
    <?php include 'nav.php'?>
    <div class="container-fluid mt-3">
        
        <div class="row justify-content-center">
            <div class="col-8 col-md-8 col-sm-10 p-3 border border-info bg-light rounded rounded-3 shadow shadow-2">
            <?php if ( isset ( $data ) ):?>
                <h1>Edit User</h1>
            <?php else:?>
                    <h1>Add User</h1>
            <?php endif;?>    


                <?php
                    session_start();
                    if ( isset ( $_SESSION[ 'errors' ] ) ) {

                        $errors = $_SESSION[ 'errors' ];
                        $name = $_SESSION[ 'name' ];
                        $age = $_SESSION[ 'age' ];
                        $email = $_SESSION[ 'email' ];
                        $status = $_SESSION[ 'status' ];

                        unset( $_SESSION[ 'errors' ] );
                        unset( $_SESSION[ 'name' ] );
                        unset( $_SESSION[ 'age' ] );
                        unset( $_SESSION[ 'email' ] );
                        unset( $_SESSION[ 'status' ] );

                    }elseif ( isset( $_SESSION[ 'messages' ] ) ){

                        $messages = $_SESSION[ 'messages' ];
                        unset($_SESSION[ 'messages' ]);

                        foreach ( $messages as $message ) {
                            echo "<div class='col-12 bg-light rounded border border-success mb-1 p-2'><h3 style='font-size:15px;'>$message</h3></div>";
                        }
                    }
                ?>
                <form action="store.php" method="post">
                    <?php if( isset( $data ) ): ?>
                        <div class="mb-3">
                            <label for="id" class="form-label">Id:</label>
                            <input type="number" class="form-control" id="id" name="id" aria-describedby="emailHelp" value='<?=$data[ "id" ]?>' readonly>
                        </div>
                        <?php endif; ?>    

                    <div class="mb-3">
                        <label for="text" class="form-label">Name:</label>
                        <?php if( isset( $name ) ): ?>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="<?= $name ?>">
                        <?php elseif( isset( $data )): ?>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="<?= $data["name"] ?>">
                        <?php else:?>    
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" >
                        <?php endif;?>    
                        <?php if ( isset( $errors["name"] ) ) {
                            echo ("<div class='text-danger'>".$errors["name"]."</div>");
                        }
                        ?>
                    </div>    
                    <div class="mb-3">
                <label for="email" class="form-label">Email address:</label>
                <?php if( isset( $name ) ): ?>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?= $email ?>">
                <?php elseif( isset( $data )): ?>    
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?= $data["email"] ?>">
                <?php else: ?>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <?php endif;?>

                <?php if ( isset( $errors["email"] ) ) {
                            echo ("<div class='text-danger'>".$errors["email"]."</div>");
                        }
                ?>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <?php if( isset( $name ) ): ?>
                    <input type="number" class="form-control" id="age" name="age" aria-describedby="emailHelp" value="<?=$age ?>">
                        <?php else: ?>
                    <input type="number" class="form-control" id="age" name="age" aria-describedby="emailHelp" value="<?=$data["age"] ?>">
                <?php endif;?>
                
                <?php if ( isset( $errors["age"] ) ) {
                            echo ("<div class='text-danger'>".$errors["age"]."</div>");
                        }
                ?>
            </div>
            Status:
            <?php if ( isset($status) && $status == "active" ): ?>
            <div class="form-check"> 
                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active" checked>
                <label class="form-check-label" for="flexRadioDefault1" >
                    Active
                </label>
                </div>
            <div class="form-check">
                 <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="inactive">
                 <label class="form-check-label" for="flexRadioDefault2" >
                    InActive
                </label>
            </div>
            <?php elseif ( isset($status) && $status == "inactive" ): ?>
            <div class="form-check"> 
                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active" >
                <label class="form-check-label" for="flexRadioDefault1" >
                    Active
                </label>
                </div>
            <div class="form-check">
                 <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="inactive" checked>
                 <label class="form-check-label" for="flexRadioDefault2" >
                    InActive
                </label>
            </div>
            <?php else: ?>
            <div class="form-check"> 
                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active" <?php echo((isset($data) && $data["status"]=="active" ? "checked" : "")) ?>>
                <label class="form-check-label" for="flexRadioDefault1" >
                    Active
                </label>
                </div>
            <div class="form-check">
                 <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="inactive" <?php echo((isset($data) && $data["status"]=="inactive" ? "checked" : ""))?>>
                 <label class="form-check-label" for="flexRadioDefault2" >
                    InActive
                </label>
            </div>
            <?php endif; ?>            
                <?php if ( isset( $errors["status"] ) ) {
                            echo ("<div class='text-danger'>".$errors["status"]."</div>");
                        }
                ?>
                <?php if( isset($data)): ?>
                    <button type="submit" class="btn btn-secondary">Edit</button>
                <?php else: ?>    
                    <button type="submit" class="btn btn-secondary">Submit</button>
                <?php endif; ?>    
                    
            </form>
        </div>
    </div>
    </div>
    
</body>
<?php require_once "foot.php"?>