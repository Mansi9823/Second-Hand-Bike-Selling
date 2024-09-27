<?php
include('session.php');
if ($_SESSION['auth'] == false) {
    header("Location: login.php");
    exit(); // Ensure no further execution after redirection
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

// Handle deletion if delete_ids are set
if (isset($_POST['delete']) && isset($_POST['delete_ids']) && is_array($_POST['delete_ids'])) {
    $delete_ids = $_POST['delete_ids'];
    foreach ($delete_ids as $delete_id) {
        $stmt = $conn->prepare("DELETE FROM images WHERE id = ?");
        if (!$stmt) {
            echo "Error preparing delete statement: " . $conn->error;
        }
        $stmt->bind_param("i", $delete_id);
        if (!$stmt->execute()) {
            echo "Error executing delete statement: " . $stmt->error;
        }
    }
    echo "<script>alert('Selected records deleted successfully.');</script>";
}

// Handle updates if update button is clicked
if (isset($_POST['update']) && isset($_POST['bike_name'])) {
    foreach ($_POST['bike_name'] as $update_id => $bike_name) {
        // Ensure all fields are fetched and bound properly
        $age_of_vehicle = $_POST['age_of_vehicle'][$update_id];
        $sale_value = $_POST['sale_value'][$update_id];
        $model = $_POST['model'][$update_id];
        $make_year = $_POST['make_year'][$update_id];
        $km_driven = $_POST['km_driven'][$update_id];
        $registration_no = $_POST['registration_no'][$update_id];
        $registration_no_RTO = $_POST['registration_no_RTO'][$update_id];
        $registration_certificate = $_POST['registration_certificate'][$update_id];

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE images SET bike_name = ?, Age_of_Vehicle = ?, Sale_Value = ?, Model = ?, make_year = ?, km_driven = ?, registration_no = ?, registration_no_RTO = ?, Registration_Certificate = ? WHERE id = ?");
        if (!$stmt) {
            echo "Error preparing update statement: " . $conn->error;
        }
        
        // Bind parameters to the statement
        $stmt->bind_param("sssssssssi", $bike_name, $age_of_vehicle, $sale_value, $model, $make_year, $km_driven, $registration_no, $registration_no_RTO, $registration_certificate, $update_id);
        
        // Execute the statement
        if (!$stmt->execute()) {
            echo "Error executing update statement: " . $stmt->error;
        }
    }
    echo "<script>alert('Selected records updated successfully.');</script>";
}

// Fetch customer data
$sql = "SELECT id, bike_name, Age_of_Vehicle, Sale_Value, Model, make_year, km_driven, registration_no, registration_no_RTO, Registration_Certificate FROM images";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Data</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
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
        .delete-button, .download-button, .update-button {
            color: #fff;
            background-color: #e74c3c;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            display: block;
            margin: 20px auto;
        }
        .delete-button:hover {
            background-color: black;
        }
        .download-button:hover {
            background-color: #3498db;
        }
        .update-button:hover {
            background-color: #62a766;
        }
        .container {
            width: 90%;
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
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
    </style>
    <script>
        function confirmDelete(form) {
            if (confirm("Are you sure you want to delete selected records?")) {
                form.submit();
            }
        }

        function toggleSelectAll(selectAllCheckbox) {
            const checkboxes = document.querySelectorAll('input[name="delete_ids[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        }
        function downloadCSV() {
            var csvContent = "Bike Name,Age of Vehicle,Sale Value,Model,Make Year,KM Driven,Registration No,Registration No RTO,Registration Certificate\n";
            var rows = document.querySelectorAll("table tr");
            for (var i = 1; i < rows.length; i++) {
                var checkbox = rows[i].querySelector("input[type='checkbox']");
                if (checkbox && checkbox.checked) {
                    var cells = rows[i].querySelectorAll("td");
                    for (var j = 1; j < cells.length; j++) {
                        csvContent += cells[j].textContent + ",";
                    }
                    csvContent += "\n";
                }
            }
            if (csvContent === "Bike Name,Age of Vehicle,Sale Value,Model,Make Year,KM Driven,Registration No,Registration No RTO,Registration Certificate\n") {
                alert("No records selected for download.");
                return;
            }
            var encodedUri = encodeURI("data:text/csv;charset=utf-8," + csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "selected_bike_data.csv"); // Set a meaningful file name
            document.body.appendChild(link);
            link.click();
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Bike Information</h2>
        <form method="post" action="">
            <table>
                <tr>
                    <th class="checkbox-header"><input type="checkbox" onclick="toggleSelectAll(this)"></th>
                    <th>Bike Name</th>
                    <th>Age of Vehicle</th>
                    <th>Sale Value</th>
                    <th>Model</th>
                    <th>Make Year</th>
                    <th>KM Driven</th>
                    <th>Registration No</th>
                    <th>Registration No RTO</th>
                    <th>Registration Certificate</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='checkbox-cell'><input type='checkbox' name='delete_ids[]' value='" . $row['id'] . "'></td>";
                        echo "<td><input type='text' name='bike_name[" . $row['id'] . "]' value='" . $row['bike_name'] . "'></td>";
                        echo "<td><input type='text' name='age_of_vehicle[" . $row['id'] . "]' value='" . $row['Age_of_Vehicle'] . "'></td>";
                        echo "<td><input type='number' name='sale_value[" . $row['id'] . "]' value='" . $row['Sale_Value'] . "'></td>";
                        echo "<td><input type='text' name='model[" . $row['id'] . "]' value='" . $row['Model'] . "'></td>";
                        echo "<td><input type='text' name='make_year[" . $row['id'] . "]' value='" . $row['make_year'] . "'></td>";
                        echo "<td><input type='number' name='km_driven[" . $row['id'] . "]' value='" . $row['km_driven'] . "'></td>";
                        echo "<td><input type='text' name='registration_no[" . $row['id'] . "]' value='" . $row['registration_no'] . "'></td>";
                        echo "<td><input type='text' name='registration_no_RTO[" . $row['id'] . "]' value='" . $row['registration_no_RTO'] . "'></td>";
                        echo "<td><input type='text' name='registration_certificate[" . $row['id'] . "]' value='" . $row['Registration_Certificate'] . "'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No results found</td></tr>";
                }
                ?>
            </table>
            <button type="submit" name="delete" class="delete-button">Delete</button>
            <button type="submit" name="update" value="1" class="update-button">Update</button>
            <button type="button" name="download" onclick="downloadCSV()" class="download-button">Download</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
