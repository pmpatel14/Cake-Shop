<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sweet Cake</title>
  <!-- swiper link  -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- custom css file  -->
  <link rel="stylesheet" href="style.css">
  <style>
  /* style navbar start  */

  * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
          }

        body {
            font-family: Arial, sans-serif;
        }

        
/* Style navbar end */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-color: white;
      color: #333;
      line-height: 1.6;
    }

    .about-section {
      max-width: 1200px;
      margin: 0 auto;
      padding: 50px 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
    }

    .about-image {
      flex: 1 1 400px;
      padding: 20px;
    }

    .about-image img {
      width: 100%;
      border-radius: 20px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .about-content {
      flex: 1 1 500px;
      padding: 20px;
    }

    .about-content h2 {
      font-size: 36px;
      color: #1b1722;
      margin-bottom: 20px;
    }

    .about-content p {
      font-size: 18px;
      margin-bottom: 20px;
      color: #555;
    }

    .stats {
      display: flex;
      gap: 40px;
      margin-top: 30px;
    }

    .stat {
      text-align: center;
    }

    .stat h3 {
      font-size: 40px;
      color: #1b1722;
      margin-bottom: 10px;
    }

    .stat p {
      font-size: 16px;
      color: #777;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .about-section {
        flex-direction: column;
      }

      .about-image, .about-content {
        flex: 1 1 100%;
      }

      .stats {
        justify-content: center;
      }
    }
  </style>
</head>
<body>

    <!-- header section start here  -->
    <?php include 'header.php' ?>
      <!-- header section end here  -->
  
      <script>
          // Profile Menu Toggle
          function toggleProfileMenu() {
              const menu = document.getElementById('profileMenu');
              menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
          }
  
          // Close menu on outside click
          window.onclick = function(event) {
      if (!event.target.closest('.profile-icon') && !event.target.closest('.profile-menu')) {
          document.getElementById('profileMenu').style.display = 'none';
      }
  }
  </script>
  
<section class="about-section">
    <div class="about-image">
      <img src="images/Cheese Cake.png" alt="Our Cake Shop">
    </div>
    <div class="about-content">
      <h2>About Sweet Cake</h2>
      <p>
        Welcome to Sweet Cake Shop! We specialize in crafting the most delicious, mouth-watering cakes for every occasion. Whether you're celebrating a birthday, wedding, or just craving something sweet, our team of passionate bakers brings love and creativity to every recipe.
      </p>
      <p>
        Since 2010, we've been spreading joy one slice at a time. Our commitment to using the finest ingredients ensures every bite is a celebration of flavor.
      </p>

     
  </section>

 
<!-- Footer -->
<?php include 'footer.php'; ?>


</body>
</html>
