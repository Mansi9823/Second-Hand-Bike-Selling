<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set the default timezone
date_default_timezone_set('Asia/Kolkata'); // Adjust to your timezone

// Function to sanitize input data
function sanitize_input($data) {
    if (isset($data) && !is_null($data)) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    } else {
        $data = '';
    }
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $first_name = sanitize_input($_POST['fname']);
    $last_name = sanitize_input($_POST['lname']);
    $mobile_number = sanitize_input($_POST['mob']);
    $address = sanitize_input($_POST['address']);
    $district = sanitize_input($_POST['district']);
    $state = sanitize_input($_POST['state']);
    $employee_status = sanitize_input($_POST['option']);
    $submission_date = date("Y-m-d H:i:s");
    $bike_name = isset($_POST['bike_name']) ? sanitize_input($_POST['bike_name']) : '';
    $registration_no = isset($_POST['registration_no']) ? sanitize_input($_POST['registration_no']) : '';

    // Establish database connection (replace with your actual database credentials)
    $hostname = "localhost";
    $username = "sahaycbe_Mansi";
    $password = "sahayog@123";
    $database = "sahaycbe_BUY_BIKE";

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL injection prevention: use prepared statements
    $stmt = $conn->prepare("INSERT INTO Customer_information (first_name, last_name, mobile_number, address, district, state, employee_status, submission_date, bike_name, registration_no) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $first_name, $last_name, $mobile_number, $address, $district, $state, $employee_status, $submission_date, $bike_name, $registration_no);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Send email
        $to = "sakshi.k@sahayogmultistate.co.in, asheesh.c@sahayogmultistate.com, mansiyadav2962000@gmail.com";
        $subject = "New Form Submission";

        // HTML message with responsive card layout
        $message = '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>New Form Submission</title>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                        <style>
                            /* Card styles */
                            .card {
                                border: 1px solid #ccc;
                                border-radius: 5px;
                                overflow: hidden;
                                margin-bottom: 20px;
                                max-width: 400px; /* Adjust maximum width */
                                margin: 0 auto; /* Center the card */
                                position: relative; /* Make the position relative for absolute positioning */
                            }
                            .card-header {
                                background-color: green;
                                color: white;
                                padding: 8px; /* Reduce header padding */
                                font-size: 16px; /* Reduce header font size */
                                position: relative; /* Make the position relative for absolute positioning */
                            }
                            .notification-icon {
                                position: absolute;
                                top: 50%;
                                right: 10px;
                                transform: translateY(-50%);
                            }
                            .card-body {
                                padding: 16px; /* Reduce body padding */
                                font-size: 14px; /* Reduce body font size */
                            }
                            /* Table styles */
                            table {
                                width: 100%;
                                border-collapse: collapse;
                            }
                            th, td {
                                padding: 6px; /* Reduce table cell padding */
                                text-align: left;
                                border-bottom: 1px solid #ddd;
                            }
                            @media only screen and (max-width: 600px) {
                                /* Adjust styles for smaller screens */
                                .card {
                                    max-width: none; /* Remove max-width on smaller screens */
                                }
                            }
                        </style>
                    </head>
                    <body>
                        <div class="card">
                            <div class="card-header">
                                New Form Submission
                                <span class="notification-icon"><i class="fa fa-bell"></i></span>
                            </div>
                            <div class="card-body">
                                <table>';

        // Add form submission details to the table
        $message .= '<tr><th>First Name</th><td>' . $first_name . '</td></tr>';
        $message .= '<tr><th>Last Name</th><td>' . $last_name . '</td></tr>';
        $message .= '<tr><th>Mobile Number</th><td>' . $mobile_number . '</td></tr>';
        $message .= '<tr><th>Address</th><td>' . $address . '</td></tr>';
        $message .= '<tr><th>District</th><td>' . $district . '</td></tr>';
        $message .= '<tr><th>State</th><td>' . $state . '</td></tr>';
        $message .= '<tr><th>Employee of Sahayog</th><td>' . $employee_status . '</td></tr>';
        $message .= '<tr><th>Submission Date</th><td>' . $submission_date . '</td></tr>';
        $message .= '<tr><th>Bike Name</th><td>' . $bike_name . '</td></tr>'; // Add bike_name to the email message
        $message .= '<tr><th>Registration Number</th><td>' . $registration_no . '</td></tr>'; // Add registration_no to the email message

        $message .= '</table>
                            </div>
                        </div>
                    </body>
                    </html>';

        // Additional email headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // Send email
        if (mail($to, $subject, $message, $headers)) {
            // Redirect to thank you page
            header("Location: thank_you_page.php");
            exit();
        } else {
            echo "Email sending failed!";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to error page or handle form submission failure
    echo "Form submission error!";
}
?>
