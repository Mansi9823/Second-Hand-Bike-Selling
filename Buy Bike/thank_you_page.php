<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        p {
            margin-bottom: 20px;
            color: #666;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: green;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You!</h1>
        <p>Dear Sir, Thank you for Your interest in the vehicle our executive will get in touch with you shortly</p>
        
        <button id="homeButton">Home</button>
    </div>

    <script>
        // Redirect to home page when homeButton is clicked
        document.getElementById("homeButton").addEventListener("click", function() {
            window.location.href = "Home.php"; // Replace index.html with the URL of your home page
        });
    </script>
</body>
</html>
