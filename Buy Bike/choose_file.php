<?php
include('session.php');
if ($_SESSION['auth'] == false) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload using PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f0f0f0;
        }
        .container {
            text-align: center;
        }
        .card {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .image-container {
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            background-color: #fff;
            text-align: center;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="file"], input[type="submit"] {
            margin: 5px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: calc(50% - 15px);
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #53c353;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: black;
        }
        .error, .success {
            margin-bottom: 10px;
            width: 100%;
            text-align: center;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        .button-container {
            display: flex;
            justify-content: center;
        }
        .redirect-button {
            background-color: black;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .redirect-button:hover {
            background-color: #53c353;
        }
        .left-align {
            margin-left: 7px;
            margin-top: -20px;
        }


    </style>
</head>
<body>

<?php if (isset($_GET['error'])): ?>
    <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php elseif (isset($_GET['success'])): ?>
    <p class="success"><?php echo htmlspecialchars($_GET['success']); ?></p>
<?php endif; ?>

   <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <input type="file" name="my_image" accept=".png, .jpg, .jpeg" required>
        <div class="card">
            <input type="file" name="additional_image1" accept=".png, .jpg, .jpeg" required>
            <input type="file" name="additional_image2" accept=".png, .jpg, .jpeg" required>
            <input type="file" name="additional_image3" accept=".png, .jpg, .jpeg" required>
            <input type="file" name="additional_image4" accept=".png, .jpg, .jpeg" required>
        </div>
        <input type="text" name="Model" id="Model" placeholder="Model" required>
        <input type="text" name="bike_name" id="bike_name" placeholder="Bike Name" required>
        <input type="text" name="make_year" id="make_year" placeholder="Make Year" onchange="calculateAge()" required>
        <input type="text" name="Age_of_Vehicle" id="Age_of_Vehicle" placeholder="Age of Vehicle" required >
        <input type="text" name="km_driven" id="km_driven" placeholder="KM Driven" required>
        <input type="text" name="Sale_Value" id="Sale_Value" placeholder="Sale Value" required>
        <input type="text" name="registration_no" id="registration_no" placeholder="Registration No" required>
        <input type="text" name="registration_no_RTO" id="registration_no_RTO" placeholder="Registration RTO" required>
      
        <div>
            <label for="sold_out" class="left-align">Sold Out:</label>
            <select name="sold_out" id="sold_out" required>
                <option value="" disabled selected hidden>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div>
            <label for="Registration_Certificate">Registration Certificate:</label>
            <select name="Registration_Certificate" id="Registration_Certificate" required>
                <option value="" disabled selected hidden>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <input type="submit" name="submit" value="Upload">
    </form>





<div class="button-container">
    <button class="redirect-button" onclick="redirectToPage1()">Customer Information</button>
    <button class="redirect-button" onclick="redirectToPage2()">Images Information</button>
    <button class="redirect-button" onclick="redirectToPage3()">Visitor Information</button>
</div>
<form action="logout.php" method="post"style="padding: 6px 12px;">
    <input type="submit" value="Logout" class="logout-button"style="color: black; background-color: #ddd1d1; font-weight: bold; font-size: 14px; ">
</form>


<script>



    // Trigger the calculation when the page loads
    window.onload = calculateAge;
    function validateForm() {
        //var bikeNameInput = document.getElementById('bike_name');
       // var bikeName = bikeNameInput.value.trim();
       // var regex = /^[a-zA-Z\s]+$/;

       // if (!regex.test(bikeName)) {
      //      alert('Bike name should contain only alphabets!');
      //      bikeNameInput.focus();
      //      return false;
       // }

        var ageOfVehicleInput = document.getElementById('Age_of_Vehicle');
        var ageOfVehicle = ageOfVehicleInput.value.trim();
        var ageRegex = /^[a-zA-Z0-9\s]+$/;

        if (!ageRegex.test(ageOfVehicle)) {
            alert('Age of Vehicle should contain alphabets and/or numbers!');
            ageOfVehicleInput.focus();
            return false;
        }

        return true;
    }
  document.getElementById('bike_name').addEventListener('keydown', function(event) {
    // Allow: backspace, delete, tab, escape, enter, and arrow keys
    if (
        [8, 9, 27, 13, 46].indexOf(event.keyCode) !== -1 || 
        // Allow: Ctrl/cmd+A, Ctrl/cmd+C, Ctrl/cmd+X, Ctrl/cmd+V
        (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 67 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 88 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 86 && (event.ctrlKey === true || event.metaKey === true)) || 
        // Allow: home, end, left, right, down, up
        (event.keyCode >= 35 && event.keyCode <= 40) ||
        // Allow space
        (event.keyCode === 32) ||
        // Allow zero key in numeric keypad
        (event.keyCode === 96)
    ) {
        return; // Allow the event
    }
    // Ensure it is a number or letter and stop the keypress if it is not
    if (!((event.keyCode >= 48 && event.keyCode <= 57) || // Numbers
        (event.keyCode >= 65 && event.keyCode <= 90) || // Uppercase letters
        (event.keyCode >= 97 && event.keyCode <= 122))) { // Lowercase letters
        event.preventDefault();
    }
});

document.getElementById('bike_name').addEventListener('input', function(event) {
    let inputValue = event.target.value;

    // Remove any special characters
    inputValue = inputValue.replace(/[^a-zA-Z0-9\s]/g, '');

    // Prevent only zero value
    if (inputValue === '0') {
        event.target.value = '';
    } else {
        event.target.value = inputValue;
    }
});

        
        document.getElementById('Model').addEventListener('keydown', function(event) {
    // Allow: backspace, delete, tab, escape, enter, and arrow keys
    if (
        [8, 9, 27, 13, 46].indexOf(event.keyCode) !== -1 || 
        // Allow: Ctrl/cmd+A, Ctrl/cmd+C, Ctrl/cmd+X, Ctrl/cmd+V
        (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 67 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 88 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 86 && (event.ctrlKey === true || event.metaKey === true)) || 
        // Allow: home, end, left, right, down, up
        (event.keyCode >= 35 && event.keyCode <= 40) ||
        // Allow space
        (event.keyCode === 32) ||
        // Allow zero key in numeric keypad
        (event.keyCode === 96)
    ) {
        return; // Allow the event
    }
    // Ensure it is a number or letter and stop the keypress if it is not
    if (!((event.keyCode >= 48 && event.keyCode <= 57) || // Numbers
        (event.keyCode >= 65 && event.keyCode <= 90) || // Uppercase letters
        (event.keyCode >= 97 && event.keyCode <= 122))) { // Lowercase letters
        event.preventDefault();
    }
});

document.getElementById('Model').addEventListener('input', function(event) {
    let inputValue = event.target.value;

    // Remove any special characters
    inputValue = inputValue.replace(/[^a-zA-Z0-9\s]/g, '');

    // Prevent only zero value
    if (inputValue === '0') {
        event.target.value = '';
    } else {
        event.target.value = inputValue;
    }
});

      document.getElementById('bike_name').addEventListener('keydown', function(event) {
    // Allow: backspace, delete, tab, escape, enter, and arrow keys
    if (
        [8, 9, 27, 13, 46].indexOf(event.keyCode) !== -1 || 
        // Allow: Ctrl/cmd+A, Ctrl/cmd+C, Ctrl/cmd+X, Ctrl/cmd+V
        (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 67 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 88 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 86 && (event.ctrlKey === true || event.metaKey === true)) || 
        // Allow: home, end, left, right, down, up
        (event.keyCode >= 35 && event.keyCode <= 40) ||
        // Allow space
        (event.keyCode === 32) ||
        // Allow zero key in numeric keypad
        (event.keyCode === 96)
    ) {
        return; // Allow the event
    }
    // Ensure it is a number or letter and stop the keypress if it is not
    if (!((event.keyCode >= 48 && event.keyCode <= 57) || // Numbers
        (event.keyCode >= 65 && event.keyCode <= 90) || // Uppercase letters
        (event.keyCode >= 97 && event.keyCode <= 122))) { // Lowercase letters
        event.preventDefault();
    }
});

document.getElementById('bike_name').addEventListener('input', function(event) {
    let inputValue = event.target.value;

    // Remove any special characters
    inputValue = inputValue.replace(/[^a-zA-Z0-9\s]/g, '');

    // Prevent only zero value
    if (inputValue === '0') {
        event.target.value = '';
    } else {
        event.target.value = inputValue;
    }
});

           document.getElementById('registration_no').addEventListener('keydown', function(event) {
            // Allow: backspace, delete, tab, escape, enter, and arrow keys
            if (
                [8, 9, 27, 13, 46].indexOf(event.keyCode) !== -1 || 
                // Allow: Ctrl/cmd+A, Ctrl/cmd+C, Ctrl/cmd+X, Ctrl/cmd+V
                (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
                (event.keyCode === 67 && (event.ctrlKey === true || event.metaKey === true)) || 
                (event.keyCode === 88 && (event.ctrlKey === true || event.metaKey === true)) || 
                (event.keyCode === 86 && (event.ctrlKey === true || event.metaKey === true)) || 
                // Allow: home, end, left, right, down, up
                (event.keyCode >= 35 && event.keyCode <= 40) ||
                // Allow space
                (event.keyCode === 32)
            ) {
                return; // Allow the event
            }
            // Ensure it is a number or letter and stop the keypress if it is not
            if (!((event.keyCode >= 48 && event.keyCode <= 57) || // Numbers
                (event.keyCode >= 65 && event.keyCode <= 90) || // Uppercase letters
                (event.keyCode >= 97 && event.keyCode <= 122))) { // Lowercase letters
                event.preventDefault();
            }
        });
        document.getElementById('registration_no').addEventListener('input', function(event) {
            let inputValue = event.target.value;

            // Remove any special characters
            inputValue = inputValue.replace(/[^a-zA-Z0-9\s]/g, '');

            // Prevent only zero value
            if (inputValue === '0') {
                event.target.value = '';
            } else {
                event.target.value = inputValue;
            }
        });
       
          
            document.getElementById('km_driven').addEventListener('keydown', function(event) {
            // Allow: backspace, delete, tab, escape, enter, and arrow keys
            if (
                [8, 9, 27, 13, 46].indexOf(event.keyCode) !== -1 || 
                // Allow: Ctrl/cmd+A, Ctrl/cmd+C, Ctrl/cmd+X, Ctrl/cmd+V
                (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
                (event.keyCode === 67 && (event.ctrlKey === true || event.metaKey === true)) || 
                (event.keyCode === 88 && (event.ctrlKey === true || event.metaKey === true)) || 
                (event.keyCode === 86 && (event.ctrlKey === true || event.metaKey === true)) || 
                // Allow: home, end, left, right, down, up
                (event.keyCode >= 35 && event.keyCode <= 40)
            ) {
                return; // Allow the event
            }
            // Ensure it is a number and stop the keypress if it is not
            if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                event.preventDefault();
            }
        });

        document.getElementById('km_driven').addEventListener('input', function(event) {
            const inputValue = event.target.value;

            // Prevent only zero value
            if (inputValue === '0') {
                event.target.value = '';
            }
        });
          document.getElementById('Principal_outstanding').addEventListener('keydown', function(event) {
            // Allow: backspace, delete, tab, escape, enter, and arrow keys
            if (
                [8, 9, 27, 13, 46].indexOf(event.keyCode) !== -1 || 
                // Allow: Ctrl/cmd+A, Ctrl/cmd+C, Ctrl/cmd+X, Ctrl/cmd+V
                (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
                (event.keyCode === 67 && (event.ctrlKey === true || event.metaKey === true)) || 
                (event.keyCode === 88 && (event.ctrlKey === true || event.metaKey === true)) || 
                (event.keyCode === 86 && (event.ctrlKey === true || event.metaKey === true)) || 
                // Allow: home, end, left, right, down, up
                (event.keyCode >= 35 && event.keyCode <= 40)
            ) {
                return; // Allow the event
            }
            // Ensure it is a number and stop the keypress if it is not
            if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                event.preventDefault();
            }
        });

        document.getElementById('Principal_outstanding').addEventListener('input', function(event) {
            const inputValue = event.target.value;

            // Prevent only zero value
            if (inputValue === '0') {
                event.target.value = '';
            }
        });
    document.getElementById('Sale_Value').addEventListener('keydown', function(event) {
            // Allow: backspace, delete, tab, escape, enter, and arrow keys
            if (
                [8, 9, 27, 13, 46].indexOf(event.keyCode) !== -1 || 
                // Allow: Ctrl/cmd+A, Ctrl/cmd+C, Ctrl/cmd+X, Ctrl/cmd+V
                (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
                (event.keyCode === 67 && (event.ctrlKey === true || event.metaKey === true)) || 
                (event.keyCode === 88 && (event.ctrlKey === true || event.metaKey === true)) || 
                (event.keyCode === 86 && (event.ctrlKey === true || event.metaKey === true)) || 
                // Allow: home, end, left, right, down, up
                (event.keyCode >= 35 && event.keyCode <= 40)
            ) {
                return; // Allow the event
            }
            // Ensure it is a number and stop the keypress if it is not
            if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                event.preventDefault();
            }
        });

        document.getElementById('Sale_Value').addEventListener('input', function(event) {
            const inputValue = event.target.value;

            // Prevent only zero value
            if (inputValue === '0') {
                event.target.value = '';
            }
        });
  document.getElementById('registration_no_RTO').addEventListener('keydown', function(event) {
            // Allow: backspace, delete, tab, escape, enter, and arrow keys
            if (
                [8, 9, 27, 13, 46].indexOf(event.keyCode) !== -1 || 
                // Allow: home, end, left, right, down, up
                (event.keyCode >= 35 && event.keyCode <= 40)
            ) {
                return; // Allow the event
            }
            // Ensure it is a letter and stop the keypress if it is not
            if (!(event.keyCode >= 65 && event.keyCode <= 90) && // Uppercase letters
                !(event.keyCode >= 97 && event.keyCode <= 122)) { // Lowercase letters
                event.preventDefault();
            }
        });
   
      
      document.getElementById('make_year').addEventListener('keydown', function(event) {
    // Allow: backspace, delete, tab, escape, enter, and arrow keys
    if (
        [8, 9, 27, 13, 46].indexOf(event.keyCode) !== -1 || 
        // Allow: Ctrl/cmd+A, Ctrl/cmd+C, Ctrl/cmd+X, Ctrl/cmd+V
        (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 67 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 88 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 86 && (event.ctrlKey === true || event.metaKey === true)) || 
        // Allow: home, end, left, right, down, up
        (event.keyCode >= 35 && event.keyCode <= 40) ||
        // Allow space
        (event.keyCode === 32) ||
        // Allow zero key in numeric keypad
        (event.keyCode === 96)
    ) {
        return; // Allow the event
    }
    // Ensure it is a number or letter and stop the keypress if it is not
    if (!((event.keyCode >= 48 && event.keyCode <= 57) || // Numbers
        (event.keyCode >= 65 && event.keyCode <= 90) || // Uppercase letters
        (event.keyCode >= 97 && event.keyCode <= 122))) { // Lowercase letters
        event.preventDefault();
    }
});

document.getElementById('make_year').addEventListener('input', function(event) {
    let inputValue = event.target.value;

    // Remove any special characters
    inputValue = inputValue.replace(/[^a-zA-Z0-9\s]/g, '');

    // Prevent only zero value
    if (inputValue === '0') {
        event.target.value = '';
    } else {
        event.target.value = inputValue;
    }
});



        document.getElementById('make_year').addEventListener('input', function(event) {
            let inputValue = event.target.value;

            // Remove any non-digit characters
           // inputValue = inputValue.replace(/\D/g, '');

            // Ensure input is limited to four digits
           // if (inputValue.length > 4) {
              //  inputValue = inputValue.slice(0, 4);
          //  }

            // Prevent the input from starting with zero
            if (inputValue.startsWith("0")) {
                inputValue = "";
                alert("Make Year cannot start with zero.");
            }

            event.target.value = inputValue;
        });
   document.getElementById('Age_of_Vehicle').addEventListener('keydown', function(event) {
    // Allow: backspace, delete, tab, escape, enter, and arrow keys
    if (
        [8, 9, 27, 13, 46].indexOf(event.keyCode) !== -1 || 
        // Allow: Ctrl/cmd+A, Ctrl/cmd+C, Ctrl/cmd+X, Ctrl/cmd+V
        (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 67 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 88 && (event.ctrlKey === true || event.metaKey === true)) || 
        (event.keyCode === 86 && (event.ctrlKey === true || event.metaKey === true)) || 
        // Allow: home, end, left, right, down, up
        (event.keyCode >= 35 && event.keyCode <= 40) ||
        // Allow space
        (event.keyCode === 32) ||
        // Allow zero key in numeric keypad
        (event.keyCode === 96)
    ) {
        return; // Allow the event
    }
    // Ensure it is a number or letter and stop the keypress if it is not
    if (!((event.keyCode >= 48 && event.keyCode <= 57) || // Numbers
        (event.keyCode >= 65 && event.keyCode <= 90) || // Uppercase letters
        (event.keyCode >= 97 && event.keyCode <= 122))) { // Lowercase letters
        event.preventDefault();
    }
});

document.getElementById('Age_of_Vehicle').addEventListener('input', function(event) {
    let inputValue = event.target.value;

    // Remove any special characters
    inputValue = inputValue.replace(/[^a-zA-Z0-9\s]/g, '');

    // Prevent only zero value
    if (inputValue === '0') {
        event.target.value = '';
    } else {
        event.target.value = inputValue;
    }
});

        function calculateAge() {
            var makeYear = document.getElementById('make_year').value;
            //var currentDate = new Date();
           // var currentYear = currentDate.getFullYear();

            // Ensure makeYear is exactly four digits, not in the future, and not "0000" or "0"
           // if (makeYear.length !== 4 || isNaN(makeYear) || makeYear === "0000" || makeYear === "0" || parseInt(makeYear) > currentYear) {
           //     alert("Please enter a valid make year.");
           //     document.getElementById('make_year').value = ""; // Clear the input field
          //      return;
         //   }

            var age = currentYear - parseInt(makeYear);
            document.getElementById('Age_of_Vehicle').value = age;
        }

        function validateForm() {
            var makeYear = document.getElementById('make_year').value;

            // Ensure makeYear is exactly four digits and not "0000" or "0"
          //  if (makeYear.length !== 4 || makeYear === "0000" || makeYear === "0") {
          //      alert("Make Year must be exactly 4 digits and cannot be 0000 or 0.");
           //     return false; // Prevent form submission
           // }

            // Ensure makeYear is not in the future
            var currentYear = new Date().getFullYear();
            if (parseInt(makeYear) > currentYear) {
                alert("Make Year cannot be in the future.");
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
       
    function redirectToPage1() {
        window.location.href = 'https://sahayogcredits.in/seizedvehicle/customer_data.php';
    }

    function redirectToPage2() {
        window.location.href = 'https://sahayogcredits.in/seizedvehicle/image_data.php';
    }

  function redirectToPage3() {
        window.location.href = 'https://sahayogcredits.in/seizedvehicle/visitor_data.php';
    }

    // Reset form after successful submission
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            document.getElementById('uploadForm').reset();
        }
    }
</script>

</body>
</html>
