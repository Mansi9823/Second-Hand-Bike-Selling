<?php
// $conn = mysqli_connect('localhost', 'sahaycbe_sahayog', 'GJjJ&vGvZ5z', 'sahaycbe_sahayogdb');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$hostname = "localhost";
$username = "sahaycbe_Mansi";
$password = "sahayog@123";
$database = "sahaycbe_BUY_BIKE";

$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn){
    echo "Connection failed: " . mysqli_connect_error();
    exit();
}
?>
