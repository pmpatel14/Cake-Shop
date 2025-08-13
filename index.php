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

</head>
<style>
     * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }
</style>

<body>
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

    <!-- home section start here  -->
    <section class="home" id="home">
        <div class="homeContent">
            <h2>Welcome to Our cake Shop </h2>
            <p>Delicious Cake for Everyone</p>
            <div class="home-btn">
                <!-- <a href="Cake.html"><button>see more</button></a> -->
            </div>
        </div>
    </section>

    <!-- home section end here  -->

    <!-- product section start here  -->
    <section class="product" id="product">
        <div class="heading">
            <h2>Our Exclusive Products</h2>
        </div>
        <div class="swiper product-row">
            <div class="swiper-wrapper">
                <div class="swiper-slide box">
                    <div class="img">
                        <img src="images/Fondant Cake.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>Fondant Cake</h3>
                        <div class="orderNow">
                            <!-- <button>Order Now </button> -->
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="img">
                        <img src="images/Cherry Cup Cake.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>Cherry CupCake</h3>
                        <div class="orderNow">
                            <!-- <button>Order Now </button> -->
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="img">
                        <img src="images/French_Vanilla Pastry.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>French vanilla Pastry</h3>
                        <div class="orderNow">
                            <!-- <button>Order Now </button> -->
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="img">
                        <img src="images/Cheese Cake.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>Cheese Cake</h3>
                        <div class="orderNow">
                            <!-- <button>Order Now </button> -->
                        </div>
                    </div>
                </div>

            </div>
         <div class="swiper-pagination"></div>
        </div>
        <div class="swiper product-row">
            <div class="swiper-wrapper">
                <div class="swiper-slide box">
                    <div class="img">
                        <img src="images/Chocolate Cup Cake.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>Chocolate CupCake</h3>
                        <div class="orderNow">
                            <!-- <button>Order Now </button> -->
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="img">
                        <img src="images/Butter Scotch.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>Butter scotch Cake</h3>
                        <div class="orderNow">
                            <!-- <button>Order Now </button> -->
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="img">
                        <img src="images/Oreo Cake.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>Oreo Cake</h3>
                        <div class="orderNow">
                            <!-- <button>Order Now </button> -->
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="img">
                        <img src="images/Fruit Cake.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>Fruit Cake</h3>
                        <div class="orderNow">
                            <!-- <button>Order Now </button> -->
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- product section end here  -->

    <!-- blogs section start here  -->
    <section class="blogs" id="blogs">

        <div class=" swiper blogs-row">
            <div class="swiper-wrapper">
                <div class=" swiper-slide box">
                    <div class="img">
                        <img src="images/blog-img1.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Caramel Bourbon Vanilla Cupcakes </h3>
                        <p>Cupcakes are delightful little treats that bring joy in every bite. Perfectly portioned and beautifully decorated, these mini cakes come in a variety of flavors, from classic vanilla and chocolate to fun options like red velvet, lemon zest, and salted caramel. Each cupcake is topped with creamy frosting, sprinkles, or drizzles that make them as pretty as they are delicious. Whether you’re celebrating a special occasion or just craving something sweet, cupcakes are the perfect choice to satisfy your sweet tooth and brighten your day.</p>
                        <a href="#blogs" class="btn">learn more</a>
                    </div>
                </div>
                <div class=" swiper-slide box">
                    <div class="img">
                        <img src="images/Cheese Cake.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Chees cake </h3>
                        <p>The cheese group offers a delightful variety of flavors, textures, and aromas that cater to every palate. From the creamy richness of Brie and Camembert to the sharp tang of Cheddar and Gouda, cheeses are a versatile and nutritious addition to any meal. Soft cheeses melt smoothly into sauces, while hard cheeses add a satisfying bite to sandwiches and salads. Whether enjoyed on their own, paired with fruits and wines, or used in cooking, cheeses are a great source of protein, calcium, and essential nutrients. The cheese group truly brings a world of delicious possibilities to the table!</p>
                       
                        <a href="#blogs" class="btn">learn more</a>
                    </div>
                </div>
                <div class=" swiper-slide box">
                    <div class="img">
                        <img src="images/blog-img2.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Cake </h3>
                        <p>Whether you prefer classic favorites like chocolate fudge and red velvet or unique flavors like caramel bourbon and strawberry cream, our cakes promise a moist, tender crumb and melt-in-your-mouth taste. Topped with smooth buttercream or decadent ganache, they’re as beautiful as they are delicious—perfect for birthdays, weddings, or any celebration that deserves something sweet.</p>
                        <a href="#blogs" class="btn">learn more</a>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>


        </div>
    </section>

    <!-- blogs section ends here  -->

    <!-- newsletter section start here  -->

    <section class="newsletter">
        <form action="">
            <h3>subscribe for latest update</h3>
            <input type="email" name="" placeholder="enter your email" id="" class="box">
            <input type="button" value="subscribe" class="box2">
        </form>
    </section>
    <!-- newsletter section ends here  -->

    <!-- review section start here  -->
    <section class="review" id="review">
        <div class="heading">
            <h2>feedback</h2>
        </div>


        <div class=" swiper review-row">
            <div class="swiper-wrapper">
                <div class="swiper-slide box">
                    <div class="client-review">
                        <p>"The chocolate truffle cake was absolutely delicious! Perfectly moist and rich, with just the right amount of sweetness. I’ll definitely order again!"</p>
                    </div>
                    <div class="client-info">
                        <div class="img">
                            <img src="images/u3.png" alt="">
                        </div>
                        <div class="clientDetailed">
                            <h3>Drashti Patel</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="client-review">
                        <p>"Loved the design on my birthday cake! It tasted as amazing as it looked. The vanilla sponge was light and fluffy, and the buttercream was heavenly!"</p>
                    </div>
                    <div class="client-info">
                        <div class="img">
                            <img src="images/client1.jpg" alt="">
                        </div>
                        <div class="clientDetailed">
                            <h3>Hardy Devid</h3>
                             </div>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="client-review">
                        <p>The red velvet cupcakes were super soft and the cream cheese frosting was spot on! Can’t wait to try more from your shop."</p>
                    </div>
                    <div class="client-info">
                        <div class="img">
                            <img src="images/U6.png" alt="">
                        </div>
                        <div class="clientDetailed">
                            <h3>sara Thakkar</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="client-review">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Provident, perferendis architecto
                            quasi eveniet aliquam sed?</p>
                    </div>
                    <div class="client-info">
                        <div class="img">
                            <img src="images/U4.png" alt="">
                        </div>
                        <div class="clientDetailed">
                            <h3>Kush Patel</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>

            </div>
        </div>
    </section>
    <!-- review section ends here  -->

    <!-- Javascript Start -->

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper('.product-row', {
    slidesPerView: 4,
    spaceBetween: 20,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      1024: { slidesPerView: 4 },
      768: { slidesPerView: 2 },
      480: { slidesPerView: 1 },
    },
  });

  var blogSwiper = new Swiper('.blogs-row', {
    slidesPerView: 1,
    spaceBetween: 20,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });

  var reviewSwiper = new Swiper('.review-row', {
    slidesPerView: 1,
    spaceBetween: 20,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });
</script>

    <!-- Javascript End -->
     
    <!-- footer section start here  -->

    <footer class="footer" id="contact">
        <div class="box-container">
            <div class="mainBox">
                <div class="content">
                    <a href="#"><img  src="images/logo1.png" alt=""></a>
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