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
function sanitize_input($data) {
    // Handle null values
    if ($data === null) {
        return '';
    }
    return htmlspecialchars(stripslashes(trim($data)));
}

// Fetch visitor data
$sql = "SELECT id, ip_address, visit_time, count FROM visitors";
$result = $conn->query($sql);

if (!$result) {
    echo "Error fetching visitors: " . $conn->error;
} else {
    // Calculate total count of visitors
    $total_visitors = $result->num_rows;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Visitor List</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                padding: 20px;
            }
            .container {
                max-width: 800px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            h1 {
                text-align: center;
                margin-bottom: 20px;
                color: #333;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            table th, table td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }
            table th {
                background-color: #b9e7b3;
                color: #333;
            }
            table td {
                background-color: #fff;
            }
            @media (max-width: 768px) {
                table {
                    font-size: 14px;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Visitor List</h1>
            <p>Total Visitors: <?php echo $total_visitors; ?></p>
            <table>
                <thead>
                    <tr>
                        <th>IP Address</th>
                        <th>Last Visit Time</th>
                        <th>Visit Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo sanitize_input($row['ip_address']); ?></td>
                            <td><?php echo sanitize_input($row['visit_time']); ?></td>
                            <td><?php echo sanitize_input($row['count']); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
    </html>
    <?php
}

// Close the database connection
$conn->close();
?>
