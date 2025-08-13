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

        
 * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }


 body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 0;
      margin-top: 0px;
    }

    header {
      /* background-color: #ff6f61; */
      padding: 20px;
      text-align: center;
      color: #fff;
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 0;
      margin-top: 0px;
    }

    header h1 {
      margin: 0;
      font-size: 2.5em;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      padding: 40px 20px;
      justify-content: center;
      gap: 40px;
    }

    .contact-form, .map {
      flex: 1 1 400px;
      background: #fff;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      transition: 0.3s ease;
    }

    .contact-form:hover, .map:hover {
      transform: translateY(-5px);
    }

    .contact-form h2 {
      margin-bottom: 20px;
      color:  #1b1722;
    }

    .contact-form input, .contact-form textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 1em;
    }

    .contact-form button {
      background-color: #1b1722;
      color: #fff;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      font-size: 1em;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .contact-form button:hover {
      background-color:  #1b1722;
    }

    .map h2 {
      color: #1b1722;
      margin-bottom: 20px;
    }

    .map iframe {
      width: 100%;
      height: 400px;
      border: none;
      border-radius: 8px;
    }

    footer {
      background-color: #333;
      color: black;
      text-align: center;
      padding: 15px;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        align-items: center;
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
  
<section class="container">
  <!-- Contact Form -->
  <div class="contact-form">
    <h2>Contact Us</h2>
    <form id="contactForm">
      <input type="text" id="name" placeholder="Your Name" required />
      <input type="email" id="email" placeholder="Your Email" required />
      <textarea id="message" rows="5" placeholder="Your Message" required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </div>

  <!-- Google Map (Ahmedabad Area) -->
  <div class="map">
    <h2>Find Us in Ahmedabad</h2>
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3670.482474593237!2d72.57136271541784!3d23.03051358494262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e84f20c7a16c9%3A0xbcdd37a52f6c67f1!2sAhmedabad%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1640000000000!5m2!1sen!2sin"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</section>

<!-- Script -->
<script>
  const contactForm = document.getElementById('contactForm');

  contactForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();

    if (name === '' || email === '' || message === '') {
      alert('Please fill in all fields.');
      return;
    }

    // Simulate form submission (Replace this with actual backend call)
    alert('Thank you for contacting Sweet Treats Cake Shop, ' + name + '! We will get back to you soon.');

    // Clear the form after submission
    contactForm.reset();
  });
</script>

<!-- Footer -->
<footer class="footer" id="contact">
  <div class="box-container">
      <div class="mainBox">
          <div class="content">
              <a href="#"><img src="images/logo.png" alt=""></a>
              <h1 class="logoName"> Sweet Cake </h1>
          </div>
          <p>
              Welcome to Sweet Cake Shop! We specialize in crafting the most delicious, mouth-watering cakes for every occasion. Whether you're celebrating a birthday, wedding, or just craving something sweet, our team of passionate bakers brings love and creativity to every recipe.
            </p>

      </div>
      <div class="box">
         <center> <h3>Quick link</h3>
        <a href="index.html"> <i class="fas fa-arrow-right"></i>Home</a>
          <a href="c1.html"> <i class="fas fa-arrow-right"></i>Cake</a>
          <a href="Pastry.html"> <i class="fas fa-arrow-right"></i>Pastry</a>
          <a href="Cupcakes.html"> <i class="fas fa-arrow-right"></i>Cupcakes</a>
          <a href="contact us.html"> <i class="fas fa-arrow-right"></i>Contact</a>
          <a href="About us.html"> <i class="fas fa-arrow-right"></i>About Us</a>
          <a href="#"> <i class="fas fa-arrow-right"></i>Feedback</a></center>

      </div>
      <!-- <div class="box">
          <h3>Extra link</h3>
          <a href="#"> <i class="fas fa-arrow-right"></i>Account info</a>
          <a href="#"> <i class="fas fa-arrow-right"></i>order item</a>
          <a href="Privacy Policy.html"> <i class="fas fa-arrow-right"></i>privacy policy</a>
          <a href="Tearms&Conditions.html"> <i class="fas fa-arrow-right"></i>Terms & Conditions</a>
          <a href="#"> <i class="fas fa-arrow-right"></i>our  services</a>
      </div> -->
      <div class="box">
          <h3>Contact Info</h3>
          <a href="#"> <i class="fas fa-phone"></i>+91 9879672030</a>
          <a href="#"> <i class="fas fa-envelope"></i>sweetcakes@gmail.com</a>

      </div>

  </div>
  <div class="share">
      <a href="https://www.facebook.com/" class="fab fa-facebook-f"></a>
      
      <a href="https://www.instagram.com/accounts/login/?hl=en" class="fab fa-instagram"></a>
      
      <a href="https://www.pinterest.com/#top" class="fab fa-pinterest"></a>
  </div>
  <div class="credit">
      created by <span>Mr.Patel </span> |all rights reserved ! 
  </div>
</footer>


<!-- swiper js link  -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- custom js file  -->
<script src="index.js"></script>


</body>
</html>
