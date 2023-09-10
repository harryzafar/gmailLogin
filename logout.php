<?php
session_start();
require_once "config.php";
require_once 'vendor/autoload.php';

$client = new Google_Client();
unset($_SESSION['access_token']);
$client->revokeToken();
session_destroy();
header("Location: index.php");
?>