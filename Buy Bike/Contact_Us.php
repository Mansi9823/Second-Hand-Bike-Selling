<!DOCTYPE html>
<html lang="en">
  <head>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
      integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
      crossorigin="anonymous"
    />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Page</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-image: url("/home/mansi/Downloads/background.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        padding-top: 70px; /* To avoid content hiding behind navbar */
      }
      body::before {
        content: "";
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black;
        opacity: 0.7;
        z-index: -1;
      }
      h2 {
        text-align: center;
        font-family: Inter, sans-serif;
        line-height: 1.5;
        color: rgb(255, 255, 255);
        font-size: 2.5em;
        font-weight: 600;
        margin-bottom: 30px;
      }
      .contact-card {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        color: #000;
      }
      .contact-card p {
        margin: 0 0 10px 0;
      }
      .contact-card img {
        max-width: 100%;
        height: auto;
        margin-top: 20px;
      }
      .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
       
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999;
      }
      .navbar .whatsapp {
        display: flex;
        align-items: center;
        transition: transform 0.3s ease, color 0.3s ease;
      }
      .navbar .whatsapp:hover {
        transform: translateY(-5px);
        color: black;
      }
      .navbar .whatsapp i {
        margin-right: 10px;
        color: white;
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
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
      }
      .navbar a:hover {
        color: black;
      }
    </style>
  </head>
  <body>
    <div class="navbar">
     
      <ul>
        <li><a href="Home.php">Home</a></li>
        <li><a href="Contact_Us.php">Contact Us</a></li>
        <li><a href="index.php">Buy Bikes</a></li>
      </ul>
    </div>

    <div class="container">
      <h2>Contact Us</h2>
      <div class="contact-card row">
        <div class="col-md-6">
          <p><i class="fa-solid fa-phone"></i>+91 7448174494</p>
          <p>
            <i class="fa-solid fa-location-dot"></i> Shri Ji Complex, Gayatri
            Mandir Road,<br />
            Opp. Bisen Petrol Pump, Gondia, Maharashtra - 441614
          </p>
          <p>
            <i class="fa-solid fa-envelope"></i>
            sakshi.k@sahayogmultistate.co.in
            
          </p>
        </div>
        <div class="col-md-6">
          <img
            src="/seizedvehicle/contactUsVistHub2023.png"
            alt="Description of the image"
          />
        </div>
      </div>
    </div>
  </body>
</html>
