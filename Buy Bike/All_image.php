<?php
// Include database connection
include "db_conn.php";

// Check if the image ID is set in the URL
if (isset($_GET['image_id'])) {
    // Get the image ID from the URL
    $image_id = $_GET['image_id'];

    // Fetch the image data based on the image ID
    $sql_image = "SELECT * FROM images WHERE id = ?";
    $stmt_image = mysqli_prepare($conn, $sql_image);
    mysqli_stmt_bind_param($stmt_image, 'i', $image_id);
    mysqli_stmt_execute($stmt_image);
    $result_image = mysqli_stmt_get_result($stmt_image);

    // Display the image if found
    if (mysqli_num_rows($result_image) > 0) {
        $row_image = mysqli_fetch_assoc($result_image);
?>
        <style>
            body {
                background-color: #f0f0f0;
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            .navbar {
                background-color: #f0f0f0;
                padding: 10px 0;
                text-align: center;
            }

            .navbar a {
                display: inline-block;
                color: black;
                text-decoration: none;
                padding: 10px 20px;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            .navbar a:hover {
                background-color: #ddd;
            }

            .image-wrapper {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
            }

            .main-image {
                max-width: 100%;
                margin-bottom: 20px;
            }

            .additional-images {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                margin-bottom: 20px;
            }

            .additional-image {
                margin: 5px;
            }

            .additional-image img {
                max-width: 100px;
                height: auto;
                cursor: pointer;
            }

            .details-container {
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .bike-details {
                margin-bottom: 20px;
            }

            .detail-item {
                margin-bottom: 10px;
            }

            .detail-item strong {
                margin-right: 10px;
            }

            .buy-button {
                display: block;
                width: 100%;
                max-width: 200px;
                margin: 0 auto;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                background-color: #4CAF50;
                color: white;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .buy-button:hover {
                background-color: #45a049;
            }

            @media screen and (max-width: 768px) {
                .container {
                    padding: 10px;
                }

                .main-image {
                    max-width: 100%;
                    margin-bottom: 10px;
                }

                .details-container {
                    padding: 10px;
                }
            }

            .full-screen-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.8);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                cursor: pointer;
            }

            .full-screen-image {
                max-width: 90%;
                max-height: 90%;
                object-fit: contain;
                touch-action: none;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .bike-details {
                width: 100%;
                border-collapse: collapse;
                border: 1px solid #ddd;
            }

            .bike-details th,
            .bike-details td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            .bike-details th {
                background-color: #f2f2f2;
            }

            .bike-details tr:hover {
                transform: translateY(-5px);
                transition: transform 0.3s ease;
            }

            .buy-button.sold-out {
                background-color: #ff0000;
                cursor: not-allowed;
            }
        </style>

        <body>
            <!-- Navbar -->
            <div class="navbar">
                <a href="Home.php">Home</a>
                <a href="Contact_Us.php">Contact Us</a>
                <a href="index.php">Buy Bikes</a>
            </div>

            <div class="container">
                <!-- Main Image -->
                <div class="image-wrapper">
                    <img src="<?php echo htmlspecialchars($row_image['image_url']); ?>" alt="Main Image" class="main-image">
                </div>

                <!-- Additional Images -->
                <div class="additional-images">
                    <?php 
                    for($i = 1; $i <= 4; $i++) {
                        $additional_image = 'additional_image'.$i;
                        if(!empty($row_image[$additional_image])) {
                    ?>
                        <div class="additional-image">
                            <img src="<?php echo htmlspecialchars($row_image[$additional_image]); ?>" alt="Additional Image <?php echo $i; ?>" onclick="openFullScreenImage('<?php echo htmlspecialchars($row_image[$additional_image]); ?>')">
                        </div>
                    <?php
                        }
                    }
                    ?>
                </div>

                <!-- Bike Details -->
                <div class="details-container">
                    <h2><?php echo htmlspecialchars($row_image['bike_name']); ?></h2>
                    <p><strong style="color: green;">Age of Vehicle:</strong> <?php echo htmlspecialchars($row_image['Age_of_Vehicle']); ?></p>
                    <div class="table-responsive">
                        <table class="bike-details">
                            <tr>
                                <th>Sale Value</th>
                                <td><?php echo htmlspecialchars($row_image['Sale_Value']); ?></td>
                            </tr>
                            <tr>
                                <th>Model</th>
                                <td><?php echo htmlspecialchars($row_image['Model']); ?></td>
                            </tr>
                           
                            <tr>
                                <th>Make Year</th>
                                <td><?php echo htmlspecialchars($row_image['make_year']); ?></td>
                            </tr>
                            <tr>
                                <th>KM Driven</th>
                                <td><?php echo htmlspecialchars($row_image['km_driven']); ?></td>
                            </tr>
                            <tr>
                                <th>Registration Certificate</th>
                                <td><?php echo htmlspecialchars($row_image['Registration_Certificate']); ?></td>
                            </tr>
                            <tr>
                                <th>Registration No. RTO</th>
                                <td><?php echo htmlspecialchars($row_image['registration_no_RTO']); ?></td>
                            </tr>
                            <tr>
                                <th>Registration No</th>
                                <td><?php echo htmlspecialchars($row_image['registration_no']); ?></td>
                            </tr>
                            <tr>
                                <th>Sold Out</th>
                                <td><?php echo htmlspecialchars($row_image['sold_out']); ?></td>
                            </tr>
                        </table>
                    </div>
                    <button class="buy-button <?php if ($row_image['sold_out'] === 'yes') echo 'sold-out'; ?>" <?php if ($row_image['sold_out'] === 'yes') echo 'disabled'; ?> onclick="if('<?php echo $row_image['sold_out']; ?>' !== 'yes') location.href='Your_Information.php?bike_name=<?php echo urlencode($row_image['bike_name']); ?>&registration_no=<?php echo urlencode($row_image['registration_no']); ?>';">Enquire Now</button>
                </div>

                <!-- JavaScript for image zoom effect -->
                <script>
                    function openFullScreenImage(imageSrc) {
                        var fullScreenDiv = document.createElement('div');
                        fullScreenDiv.classList.add('full-screen-overlay');
                        
                        var fullScreenImg = document.createElement('img');
                        fullScreenImg.src = imageSrc;
                        fullScreenImg.classList.add('full-screen-image');
                        
                        fullScreenDiv.appendChild(fullScreenImg);
                        document.body.appendChild(fullScreenDiv);
                        
                        fullScreenDiv.addEventListener('click', closeFullScreenImage);
                        fullScreenImg.addEventListener('click', function(event) {
                            event.stopPropagation();
                        });
                    }
                    
                    function closeFullScreenImage() {
                        var fullScreenDiv = document.querySelector('.full-screen-overlay');
                        fullScreenDiv.parentNode.removeChild(fullScreenDiv);
                    }
                </script>
            </div>
        </body>
<?php
    } else {
        echo "Image not found for ID: $image_id";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Image ID not provided.";
}
?>
