<?php
session_start();
require_once "config.php";

if(!isset($_SESSION['access_token'])){
    header('Location:index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with Gmail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6">
                <div>
                    <img src="<?php echo $_SESSION['picture']; ?>" class="img-fluid" width="200px" height="200px" alt="user_image">
                </div>
            </div>
            <div class="col-6">
                <?php
                $email = $_SESSION['email'];
                $name = $_SESSION['name'];
              
                $familyName = $_SESSION['familyName'];
                $givenName = $_SESSION['givenName'];
               $gender = $_SESSION['gender'];
                ?>
                <p>Name: <?php echo $name; ?></p>
                <p>Email: <?php echo $email; ?></p>
                <p>Family Name: <?php echo $familyName; ?></p>
                <p>Gender: <?php echo $gender; ?></p>
                <p>Gender: <?php echo $givenName; ?></p>
                
            </div>
        </div>
    </div>

</body>

</html>