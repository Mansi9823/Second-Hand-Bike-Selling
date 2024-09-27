<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bike Shop</title>
  <!-- Include your CSS and font awesome links here -->
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
    crossorigin="anonymous" />

  </head>
  <style>
      body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background: linear-gradient(
    180deg,
    rgb(78, 215, 122) 8%,
    rgba(140, 219, 150, 0.68) 27%,
    rgb(244, 244, 244) 100%
  );
}
.buy-bike-button {
  background-color: black;
  color: white; /* Text color */
  /* Add any other styles you need */
}

.buy-bike-button a {
  color: inherit; /* Inherit text color from parent */
  text-decoration: none; /* Remove underline */
  /* Add any other styles for the link */
}
/*navbar*/

  .navbar {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 0 10px;
    background-color: linear-gradient(
      180deg,
      rgb(78, 215, 122) 8%,
      rgba(140, 219, 150, 0.68) 27%,
      rgb(244, 244, 244) 100%
    );
  }

        .navbar {
            background-color: ;
            color:black;
            padding: 5px 20px;
            display: flex;
            justify-content: space-between; /* Space between items */
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
        }

        .navbar .whatsapp {
            display: flex;
            align-items: center;
            transition: transform 0.3s ease, color 0.3s ease; /* Transition effect for motion and color */
        }

        .navbar .whatsapp:hover {
            transform: translateY(-5px); /* Move up slightly on hover */
            color: white; /* Change color on hover */
        }

        .navbar .whatsapp i {
            margin-right: 10px;
            color: white; /* Make the icon color white */
            margin-top: -2px; /* Adjust this value to move the icon up */
        }



        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar li {
            margin-right: 20px;
            transition: color 0.3s ease;
        }

        .navbar a {
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            color:white;
        }

.main-content {
  text-align: left;
  padding: 175px;
  line-height: 1.2;
  font-family: Houschka-medium; /* Set font to Arial */
  font-weight: bold; /* Set font weight to bold */
}


h1,
p {
  margin-bottom: 10px;
}

.buy-bike-button {
  background-color: #1fa32a;
  color: #fff;
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  font-family: Arial;
  font-weight: bold;
}

.buy-bike-button:hover {
  background-color: #000000;
}

h1 {
  margin: 0;
  padding: 0;
}

.main-content div,
.main-content button {
  margin-bottom: 30px;
}

@media (max-width: 768px) {
  /* Add responsive styles here */
}
a[href="#home"],
a[href="#about"],
a[href="#services"] {
  color: white;
}
/* Footer styles */
/* Footer styles */
footer {
  background-color: #333;
  color: #fff;
  padding: 20px 0;
  width: 150%;
}

.footer-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: flex-start;
  max-width: 1200px;
  margin: 0 auto;
}

.footer-logo img {
  width: 100px;
  height: auto;
}

.footer-contact p {
  margin: 5px 0;
}

.footer-social {
  margin-top: 20px;
}

.footer-social a {
  color: #fff;
  font-size: 20px;
  margin-right: 10px;
}

/* Adjustments for smaller screens */
@media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
    align-items: center;
  }

  .footer-contact {
    text-align: center;
    margin-top: 20px;
  }
}

.image-content {
  float: right; /* Float the image to the right */
  margin-left: 10px; /* Add some space between the image and other content */
  margin-top: -470px;
}
   .login-button {
       position: relative;
    display: inline-block;
    padding: 8px 16px; /* Reduced padding */
    color: #000; /* Font color to black */
    font-size: 14px; /* Reduced font size */
    text-decoration: none; /* Remove text underline */
    text-transform: uppercase;
    overflow: hidden;
    transition: 0.5s;
    letter-spacing: 4px;
      }
      .login-button:hover {
           text-decoration: none; 
        background: #000; /* Background color to black on hover */
        color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 5px #000, 0 0 25px #000, 0 0 50px #000, 0 0 100px #000; /* Shadow color to black on hover */
      }
      .login-button span {
        position: absolute;
        display: block;
      }
      .login-button span:nth-child(1),
      .login-button span:nth-child(2),
      .login-button span:nth-child(3),
      .login-button span:nth-child(4) {
        width: 100%;
        height: 100%;
        border: 2px solid transparent; /* Set border to transparent */
        box-sizing: border-box;
      }
      .login-button span:nth-child(1) {
        top: 0;
        left: -100%;
        border-top-color: #000; /* Set border color to black */
        animation: btn-anim1 1s linear infinite;
      }
      @keyframes btn-anim1 {
        0% {
          left: -100%;
        }
        50%,
        100% {
          left: 100%;
        }
      }
      .login-button span:nth-child(2) {
        top: -100%;
        right: 0;
        border-right-color: #000; /* Set border color to black */
        animation: btn-anim2 1s linear infinite;
        animation-delay: 0.25s;
      }
      @keyframes btn-anim2 {
        0% {
          top: -100%;
        }
        50%,
        100% {
          top: 100%;
        }
      }
      .login-button span:nth-child(3) {
        bottom: 0;
        right: -100%;
        border-bottom-color: #000; /* Set border color to black */
        animation: btn-anim3 1s linear infinite;
        animation-delay: 0.5s;
      }
      @keyframes btn-anim3 {
        0% {
          right: -100%;
        }
        50%,
        100% {
          right: 100%;
        }
      }
      .login-button span:nth-child(4) {
        bottom: -100%;
        left: 0;
        border-left-color: #000; /* Set border color to black */
        animation: btn-anim4 1s linear infinite;
        animation-delay: 0.75s;
      }
      @keyframes btn-anim4 {
        0% {
          bottom: -100%;
        }
        50%,
        100% {
          bottom: 100%;
        }
      }
@media (max-width: 768px) {
  .main-content {
    padding: 50px; /* Adjust padding for mobile view */
  }

  .image-content {
    float: none; /* Center image on mobile */
    margin: 20px auto; /* Center image on mobile */
  }

  .navbar {
    padding: 10px; /* Adjust padding for mobile view */
  }
  
  .footer-container {
    flex-direction: column; /* Stack footer elements vertically */
    align-items: center; /* Center footer items */
    padding: 20px 0; /* Adjust padding for mobile view */
  }
}
  @media (max-width: 768px) { /* Adjust the max-width as needed */
    .centered-text {
      text-align: center;
    }
  }
    @media (min-width: 768px) { /* Adjust the min-width as needed */
    .footer-social {
      text-align: right;
      margin-right: -500px; /* Adjust the margin as needed */
     margin-top: -80px;
    }
  }
   @media (min-width: 768px) { /* Adjust the min-width as needed */
    .footer-logo img {
      float: right;
     x; /* Adjust the margin as needed */
    }
  }
    @media only screen and (min-width: 768px) {
    .footer-logo .logo {
      margin-left: 100px;
    }
  }
    @media only screen and (min-width: 768px) {
    .footer-contact {
      margin-left: 300px; /* Adjust the value as needed */
      margin-top:-90px;
    }
  }
    .centered-text {
    background-color: black;
    color: white;
    font-size: 14px;
    text-align: center; /* Center the text by default */
  }

  @media only screen and (min-width: 768px) {
    /* Apply this style only for screens wider than 768px */
    .centered-text {
      text-align: right; /* Align the text to the right for desktop view */
      padding-right: 1100px; /* Add some padding to push the text a bit to the right */
    }
  }
  
  </style>

  <body>
  <div class="navbar">
   
    <ul>
     
      <li><a href="Home.php">Home</a></li>
      <li><a href="Contact_Us.php">Contact Us</a></li>
      <li><a href="index.php">Buy Bikes</a></li>
    </ul>
  </div>

  <!-- Main content -->
  <div class="main-content">
    <h1>Buy-Pre-Owned</h1>
    <h1>No-Headache Bike</h1>
    <div><i class="fas fa-wallet"></i> Easy EMI</div>
    <a href="index.php" class="login-button">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Buy Bike
    </a>
  </div>

  <!-- Bike image -->
  <div class="image-content">
    <img src="/seizedvehicle/BIKE_FRONT_RIGHT.JPEG" alt="Bike Image" />
  </div>

  <!-- Footer -->
  <footer>
    <div class="footer-container">
 <div class="footer-logo">
  <img src="/seizedvehicle/logo.png" alt="Logo" class="logo"  />
</div>

      <div class="footer-contact">
        <p>REACH US</p>
        <p><i class="fa-solid fa-phone"></i>+91 7448174494</p>
        <p><i class="fa-solid fa-envelope"></i> sakshi.k@sahayogmultistate.co.in</p>
        <p>
          <i class="fa-solid fa-location-dot"></i> Shri Ji Complex, Gayatri Mandir Road, Opp. Bisen Petrol Pump,
          Gondia, Maharashtra - 441614
        </p>
      </div>
      <div class="footer-social">
        <a href="https://www.youtube.com/@sahayoggroup"><i class="fab fa-youtube"></i></a>
        <a href="https://www.facebook.com/sahayogmultistate"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/sahayogmultistatesociety/"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </footer>
<p class="centered-text" style="background-color: black; color: white; width: 150%; font-size: 14px;">© 2022 Sahayog Multi-State Credit Co-operative Society Ltd. – All rights reserved.</p>


 <script>
        // JavaScript code for displaying the selected image
        document.getElementById('imageInput').addEventListener('change', function(event) {
          var bikeImage = document.getElementById('bikeImage');
          var file = event.target.files[0];
          if (file) {
            var reader = new FileReader();
            
            
            
            
            
            reader.onload = function(e) {
              bikeImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
          }
        });
      </script>
 
  
</body>
</html>
     