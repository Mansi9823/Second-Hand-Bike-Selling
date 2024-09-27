<?php
include('session.php');
date_default_timezone_set("Asia/Kolkata");
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "UPDATE admin_user SET `password` = '$password' WHERE  `email` = '$email'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script type='text/javascript'>alert('Password Updated!');
            window.location='logout.php';
            </script>";
        ob_end_flush();
    } else {
        echo "<script type='text/javascript'>alert('Something Went Wrong!');
            window.location='reset-password.php';
            </script>";
        ob_end_flush();
    }
}