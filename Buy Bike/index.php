<!DOCTYPE html>
<html>
<head>
    <title>View</title>
    <!-- Corrected Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"  />
    
    <style>
        /* Your existing CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        /* Navbar styling */
        .navbar {
            background-color: black;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .whatsapp {
            display: flex;
            align-items: center;
        }

        .whatsapp i {
            font-size: 18px;
            margin-right: 5px;
        }

        .navbar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .navbar ul li {
            margin-right: 20px;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .navbar ul li a:hover {
            color: #62a766; /* Hover color */
        }

        .search-bar {
            display: flex;
            align-items: center;
        }

        .search-bar form {
            display: flex;
            align-items: center;
        }

        .search-bar input[type="text"] {
            padding: 8px;
            border: none;
            border-radius: 20px;
            margin-left: 5px;
            outline: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .search-bar button {
            padding: 8px 15px;
            background-color: black;
            border: none;
            border-radius: 20px;
            margin-left: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-bar button:hover {
            background-color: black; /* Hover color */
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 60px auto 0;
        }
.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 10px;
    text-align: center; /* Center-align text content */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card img {
    width: 100%; /* Ensure the image takes the full width of its container */
    height: auto; /* Auto height to maintain aspect ratio */
    max-height: 250px; /* Limit the maximum height for consistency */
    object-fit: cover; /* Ensure the image covers the entire area */
    border-radius: 8px; /* Maintain rounded corners */
    flex-grow: 1; /* Allow image to grow within the card */
}
        @media screen and (max-width: 1200px) {
            .container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media screen and (max-width: 768px) {
            .container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media screen and (max-width: 480px) {
            .container {
                grid-template-columns: 1fr;
            }
        }

        .detail-item {
            text-align: left;
            padding: 5px 0;
            font-weight: bold;
            text-align: center;
        }

        .detail-item1 {
            color: green;
            text-align: left;
            padding: 5px 0;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="whatsapp">
        <i class="fab fa-whatsapp" style="color: white;"></i>
        <span>+91 7448174494</span>
    </div>
    <ul>
        <li><a href="Home.php">Home</a></li>
        <li><a href="Contact_Us.php">Contact Us</a></li>
        <li><a href="index.php">Buy Bikes</a></li>
    </ul>
    <div class="search-bar">
        <form action="index.php" method="GET">
            <button type="submit"><i class="fas fa-search" style="color:white"></i></button>
            <input type="text" name="search" placeholder="Search by City">
        </form>
    </div>
    <div class="view-count">
        <span><?php echo $viewCount; ?></span>
    </div>
   
</div>

<div class="container">
    <?php
    include "db_conn.php";
// Fetch the current view count and view time
// Get visitor's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Check if the visitor has visited before
$sql_check = "SELECT * FROM `visitors` WHERE `ip_address` = '$ip_address'";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    // Update visit count for existing visitor
    $sql_update = "UPDATE `visitors` SET `visit_time` = NOW(), `count` = `count` + 1 WHERE `ip_address` = '$ip_address'";
    $update_result = mysqli_query($conn, $sql_update);

    if (!$update_result) {
        echo "Error updating visitor record: " . mysqli_error($conn);
    }
} else {
    // Insert new visitor record
    $sql_insert = "INSERT INTO `visitors` (`ip_address`, `visit_time`, `count`) VALUES ('$ip_address', NOW(), 1)";
    $insert_result = mysqli_query($conn, $sql_insert);

    if (!$insert_result) {
        echo "Error inserting visitor record: " . mysqli_error($conn);
    }
}




    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
    $sql = "SELECT * FROM `images`";
    if ($search) {
        $sql .= " WHERE `registration_no_RTO` LIKE '%$search%'";
    }
    $sql .= " ORDER BY `image_url` ASC";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        if (mysqli_num_rows($res) > 0) {
            while ($images = mysqli_fetch_assoc($res)) {
                ?>
                <div class="card">
                    <a href="All_image.php?image_id=<?php echo $images['id']; ?>">
                        <img src="<?php echo htmlspecialchars($images['image_url']); ?>" alt="Image">
                    </a>
                    <div class="detail-item">
                        <span><?php echo htmlspecialchars($images['bike_name']); ?></span>
                    </div>
                    <div class="detail-item1">
                        <span><?php echo htmlspecialchars($images['Model']); ?></span>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No images found.";
        }
        mysqli_free_result($res);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    ?>
</div>

</body>
</html>
