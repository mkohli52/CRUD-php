<?php if(isset($_GET["id"])){
    require_once "db_connection.php";
    $conn = new mysqli($servername,$username,$password,$dbname);
    $sql = "SELECT * FROM users WHERE id=".$_GET['id'].";";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD APP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <!-- Navbar -->
    <?php include 'nav.php'?>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-6 p-3 border border-secondary bg-light rounded rounded-3">


                <?php
                    session_start();
                    if (isset($_SESSION['errors'])) {
                        $errors = $_SESSION['errors'];
                        $name = $_SESSION['name'];
                        $age = $_SESSION['age'];
                        $email = $_SESSION['email'];
                        $status = $_SESSION['status'];
                        
                        unset($_SESSION['errors']);
                        unset($_SESSION['name']);
                        unset($_SESSION['age']);
                        unset($_SESSION['email']);
                        unset($_SESSION['status']);
                    }elseif(isset($_SESSION['messages'])){
                        $messages = $_SESSION['messages'];
                        unset($_SESSION['messages']);
                        foreach ($messages as $message) {
                            echo "<div class='col-12 bg-light rounded border border-success mb-1'>$message</div>";
                        }
                    }
                ?>
                <form action="store.php" method="post">
                    <?php if(isset($data)): ?>
                        <div class="mb-3">
                            <label for="id" class="form-label">Id:</label>
                            <input type="number" class="form-control" id="id" name="id" aria-describedby="emailHelp" value='<?php echo($data["id"])?>' readonly>
                        </div>
                        <?php endif; ?>    

                    <div class="mb-3">
                        <label for="text" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="<?php echo((isset($name) ? $name : "")); echo((isset($data) ? $data["name"] : "")) ?>">
                        <?php if ( isset( $errors["name"] ) ) {
                            echo ("<div class='text-danger'>".$errors["name"]."</div>");
                        }
                        ?>
                    </div>    
                    <div class="mb-3">
                <label for="email" class="form-label">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo((isset($email) ? $email : "")); echo((isset($data) ? $data["email"] : "")) ?>">
                <?php if ( isset( $errors["email"] ) ) {
                            echo ("<div class='text-danger'>".$errors["email"]."</div>");
                        }
                ?>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="number" class="form-control" id="age" name="age" aria-describedby="emailHelp" value="<?php echo((isset($age) ? $age : "")); echo((isset($data) ? $data["age"] : "")) ?>">
                <?php if ( isset( $errors["age"] ) ) {
                            echo ("<div class='text-danger'>".$errors["age"]."</div>");
                        }
                ?>
            </div>
            Status:
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active" <?php echo((isset($status) && $status=="active" ? "checked" : "")); echo((isset($data) && $data["status"]=="active" ? "checked" : "")) ?>>
                <label class="form-check-label" for="flexRadioDefault1" >
                    Active
                </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="inactive" <?php echo((isset($status) && $status=="inactive" ? "checked" : "")); echo((isset($data) && $data["status"]=="inactive" ? "checked" : ""))?>>
                    <label class="form-check-label" for="flexRadioDefault2" >
                        InActive
                    </label>
                </div>
                <?php if ( isset( $errors["status"] ) ) {
                            echo ("<div class='text-danger'>".$errors["status"]."</div>");
                        }
                ?>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </div>
    </div>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>