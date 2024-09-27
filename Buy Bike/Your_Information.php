<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bignumber.js@10"></script>
    <title>Responsive Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #1f1f1f; /* Dark background */
            color: #eee; /* Light text */
        }

        .container {
            max-width: 500px;
            margin: auto;
            background-color: #333; /* Dark container background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #eee; /* Light text */
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #ddd; /* Lighter text for labels */
        }

        input[type="text"],
        input[type="tel"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #777; /* Darker border */
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #444; /* Dark input background */
            color: #eee; /* Light text */
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
        }

        .checkbox-label input[type="checkbox"] {
            margin-left: 10px;
        }

        .checkbox-label label {
            font-size: 16px;
            line-height: 1.5;
        }

        .resized-image {
            width: 100%; /* Adjust this value as needed */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
<?php
// Fetch bike_name and registration_no from URL if set
if (isset($_GET['bike_name']) && isset($_GET['registration_no'])) {
    $bike_name = htmlspecialchars($_GET['bike_name']);
    $registration_no = htmlspecialchars($_GET['registration_no']);
} else {
    $bike_name = "";
    $registration_no = "";
}
?>
<div class="container">
    <h2>Fill Your Information</h2>
    <form id="myForm" action="submit_form.php" method="post">
        <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" required>
        </div>
        <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" required>
        </div>
        <div class="form-group">
            <label for="mob">Mobile Number:</label>
            <input type="tel" id="mob" name="mob" maxlength="10" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="district">District:</label>
            <input type="text" id="district" name="district" required>
        </div>
        <div class="form-group">
            <label for="state">State:</label>
            <input type="text" id="state" name="state" required>
        </div>
        <div class="form-group">
            <label for="option">Employee of Sahayog:</label>
            <select id="option" name="option" required>
                <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</select>
        </div>
        <input type="hidden" name="bike_name" value="<?php echo $bike_name; ?>">
        <input type="hidden" name="registration_no" value="<?php echo $registration_no; ?>">
        <input type="submit" id="submitButton" value="Submit">
    </form>
</div>

<script>
    // Restrict input for specific fields
    document.getElementById('fname').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-Z]/g, '');
    });

    document.getElementById('lname').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-Z]/g, '');
    });

    document.getElementById('mob').addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    document.getElementById('district').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-Z]/g, '');
    });

    document.getElementById('state').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-Z]/g, '');
    });

    // BigNumber validation logic for the amount (commented out for now)
    // document.getElementById('amount').addEventListener('input', function () {
    //     // Remove any non-digit characters
    //     this.value = this.value.replace(/\D/g, '');

    //     // If the length exceeds a certain value, set it to 99999999.99
    //     if (this.value.length > 20) {
    //         this.value = '99999999.99';
    //     }
    // });

    // Enable/disable submit button based on checkbox state
    // document.getElementById('noteCheckbox').addEventListener('change', function() {
    //     var submitButton = document.getElementById('submitButton');
    //     submitButton.disabled = !this.checked;
    // });

    // Validate form before submission
    document.getElementById('myForm').addEventListener('submit', function(event) {
        // var checkbox = document.getElementById('noteCheckbox');
        // var message = document.getElementById('message');
        var mob = document.getElementById('mob').value;
        // var amount = document.getElementById('amount').value;

        // if (!checkbox.checked) {
        //     message.style.display = 'block';
        //     event.preventDefault();
        // } else 
        if (mob.length !== 10) {
            alert('Mobile number must be exactly 10 digits.');
            event.preventDefault();
        } else if (/^0+$/.test(mob)) {
            alert('Mobile number cannot be all zeros.');
            event.preventDefault();
        } 
        // else if (/^0+$/.test(amount)) {
        //     alert('Amount cannot be all zeros.');
        //     event.preventDefault();
        // } 
        else {
            // message.style.display = 'none';

            // Allow form submission and reset form after a short delay
            setTimeout(function() {
                document.getElementById('myForm').reset();
            }, 100);
        }
    });
</script>

</body>
</html>
