<!-- <?php
session_start()
?> -->

<header>
    <nav class="navbar">
        <!-- Left Side (Logo + Name) -->
        <div class="navbar-left">
            <img src="images/logo1.png" alt="Logo">
            <a href="index.php" class="site-name">Sweet Cake</a>
        </div>

        <!-- Center Menu -->
        <div class="navbar-center">
            <a href="index.php">Home</a>

            <div class="dropdown">
                <a class="dropdown-btn">Products &#9662;</a>
                <div class="dropdown-content">
                    <a href="Cake.php">Cakes</a>
                    <a href="Cupcakes.php">Cupcakes</a>
                    <a href="Pastry.php">Pastry</a>
                </div>
            </div>

            <!-- <a href="contact us.php">Contact</a> -->
            <a href="About us.php">About Us</a>
            <a href="Feedback.php">Contact Us</a>
            <a href="cart.php">Your Cart</a>
            <a href="my_order.php">Your Order</a>
        </div>

        <!-- Right Side (Login + Profile) -->
        <div class="navbar-right">
            <a href="Login.php" class="btn">Login</a>
            <a href="profile.php" class="profile-link">
                <img src="images/icons/i1.webp" alt="Profile Icon" height="40px" width="40px">
            </a>
        </div>
    </nav>
</header>
