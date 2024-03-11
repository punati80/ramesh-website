<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "lms"; 


$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);


if (!$conn) {
    echo "Connected unsuccessfully";
    die("Connection failed: " . mysqli_connect_error());
}
?>
