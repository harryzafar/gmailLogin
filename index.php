<?php
session_start();
require_once "config.php";
require_once 'vendor/autoload.php';

// init configuration
$clientID = "219487105703-otl03a75hu724fabdcf28notu2j8q3pv.apps.googleusercontent.com";
$clientSecret = "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";
$redirectUri = 'http://localhost/gmailLogin/';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile");


$login_url = $client->createAuthUrl();

if(isset($_SESSION['access_token'])){
    header('Location:dashboard.php');
    exit();
}
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
  
    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
  
    $id =  $google_account_info->id;
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;
    $picture =  $google_account_info->picture;
    $familyName = $google_account_info->familyName;
    $givenName = $google_account_info->givenName;
    $gender = $google_account_info->gender;
    $_SESSION['id'] = $id;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['picture'] = $picture;
    $_SESSION['familyName'] = $familyName;
    $_SESSION['givenName'] = $givenName;
    $_SESSION['gender'] = $gender;
    $_SESSION['access_token'] = $token;
  
    $sql = "INSERT INTO gmailLogin (client_id, first_name , last_name, email, picture_link, gender) values('$id', '$name', '$givenName', '$email','$picture','$gender')";
    mysqli_query($conn, $sql);
    header("Location:dashboard.php");
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
            <div class="col-12 text-center">
                <a href="<?php echo $login_url; ?>" class="btn btn-primary text-white" >Login</a>
            </div>
        </div>
    </div>
</body>
</html>