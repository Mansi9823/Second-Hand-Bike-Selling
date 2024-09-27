<?php
include('session.php');
if ($_SESSION['auth'] == false) {
    header("Location: login.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Function to sanitize input
// Function to sanitize input
function sanitize_input($data) {
    // Handle null values
    if ($data === null) {
        return '';
    }
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_ids'])) {
    $delete_ids = $_POST['delete_ids'];
    if (!empty($delete_ids)) {
        $placeholders = implode(',', array_fill(0, count($delete_ids), '?'));
        $types = str_repeat('i', count($delete_ids));
        $stmt = $conn->prepare("DELETE FROM Customer_information WHERE id IN ($placeholders)");
        $stmt->bind_param($types, ...$delete_ids);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch customer data
$sql = "SELECT id, first_name, last_name, mobile_number, address, district, state, employee_status, submission_date, bike_name, registration_no FROM Customer_information";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer Data</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                color: #333;
                margin: 0;
                padding: 20px;
            }
            h1 {
                text-align: center;
                color: #444;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            th, td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th {
                background-color: #62a766;
                color: #fff;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            tr:hover {
                background-color: #f1f1f1;
            }
            .download-button, .delete-button {
                color: #fff;
                background-color: black;
                border: none;
                padding: 10px 20px;
                cursor: pointer;
                border-radius: 5px;
                font-size: 16px;
                display: block;
                margin: 20px auto;
                text-align: center;
            }
            .delete-button {
                background-color: #e74c3c;
            }
            .download-button:hover, .delete-button:hover {
                background-color: #2980b9;
            }
            .container {
                width: 100%;
                margin: auto;
                overflow: hidden;
            }
            .checkbox-header {
                text-align: center;
            }
            .checkbox-cell {
                text-align: center;
            }
            input[type="checkbox"] {
                transform: scale(1.5);
            }
        </style>
        <script>
        function toggleSelectAll(source) {
            var checkboxes = document.querySelectorAll(\'input[type="checkbox"]\');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        function downloadCSV() {
            var csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "first_name,last_name,mobile_number,address,district,state,employee_status,submission_date,bike_name,registration_no\n";
            var rows = document.querySelectorAll("table tr");
            for (var i = 1; i < rows.length; i++) {
                var checkbox = rows[i].querySelector("input[type=\'checkbox\']");
                if (checkbox && checkbox.checked) {
                    var cells = rows[i].querySelectorAll("td");
                    var rowContent = [];
                    for (var j = 1; j < cells.length; j++) {
                        rowContent.push(cells[j].textContent);
                    }
                    csvContent += rowContent.join(",") + "\n";
                }
            }
            if (csvContent === "data:text/csv;charset=utf-8,first_name,last_name,mobile_number,address,district,state,employee_status,submission_date,bike_name,registration_no\n") {
                alert("No records selected for download.");
                return;
            }
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "selected_bike_data.csv");
            document.body.appendChild(link);
            link.click();
        }
    </script>
    </head>
    <body>
        <div class="container">
            <h1>Customer Information</h1>
            <form method="post" action="">
            <table>
                <tr>
                    <th class="checkbox-header"><input type="checkbox" onclick="toggleSelectAll(this)"></th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile Number</th>
                    <th>Address</th>
                    <th>District</th>
                    <th>State</th>
                    <th>Employee Status</th>
                    <th>Submission Date</th>
                    <th>Bike Name</th>
                    <th>Registration No</th>
                </tr>';

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<tr>
                <td class="checkbox-cell"><input type="checkbox" name="delete_ids[]" value="' . sanitize_input($row["id"]) . '"></td>
                <td>' . sanitize_input($row["first_name"]) . '</td>
                <td>' . sanitize_input($row["last_name"]) . '</td>
                <td>' . sanitize_input($row["mobile_number"]) . '</td>
                <td>' . sanitize_input($row["address"]) . '</td>
                <td>' . sanitize_input($row["district"]) . '</td>
                <td>' . sanitize_input($row["state"]) . '</td>
                <td>' . sanitize_input($row["employee_status"]) . '</td>
                <td>' . sanitize_input($row["submission_date"]) . '</td>
                <td>' . sanitize_input($row["bike_name"]) . '</td>
                <td>' . sanitize_input($row["registration_no"]) . '</td>
              </tr>';
    }

    echo '</table>
            <button type="button" onclick="downloadCSV()" class="download-button">Download</button>
            <button type="submit" class="delete-button">Delete Selected</button>
            </form>
        </div>
    </body>
    </html>';
} else {
    echo "<p style='text-align: center; font-size: 20px;'>No records found</p>";
}

$conn->close();
?>
