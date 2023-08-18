<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "mohit-crud";
    $conn = new mysqli($servername,$username,$password,$dbname);
    $sql = "SELECT * FROM users WHERE id=".$_GET['id'].";";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc()
        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD APP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php include 'nav.php'?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 ">
                <?php


                    session_start();
                    if (isset($_SESSION['errors'])) {
                        $errors = $_SESSION['errors'];
                        unset($_SESSION['errors']);
                        foreach ($errors as $error) {
                            echo "<div class='col-12 bg-light rounded border border-danger mb-1'>$error</div>";
                        }
                    }
                ?>
                <form action="edit.php" method="post">
                    <div class="mb-3">
                        <label for="id" class="form-label">Id:</label>
                        <input type="number" class="form-control" id="id" name="id" aria-describedby="emailHelp" value='<?php echo($data["id"])?>' readonly>
                        
                    </div> 
                    <div class="mb-3">
                        <label for="text" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value='<?php echo($data["name"])?>'>
                        
                    </div>    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address:</label>
                        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" value='<?php echo($data["email"])?>'>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">age:</label>
                        <input type="number" class="form-control" id="age" name="age" aria-describedby="emailHelp" value='<?php echo($data["age"])?>'>
                    </div>
                    Status:
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active"<?php if($data["status"]=="active")echo "checked"?>>
                        <label class="form-check-label" for="flexRadioDefault1" >
                            Active
                        </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="inactive" <?php if($data["status"]=="inactive")echo "checked"?>>
                            <label class="form-check-label" for="flexRadioDefault2" >
                                InActive
                            </label>
                        </div>
                        <button type="submit" class="btn btn-secondary">Edit</button>
                    </form>
                </div>
            </div>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>