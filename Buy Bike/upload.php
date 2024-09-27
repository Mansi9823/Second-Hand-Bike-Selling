<?php
session_start();
if ($_SESSION['auth'] == false) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit']) && isset($_FILES['my_image']) && isset($_FILES['additional_image1']) && isset($_FILES['additional_image2']) && isset($_FILES['additional_image3']) && isset($_FILES['additional_image4'])) {
    include "db_conn.php";

    $errors = [];
    $upload_paths = [];
    $files = [
        'my_image' => $_FILES['my_image'],
        'additional_image1' => $_FILES['additional_image1'],
        'additional_image2' => $_FILES['additional_image2'],
        'additional_image3' => $_FILES['additional_image3'],
        'additional_image4' => $_FILES['additional_image4']
    ];

    foreach ($files as $key => $file) {
        if ($file['error'] !== 0) {
            $errors[] = "Error occurred while uploading $key.";
        } elseif ($file['size'] > 825000) {
            $errors[] = "File $key is too large.";
        } else {
            $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($file_ext, ['jpg', 'jpeg', 'png'])) {
                $errors[] = "Invalid file type for $key.";
            } else {
                $new_file_name = uniqid("IMG-", true) . '.' . $file_ext;
                $upload_paths[$key] = '../uploads/' . $new_file_name;
                if (!move_uploaded_file($file['tmp_name'], $upload_paths[$key])) {
                    $errors[] = "Error occurred while moving $key to upload directory.";
                }
            }
        }
    }

    if (empty($errors)) {
        $bike_name = $_POST['bike_name'];
        $Age_of_Vehicle = $_POST['Age_of_Vehicle'];
        $Sale_Value = $_POST['Sale_Value'];
        $Model = $_POST['Model'];
        $make_year = $_POST['make_year'];
        $km_driven = $_POST['km_driven'];
        $registration_no = $_POST['registration_no'];
        $registration_no_RTO = $_POST['registration_no_RTO'];
        $Registration_Certificate = $_POST['Registration_Certificate'];
        $sold_out = $_POST['sold_out'];

        $sql = "INSERT INTO images (image_url, bike_name, Model, make_year, km_driven, registration_no, additional_image1, additional_image2, additional_image3, additional_image4, registration_no_RTO, Registration_Certificate, Sale_Value, Age_of_Vehicle, sold_out) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssssssssssss", 
                $upload_paths['my_image'], 
                $bike_name, 
                $Model, 
                $make_year, 
                $km_driven, 
                $registration_no, 
                $upload_paths['additional_image1'], 
                $upload_paths['additional_image2'], 
                $upload_paths['additional_image3'], 
                $upload_paths['additional_image4'], 
                $registration_no_RTO, 
                $Registration_Certificate, 
                $Sale_Value, 
                $Age_of_Vehicle, 
                $sold_out
            );

            if (mysqli_stmt_execute($stmt)) {
                header("Location: choose_file.php?success=Images uploaded successfully!");
                exit();
            } else {
                echo "Error executing the statement: " . mysqli_error($conn);
            }
        } else {
            echo "Error preparing the statement: " . mysqli_error($conn);
        }
    } else {
        $em = implode("<br>", $errors);
        header("Location: choose_file.php?error=" . urlencode($em));
        exit();
    }
} else {
    header("Location: choose_file.php");
    exit();
}
?>
