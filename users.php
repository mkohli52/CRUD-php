<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD APP | User Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php include 'nav.php'?>
    <div class="container-flex">
        <div class="row justify-content-center">
            <div class="col-8 ">
            <?php
            session_start();
            if (isset($_SESSION['messages'])) {
                $messages = $_SESSION['messages'];
                unset($_SESSION['messages']);
                foreach ($messages as $message) {
                    echo "<div class='col-12 bg-light rounded border border-success mb-1'>$message</div>";
                }
            }
            ?>
            <table class="table" id="table">
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
                        $servername = "127.0.0.1";
                        $username = "root";
                        $password = "";
                        $dbname = "mohit-crud";
                        $conn = new mysqli($servername,$username,$password,$dbname);
                        $sql = "SELECT * FROM users";
                        if($conn->connect_error){
                            die("connection failed");
                    
                        }else{
                            $result = $conn->query($sql);
                            if($result->num_rows>0){
                                while ($data=$result->fetch_assoc()) {
                                    echo("<tr> <th scope='row'>".$data["id"]."</th><td>".$data["name"]."</td><td>".$data["email"]."</td><td>".$data["age"]."</td><td>".$data["status"]."</td><td class='m-3'><button type='button' class='btn btn-primary me-1'><a href='index.php?id=".$data["id"]."' class='text-white' style='text-decoration:none;' ?><i class='bi bi-pencil'></i></a></button><button type='button' class='btn btn-danger'><a href='deleteuser.php?id=".$data["id"]."' class='text-white' style='text-decoration:none;' ?><i class='bi bi-trash3-fill'></i></a></button></td></tr>");
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>

</html>